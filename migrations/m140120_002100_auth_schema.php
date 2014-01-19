<?php

use yii\db\Schema;

class m140120_002100_auth_schema extends \yii\db\Migration
{
	public function safeUp()
	{
		$schema = $this->db->schema;
		$this->createTable('{{%auth_item}}', array(
			'name'		=> 'character varying(64) not null',
			'type'		=> 'integer not null',
			'description'=>'text',
			'biz_rule'	=> 'text',
			'data'		=> 'text',
			'PRIMARY KEY(name)',
		));
		$this->createTable('{{%auth_assignment}}', array(
			'item_name'	=> 'character varying(64) not null REFERENCES '.$schema->quoteTableName('{{%auth_item}}').' (name) ON DELETE CASCADE ON UPDATE CASCADE',
			'user_id'	=> 'integer not null REFERENCES '.$schema->quoteTableName('{{%users}}').' (id) ON DELETE CASCADE ON UPDATE CASCADE',
			'biz_rule'	=> 'text',
			'data'		=> 'text',
		));
		$this->createTable('{{%auth_item_child}}', array(
			'parent'=>'character varying(64) not null REFERENCES '.$schema->quoteTableName('{{%auth_item}}').' (name) ON DELETE CASCADE ON UPDATE CASCADE',
			'child'=>'character varying(64) not null REFERENCES '.$schema->quoteTableName('{{%auth_item}}').' (name) ON DELETE CASCADE ON UPDATE CASCADE',
			'PRIMARY KEY(parent, child)',
		));
	}

	public function safeDown()
	{
		$this->dropTable('{{%auth_item_child}}');
		$this->dropTable('{{%auth_assignment}}');
		$this->dropTable('{{%auth_item}}');
	}
}

