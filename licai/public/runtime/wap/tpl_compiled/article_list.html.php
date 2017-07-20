<?php if ($_REQUEST['is_ajax'] != 1): ?>
<?php echo $this->fetch('./inc/header.html'); ?>	
<div class="page" id='<?php echo $this->_var['data']['act']; ?>'>
<?php
	$this->_var['back_url'] = wap_url("index","init#index");
	$this->_var['back_page'] = "#init";
	$this->_var['back_epage'] = $_REQUEST['epage']=="" ? "#init" : "#".$_REQUEST['epage'];
?>
<?php echo $this->fetch('./inc/title.html'); ?>
<div class="content infinite-scroll pull-to-refresh-content article_list_content"  data-distance="<?php echo $this->_var['data']['rs_count']; ?>"  all_page="<?php echo $this->_var['data']['page']['page_total']; ?>" ajaxurl="<?php
echo parse_wap_url_tag("u:index|article_list#index|"."".""); 
?>">
<!-- 这里是页面内容区 -->
<!--文章列表-->
<div class="content-inner">
	<div class="list-block">
	<div  style="margin-top:45px;">

        <?php $_from = $this->_var['data']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
	 <details style="background:white;border:none;" class="detail" >
         <summary style="height:45px;font-size:17px;background-image: url('tpl/fanwe/images/public/1.png');background-size: 5.5%;background-repeat: no-repeat;background-position: 97.5% 50%;color: black;line-height: 280%;padding-left: 10px;margin-top: 1px;font-weight: 500;background-color:#e4f8ff;"><span style="display:inline-block;background-image:url('tpl/fanwe/images/public/biaoqian1.png');width:1.2rem;height: 1.2rem;margin-right: 10px;background-position:0 0%;margin-bottom: -3px;" class="spanimg"></span><?php echo $this->_var['list']['title']; ?>
		</summary>
		<ul style="margin:0px 0 0 20px;">
            <?php $_from = $this->_var['list']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
            <li onclick="RouterURL('<?php
echo parse_wap_url_tag("u:index|show_article|"."id=".$this->_var['item']['id']."".""); 
?>','#show_article',2);" style="font-size: 1rem;"><p style="font-size:0.7rem;border-top:1px solid #ddd;color:#275fcc;"><?php echo $this->_var['item']['title']; ?></p></li>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		</ul>
	</details>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	</div>
	<script type="text/javascript">
		for (var i = 0; i < jQuery(".detail").length;i++) {
			(function (i) {
				jQuery(".detail:eq("+i+")").click(function() {
					if (jQuery(".detail:eq("+i+")").attr("open")) {
						jQuery(".detail:eq("+i+")").children('summary').css("background-image","url(tpl/fanwe/images/public/1.png)");
						jQuery(".detail:eq("+i+")").children('summary').css({"background-color":"#e4f8ff","color":"black"});
						jQuery(".detail:eq("+i+")").children('summary').children("span").css("background-image","url(tpl/fanwe/images/public/biaoqian1.png)");
					}
					else{
						jQuery(".detail:eq("+i+")").children('summary').css("background-image","url(tpl/fanwe/images/public/-"+1+".png)");
						jQuery(".detail:eq("+i+")").children('summary').children("span").css("background-image","url(tpl/fanwe/images/public/biaoqian2.png)");
						jQuery(".detail:eq("+i+")").children('summary').css({"background-color":"#4366e4","color":"white"});
					}
					
				});
				
			})(i)
			
		}

	</script>



	  <!--  <ul>
	  <?php endif; ?>
	  默认的下拉刷新层
	      <div class="pull-to-refresh-layer" all_page="<?php echo $this->_var['data']['page']['page_total']; ?>" >
	          <div class="preloader"></div>
	          <div class="pull-to-refresh-arrow"></div>
	      </div>
	  			<?php $_from = $this->_var['data']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
	  			<li>
	           <a href="#" onclick="RouterURL('<?php
echo parse_wap_url_tag("u:index|show_article|"."id=".$this->_var['item']['id']."".""); 
?>','#show_article',2);" class="item-link item-content">
	             <div class="item-inner w_b">
	               <div class="item-title w_b_f_1"><?php echo $this->_var['item']['title']; ?></div>
	             </div>
	           </a>
	        </li>
	  			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>			 
	  <?php if ($_REQUEST['is_ajax'] != 1): ?>
	  		</ul> -->
	</div>
</div>
<?php echo $this->fetch('./inc/footer.html'); ?>
<?php endif; ?>




