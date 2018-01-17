<?php
/**
* @package Автоматическое подключение характеристик к дочерним категориям
* @author Dmitry Petukhov (https://user.diafan.ru/user/weissfl)
* @copyright Copyright (c) 2018 by Dmitry Petukhov
* @license MIT License (https://en.wikipedia.org/wiki/MIT_License)
*/

class Shop_admin_param extends Frame_admin
{

	before public function prepare_config()
	{
		$main = &$this->variables['main'];
		$pos = array_search('category', array_keys($main));
		$main = array_merge (
            array_slice($main, 0, ++$pos),
            array('autoassign_child' =>
				array(
					'type' => 'checkbox',
					'name' => 'Автоматически применять на дочерние категории при их создании',
					'help' => 'Если отмечено, характеристика будет применяться ко всем вновь создаваемым дочерним категориям внутри категорий, к которым она применена.',
				)
			),
            array_slice($main, $pos)
        );
	}

}