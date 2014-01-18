<?php

use yii\db\Schema;

class m140102_215021_create_session_table extends \yii\db\Migration
{
	public function safeUp()
	{

		$this->createTable('{{%session}}', array(
			'id' =>  'CHAR(40) NOT NULL PRIMARY KEY',
			'expire' => 'INTEGER',
			'data' => 'BLOB',
		));
	}

	public function safeDown()
	{
		$this->dropTable('{{%session}}');
	}
}
