<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 5/25/14
     * Time: 10:55 PM
     */
    namespace c006\url\assets;

    use Yii;

    /**
     * Class AppAliasUrl
     *
     * @package c006\url\assets
     */
    class AppAliasUrl
    {

        /**
         * @var int
         */
        public static $complete = FALSE;

        /**
         * @var bool
         */
        public static $convertAll = TRUE;


        /**
         * @param $route
         *
         * @return string
         */
        public static function routeFailed($route)
        {

            if ( !empty($route) ) {
                $baseRoute = self::getBaseRoute($route);
                $sql       = "SELECT * FROM `alias_url` WHERE UPPER(`public`) LIKE ('" . strtoupper($baseRoute) . "');";
                $row       = Yii::$app->db->createCommand($sql)->queryOne();
                if ( $row !== FALSE ) {
                    return $row['private'];
                }
            }
            //Uncomment to trace
            //Yii::trace('AppAliasUrl > routeFailed > ' . $route, 'c006');
            return $route;
        }


        /**
         * @param $route
         *
         * @return string
         */
        public static function findAll($route)
        {

            if ( !empty($route) ) {
                $baseRoute = self::getBaseRoute($route);
                $sql       = "SELECT * FROM `alias_url` WHERE UPPER(`private`) LIKE ('" . strtoupper($baseRoute) . "');";
                $row       = Yii::$app->db->createCommand($sql)->queryOne();
                if ( $row !== FALSE ) {
                    return $row['public'];
                }
            }
            //Uncomment to trace
            //Yii::trace('AppAliasUrl > findAll > ' . $route, 'c006');
            return $route;
        }


        /**
         * @param $route
         *
         * @return array|mixed
         */
        private static function getBaseRoute($route)
        {

            $route = preg_replace('/^\/+/', '', $route);
            if ( strpos($route, '/') !== FALSE ) {
                $route = explode('/', $route);

                return $route[0];
            }

            return $route;
        }


        private static function cleanRoute($route)
        {

            $route = preg_replace('/^\//', '', $route);
            if ( strpos($route, '/') !== FALSE ) {
                $route = explode('/', $route);
                unset($route[0]);
                $key = array_search('index', $route);
                if ( $key ) {
                    unset($route[$key]);
                }

                return join('/', $route);

            }

            return str_replace(self::getBaseRoute($route), '', $route);
        }
    }


