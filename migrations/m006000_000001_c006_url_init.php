<?php

    /**
     * Class m140526_232402_c006_url_init
     */
    class m006000_000001_c006_url_init extends \yii\db\Migration
    {

        /**
         * @return bool
         */
        public function up()
        {

            /* Use database default */
            $tableOptions = '';
            $this->createTable('{{%alias_url}}', [
                    'id'       => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
                    'private'  => 'VARCHAR(100) NOT NULL',
                    'public'   => 'VARCHAR(100) NOT NULL',
                    0          => 'PRIMARY KEY (`id`)'
                ], $tableOptions
            );
            $this->createIndex("public_UNIQUE", '{{%alias_url}}', 'public', TRUE);
            /* Insert data */
            $columns = [ "id", "private", "public" ];
            $this->batchInsert('{{%alias_url}}', $columns, [
                    [ 1, 'alias-url', 'alias' ],
                    [ 2, 'site/about', 'abc' ],
                ]
            );

            return TRUE;
        }


        /**
         * @return bool
         */
        public function down()
        {

            echo "m006000_000001_c006_url_init reverted.\n";
            $this->dropTable('{{%alias_url}}');

            return TRUE;
        }
    }
