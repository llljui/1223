<?php echo $this->fetch('./inc/header.html'); ?>	
<div class="page" id='<?php echo $this->_var['data']['act']; ?>'>
<?php
	$this->_var['back_url'] = wap_url("index","deal#index",array("id"=>$this->_var['data']['deal']['id']));
	$this->_var['back_page'] = "#deal";
	$this->_var['back_epage'] = $_REQUEST['epage']=="" ? "#uc_borrowed" : "#".$_REQUEST['epage'];
?>
<?php echo $this->fetch('./inc/title.html'); ?>
<div class="content">
<!-- 这里是页面内容区 -->

<!--投资借款具体详情-->

<?php echo $this->fetch('./inc/mobile.html'); ?>	
<?php echo $this->fetch('./inc/footer.html'); ?>







