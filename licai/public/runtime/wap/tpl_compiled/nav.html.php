<ul class="w_b big_classification" style="width:100%;">
	<li class="w_b_f_1 tc">
		<a href="#" onclick="RouterURL('<?php
echo parse_wap_url_tag("u:index|deals|"."epage=".$this->_var['data']['act']."".""); 
?>','#deals'<?php if ($this->_var['is_weixin'] && $this->_var['is_login'] == 0): ?>,1<?php endif; ?>)">
			<p class="icon_parent"><i class="icon iconfont" style="color:#fd5b0c;">&#xe651;</i></p>
			<p class="font">我要理财</p>
		
		<div class="my_bor"></div></a>
	</li>
	<li class="w_b_f_1 tc">
		<a href="#" onclick="RouterURL('<?php
echo parse_wap_url_tag("u:index|transfer|"."epage=".$this->_var['data']['act']."".""); 
?>','#transfer'<?php if ($this->_var['is_weixin'] && $this->_var['is_login'] == 0): ?>,1<?php endif; ?>)">
			<p class="icon_parent"><i class="icon iconfont" style="color:#01658A;">&#xe658;</i></p>
			<p class="font">债权转让</p>
		
		<div class="my_bor"></div></a>
	</li>
	<li class="w_b_f_1 tc">
		<a href="#" onclick="RouterURL('<?php
echo parse_wap_url_tag("u:index|article_list|"."epage=".$this->_var['data']['act']."".""); 
?>','#article_list'<?php if ($this->_var['is_weixin'] && $this->_var['is_login'] == 0): ?>,1<?php else: ?>,2<?php endif; ?>)">
            <p class="icon_parent"><i class="icon iconfont" style="color:#fe3bf3">&#xe639;</i></p>
			<p class="font">帮助中心</p>
		
		<div class="my_bor"></div></a>
	</li>
	<li class="w_b_f_1 tc">
		<a href="#" onclick="RouterURL('<?php
echo parse_wap_url_tag("u:index|integral_mall|"."epage=".$this->_var['data']['act']."".""); 
?>','#integral_mall'<?php if ($this->_var['is_weixin'] && $this->_var['is_login'] == 0): ?>,1<?php else: ?>,2<?php endif; ?>)">
			<p class="icon_parent"><i class="icon iconfont" style="color:#bcfd0c;">&#xe61f;</i></p>
			<p class="font">积分兑换</p>
		
		<div class="my_bor"></div></a>
	</li>
</ul>	

<ul class="w_b big_classification" style="border-top:1px solid #eee;">
	<li class="w_b_f_1 tc">
		<a href="member.php?ctl=uc_incharge">
			<p class="icon_parent"><i class="icon iconfont" style="color:#3290ce">&#xe64e;</i></p>
			<p class="font">我要充值</p>
		
		<div class="my_bor"></div></a>
	</li>
	<li class="w_b_f_1 tc">
		<a href="member.php?ctl=uc_bank" >
			<p class="icon_parent"><i class="icon iconfont" style="color:#2d8a00">&#xe63c;</i></p>
			<p class="font">我要提现</p>
		
		<div class="my_bor"></div></a>
	</li>
	<li class="w_b_f_1 tc">
		<a href="member.php?ctl=uc_qrcode">
            <p class="icon_parent"><i class="icon iconfont" style="color:#fe3b3b">&#xe653;</i></p>
			<p class="font">我要邀请</p>
		
		<div class="my_bor"></div></a>
	</li>
	<li class="w_b_f_1 tc">
		<a href="member.php?ctl=uc_financial_statistics">
			<p class="icon_parent"><i class="icon iconfont" style="color:#9b3bfe">&#xe64b;</i></p>
			<p class="font">理财统计</p>
		
		<div class="my_bor"></div></a>
	</li>
</ul>		