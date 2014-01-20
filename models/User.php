<?php

namespace app\models;

/**
 * @inheritdoc
 */
class User extends \nineinchnick\usr\models\ExampleUser
{
	public function __toString()
	{
		return $this->firstname.' '.$this->lastname;
	}
}
