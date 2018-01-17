<?php
/**
* @package Автоматическое подключение характеристик к дочерним категориям
* @author Dmitry Petukhov (https://user.diafan.ru/user/weissfl)
* @copyright Copyright (c) 2018 by Dmitry Petukhov
* @license MIT License (https://en.wikipedia.org/wiki/MIT_License)
*/

class Shop_admin_category extends Frame_admin
{

	before public function prepare_config()
	{
		$this->variables['main']['paramcat']['no_save'] = false;
	}
    
    new public function save_variable_paramcat()
    {
        if (!$this->diafan->is_new)
		{
			return;
		}
        $parent_id = filter_input(INPUT_POST,'parent_id',FILTER_VALIDATE_INT);
        if(!empty($parent_id))
        {
            $params = DB::query('select pc.element_id from {shop_param_category_rel} as pc join {shop_param} as p on p.id=pc.element_id where pc.cat_id=%d and p.autoassign_child="1"',$parent_id);
            $values = array();
            while($param = DB::fetch_array($params))
            {
                $values[] = '('.$param['element_id'].','.$this->diafan->id.')';
            }
            if(!empty($values))
            {
                DB::query('insert into {shop_param_category_rel} (element_id,cat_id) values'.implode(',', $values));
            }
        }
    }

}