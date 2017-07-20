<?php if ($_REQUEST['is_ajax'] != 1): ?>
<?php echo $this->fetch('./inc/header.html'); ?>	
<div class="page" id='<?php echo $this->_var['data']['act']; ?>'>
<?php
	$this->_var['back_url'] = wap_url("index","init#index");
	$this->_var['back_page'] = "#init";
    $this->_var['back_epage'] = $_REQUEST['epage']=="" ? "#init" : "#".$_REQUEST['epage'];
?>
<?php echo $this->fetch('./inc/title.html'); ?>
<div class="content infinite-scroll" now_page="1" data-distance="<?php echo $this->_var['data']['rs_count']; ?>"  all_page="<?php echo $this->_var['data']['page']['page_total']; ?>" ajaxurl="<?php
echo parse_wap_url_tag("u:index|integral_mall#index|"."".""); 
?>">
<!-- 这里是页面内容区 -->

<div class="integral_container">
	<!--积分商城-->
	<ul class="integral_nav_0">
		<li class="type_0" onclick="viewintegralNav(0);">所有类别</li>
		<li class="type_1" onclick="viewintegralNav(1);">积分范围</li>
	</ul>
	<div class="blank055"></div>
	
	<div class="integral_nav_1">
		<table style=" width:100%;">
		<tr>
			<?php $_from = $this->_var['data']['sort_url']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'sorts');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['sorts']):
?>
			<th <?php if ($this->_var['sorts']['id'] == $this->_var['data']['sort']): ?> class="y"<?php endif; ?> >
				<a href="#" onclick="reloadpage('<?php echo $this->_var['sorts']['url']; ?>','#<?php echo $this->_var['data']['act']; ?>','.integral_container');"><?php echo $this->_var['sorts']['name']; ?></a>
			</th>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		</tr>
	</table>
	</div>
	
	<div class="blank055"></div>
	<div>
		<ul class="integral_goods">
<?php endif; ?>
			<?php $_from = $this->_var['data']['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'goods');$this->_foreach['goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['goods']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['goods']):
        $this->_foreach['goods']['iteration']++;
?>
			<li class="bb1 ">
				<a class="w_b" href="#" onclick="RouterURL('<?php
echo parse_wap_url_tag("u:index|goods_information|"."id=".$this->_var['goods']['id']."".""); 
?>','#goods_information',2);" >
				<div class="left_img"><img src="<?php echo $this->_var['goods']['img']; ?>" /></div>
			    <div class="right_p w_b_f_1">
			    	<h5><?php echo $this->_var['goods']['name']; ?></h5>
					<p >所需积分：<span class="ea544a"><?php echo $this->_var['goods']['score']; ?></span>分</p>
					<p>购买人数：
					<?php if ($this->_var['goods']['invented_number'] > 0): ?>
					<?php echo $this->_var['goods']['invented_number']; ?>
					<?php else: ?>
					0
					<?php endif; ?>人
					</p>
			    </div>
			    </a>
			</li>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		</ul>
	</div>
	<div class="blank055"></div>				
	<div class="float_block Object_0" style="display:none;">
		<div class="float_background"></div>
		<div class="integral_mall_nav">
			<h5>所有类别<span class="close" onclick="closeIntegalNav(this);">关闭</span></h5>
			<div class="b_blank"></div>
			<ul>
				<?php $_from = $this->_var['data']['cates_url']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'cates');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['cates']):
?>
				<li <?php if ($this->_var['cates']['id'] == $this->_var['data']['cates']): ?> class="y"<?php endif; ?>>
					<a href="#" onclick="reloadpage('<?php echo $this->_var['cates']['url']; ?>','#<?php echo $this->_var['data']['act']; ?>','.integral_container');">
					<span class="name f_l"><?php echo $this->_var['cates']['name']; ?></span>
					<span class="ico f_r"><i class="fa fa-check"></i></span>
					</a>
				</li>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</ul>
			</div>
		</div>
	
		<div class="float_block Object_1" style="display:none;">
		<div class="float_background"></div>
		<div class="integral_mall_nav">
			<h5>积分范围<span class="close" onclick="closeIntegalNav(this);">关闭</span></h5>
			<div class="b_blank"></div>
			<ul>
				<?php $_from = $this->_var['data']['integral_url']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'integral');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['integral']):
?>
				<li <?php if ($this->_var['integral']['id'] == $this->_var['data']['integral']): ?> class="y"<?php endif; ?>>
					<a href="#" onclick="reloadpage('<?php echo $this->_var['integral']['url']; ?>','#<?php echo $this->_var['data']['act']; ?>','.integral_container');">
					   <span class="name f_l"><?php echo $this->_var['integral']['name']; ?></span>
					   <span class="ico f_r"><i class="fa fa-check"></i></span>
				    </a>
				</li>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
<?php if ($_REQUEST['is_ajax'] != 1): ?>
			</ul>
		</div>
	</div>
</div>	

 <!-- 加载提示符 -->
<div class="infinite-scroll-preloader">
  <div class="preloader">
  </div>
</div>
<?php echo $this->fetch('./inc/footer.html'); ?>
<?php endif; ?>
