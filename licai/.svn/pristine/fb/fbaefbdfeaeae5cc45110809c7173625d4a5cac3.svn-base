<?php
// +----------------------------------------------------------------------
// | 邦邦理财
// +----------------------------------------------------------------------
// | Copyright (c) 2017 http://www.bangbanglicai.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 华少（273017814@qq.com）
// +----------------------------------------------------------------------

class article_list
{
	public function index(){
		
		//分页
		$page = intval($GLOBALS['request']['page']);
		if($page==0)
			$page = 1;
		
		$root = get_baseroot();
		
		$cate_id =intval($GLOBALS['m_config']['article_cate_id']);
        $parent_id = $GLOBALS['db']->table('article_cate')->where('id = ' . $cate_id)->getField('pid');
        if ($parent_id) {
            $child_cate_list = $GLOBALS['db']->table('article_cate')->where('is_effect = 1 AND is_delete = 0 AND pid= ' . $parent_id)->order('sort')->select();
            $cate_ids = array();


            foreach ($child_cate_list AS $k=>$v) {
                #$cate_ids[] = $v['id'];
                $sql = "select id,title from ".DB_PREFIX."article where is_effect = 1 and is_delete = 0 and cate_id = " . $v['id'] . " order by sort DESC limit 0, 100";
                $list = $GLOBALS['db']->getAll($sql);

                $child_cate_list[$k]['list'] = $list;
            }

            #$ids = implode(',', $cate_ids);
        } else {
            #$ids = implode(',', array($cate_id));
        }
		
		//分页
		#$limit = (($page-1)*app_conf("PAGE_SIZE")).",".app_conf("PAGE_SIZE");
        #$limit = '0, 1000';
		
		#$sql = "select id,title from ".DB_PREFIX."article where is_effect = 1 and is_delete = 0 and cate_id IN (".$ids.") order by sort DESC ";
		#$sql.=" limit ".$limit;
		
		#$sql_count = "select count(*) from ".DB_PREFIX."article where is_effect = 1 and is_delete = 0 and cate_id IN (".$ids . ")";
		

		#$count = $GLOBALS['db']->getOne($sql_count);
		#$list = $GLOBALS['db']->getAll($sql);
	
	
						
		#$root['page'] = array("page"=>$page,"page_total"=>ceil($count/app_conf("PAGE_SIZE")),"page_size"=>app_conf("PAGE_SIZE"));	
		
		$root['response_code'] = 1;
		$root['list'] = $child_cate_list;
		$root['program_title'] = "文章列表";
		output($root);		
	}
}
?>
