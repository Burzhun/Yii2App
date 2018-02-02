<?php

use yii\db\Migration;
use yii\db\Schema;
/**
 * Handles the creation of table `users`.
 */
class m180201_233453_create_users_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'last_name' => Schema::TYPE_STRING . ' NOT NULL',
            'birthdate' => Schema::TYPE_STRING . ' NOT NULL',
            'gender' => Schema::TYPE_STRING . ' NOT NULL',
            'phone' => Schema::TYPE_STRING . ' NOT NULL',


        ]);

        $this->createTable('address', [
            'id' => $this->primaryKey(),
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'address' => Schema::TYPE_STRING . ' NOT NULL',
        ]);


    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('users');
        $this->dropTable('address');

       
    }
}
