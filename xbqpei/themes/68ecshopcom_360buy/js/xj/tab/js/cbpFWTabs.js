;( function( window ) {
	
	'use strict';

	function extend( a, b ) {
		for( var key in b ) { 
			if( b.hasOwnProperty( key ) ) {
				a[key] = b[key];
			}
		}
		return a;
	}

	function CBPFWTabs( el, options ) {
		this.el = el;
		this.options = extend( {}, this.options );
  		extend( this.options, options );
  		this._init();
	}

	CBPFWTabs.prototype.options = {
		start : 0
	};
  
	CBPFWTabs.prototype._init = function() {
		// tabs elems
		this.tabs = [].slice.call( this.el.querySelectorAll( 'nav > ul > li' ) );
		// content items
		this.items = [].slice.call( this.el.querySelectorAll( '.content-wrap > section' ) );
		// current index
		this.current = -1;
		// show current content item
		this._show();
		// init events
		this._initEvents();
	};
    var carbody=["themes/68ecshopcom_360buy/js/xj/车身/中网.png","themes/68ecshopcom_360buy/js/xj/车身/保险杠.png","themes/68ecshopcom_360buy/js/xj/车身/倒车镜.png","themes/68ecshopcom_360buy/js/xj/车身/前大灯.png","themes/68ecshopcom_360buy/js/xj/车身/前挡风玻璃.png","themes/68ecshopcom_360buy/js/xj/车身/发动机盖.png","themes/68ecshopcom_360buy/js/xj/车身/后挡风玻璃.png","themes/68ecshopcom_360buy/js/xj/车身/后视镜.png","themes/68ecshopcom_360buy/js/xj/车身/天窗.png","themes/68ecshopcom_360buy/js/xj/车身/尾灯.png","themes/68ecshopcom_360buy/js/xj/车身/座骑.png","themes/68ecshopcom_360buy/js/xj/车身/燃油箱门.png","themes/68ecshopcom_360buy/js/xj/车身/牌照架.png","themes/68ecshopcom_360buy/js/xj/车身/翼子板.png","themes/68ecshopcom_360buy/js/xj/车身/行旅箱盖.png","themes/68ecshopcom_360buy/js/xj/车身/车门拉手.png","themes/68ecshopcom_360buy/js/xj/车身/车门玻璃.png","themes/68ecshopcom_360buy/js/xj/车身/车门.png","themes/68ecshopcom_360buy/js/xj/车身/车顶.png","themes/68ecshopcom_360buy/js/xj/车身/边角玻璃.png","themes/68ecshopcom_360buy/js/xj/车身/雨刮器.png","themes/68ecshopcom_360buy/js/xj/车身/雾灯.png"];
	var fadong=["themes/68ecshopcom_360buy/js/xj/发动机系统/凸轮轴齿轮.png","themes/68ecshopcom_360buy/js/xj/发动机系统/凸轮轴.png","themes/68ecshopcom_360buy/js/xj/发动机系统/发动机润滑油加注盖.png","themes/68ecshopcom_360buy/js/xj/发动机系统/发动机盖罩.png","themes/68ecshopcom_360buy/js/xj/发动机系统/发电机皮带.png","themes/68ecshopcom_360buy/js/xj/发动机系统/发电机.png","themes/68ecshopcom_360buy/js/xj/发动机系统/喷油器.png","themes/68ecshopcom_360buy/js/xj/发动机系统/平衡重.png","themes/68ecshopcom_360buy/js/xj/发动机系统/曲轴.png","themes/68ecshopcom_360buy/js/xj/发动机系统/机油尺.png","themes/68ecshopcom_360buy/js/xj/发动机系统/机油滤清器.png","themes/68ecshopcom_360buy/js/xj/发动机系统/正时皮带.png","themes/68ecshopcom_360buy/js/xj/发动机系统/气门弹簧.png","themes/68ecshopcom_360buy/js/xj/发动机系统/气门.png","themes/68ecshopcom_360buy/js/xj/发动机系统/汽缸盖罩.png","themes/68ecshopcom_360buy/js/xj/发动机系统/油压传感器.png","themes/68ecshopcom_360buy/js/xj/发动机系统/油底壳.png","themes/68ecshopcom_360buy/js/xj/发动机系统/活塞环.png","themes/68ecshopcom_360buy/js/xj/发动机系统/活塞.png","themes/68ecshopcom_360buy/js/xj/发动机系统/涡轮增压器.png","themes/68ecshopcom_360buy/js/xj/发动机系统/火花塞.png","themes/68ecshopcom_360buy/js/xj/发动机系统/点火线圈.png","themes/68ecshopcom_360buy/js/xj/发动机系统/空气压缩机.png","themes/68ecshopcom_360buy/js/xj/发动机系统/节气门.png","themes/68ecshopcom_360buy/js/xj/发动机系统/起动机.png","themes/68ecshopcom_360buy/js/xj/发动机系统/连杆.png","themes/68ecshopcom_360buy/js/xj/发动机系统/飞轮.png","themes/68ecshopcom_360buy/js/xj/发动机系统/高压点火线.png","themes/68ecshopcom_360buy/js/xj/发动机系统/齿轮室盖.png","themes/68ecshopcom_360buy/js/xj/发动机系统/EGR冷却器.png","themes/68ecshopcom_360buy/js/xj/发动机系统/EGR阀.png"];
	var chuandon=["themes/68ecshopcom_360buy/js/xj/传动系统/万向节.png","themes/68ecshopcom_360buy/js/xj/传动系统/主减速器.png","themes/68ecshopcom_360buy/js/xj/传动系统/传动轴.png","themes/68ecshopcom_360buy/js/xj/传动系统/倒挡离合器.png","themes/68ecshopcom_360buy/js/xj/传动系统/分动器输出轴.png","themes/68ecshopcom_360buy/js/xj/传动系统/分动器.png","themes/68ecshopcom_360buy/js/xj/传动系统/半轴.png","themes/68ecshopcom_360buy/js/xj/传动系统/变速器第一轴.png","themes/68ecshopcom_360buy/js/xj/传动系统/变速器行星齿轮.png","themes/68ecshopcom_360buy/js/xj/传动系统/变速器.png","themes/68ecshopcom_360buy/js/xj/传动系统/同步器.png","themes/68ecshopcom_360buy/js/xj/传动系统/差速器行星齿轮.png","themes/68ecshopcom_360buy/js/xj/传动系统/差速器轴.png","themes/68ecshopcom_360buy/js/xj/传动系统/差速器.png","themes/68ecshopcom_360buy/js/xj/传动系统/液力变矩器.png","themes/68ecshopcom_360buy/js/xj/传动系统/液力耦合器.png","themes/68ecshopcom_360buy/js/xj/传动系统/液压泵.png","themes/68ecshopcom_360buy/js/xj/传动系统/离合器从动盘.png","themes/68ecshopcom_360buy/js/xj/传动系统/离合器压盘.png","themes/68ecshopcom_360buy/js/xj/传动系统/锁止离合器.png","themes/68ecshopcom_360buy/js/xj/传动系统/驱动桥.png",];
	var xinshi=["themes/68ecshopcom_360buy/js/xj/行驶系统/保险杠衬铁.png","themes/68ecshopcom_360buy/js/xj/行驶系统/减震器弹簧.png","themes/68ecshopcom_360buy/js/xj/行驶系统/减震器支座.png","themes/68ecshopcom_360buy/js/xj/行驶系统/前桥.png","themes/68ecshopcom_360buy/js/xj/行驶系统/后桥.png","themes/68ecshopcom_360buy/js/xj/行驶系统/后横梁.png","themes/68ecshopcom_360buy/js/xj/行驶系统/悬架弹簧.png","themes/68ecshopcom_360buy/js/xj/行驶系统/悬架支臂.png","themes/68ecshopcom_360buy/js/xj/行驶系统/悬架连杆.png","themes/68ecshopcom_360buy/js/xj/行驶系统/横向稳定器.png","themes/68ecshopcom_360buy/js/xj/行驶系统/纵梁.png","themes/68ecshopcom_360buy/js/xj/行驶系统/车架.png","themes/68ecshopcom_360buy/js/xj/行驶系统/车身高度控制阀.png","themes/68ecshopcom_360buy/js/xj/行驶系统/轮圈.png","themes/68ecshopcom_360buy/js/xj/行驶系统/轮毂.png","themes/68ecshopcom_360buy/js/xj/行驶系统/轮胎.png",];
	var lenque=["themes/68ecshopcom_360buy/js/xj/冷却系统/储液干燥器.png","themes/68ecshopcom_360buy/js/xj/冷却系统/冷凝器电子扇电机.png","themes/68ecshopcom_360buy/js/xj/冷却系统/冷凝器.png","themes/68ecshopcom_360buy/js/xj/冷却系统/加热器单元.png","themes/68ecshopcom_360buy/js/xj/冷却系统/加热器芯.png","themes/68ecshopcom_360buy/js/xj/冷却系统/散热器风扇电机.png","themes/68ecshopcom_360buy/js/xj/冷却系统/散热器.png","themes/68ecshopcom_360buy/js/xj/冷却系统/暖风电机.png","themes/68ecshopcom_360buy/js/xj/冷却系统/水泵.png","themes/68ecshopcom_360buy/js/xj/冷却系统/水管.png","themes/68ecshopcom_360buy/js/xj/冷却系统/温度调节器.png","themes/68ecshopcom_360buy/js/xj/冷却系统/空调压缩机.png","themes/68ecshopcom_360buy/js/xj/冷却系统/空调控制单元.png","themes/68ecshopcom_360buy/js/xj/冷却系统/空调滤芯.png","themes/68ecshopcom_360buy/js/xj/冷却系统/空调管支架.png","themes/68ecshopcom_360buy/js/xj/冷却系统/空调管.png","themes/68ecshopcom_360buy/js/xj/冷却系统/膨胀水箱.png","themes/68ecshopcom_360buy/js/xj/冷却系统/膨胀阀.png","themes/68ecshopcom_360buy/js/xj/冷却系统/蒸发器.png","themes/68ecshopcom_360buy/js/xj/冷却系统/集液器.png","themes/68ecshopcom_360buy/js/xj/冷却系统/集风罩.png","themes/68ecshopcom_360buy/js/xj/冷却系统/风扇支架.png","themes/68ecshopcom_360buy/js/xj/冷却系统/风扇.png","themes/68ecshopcom_360buy/js/xj/冷却系统/鼓风机.png"];
	var zhidon=["themes/68ecshopcom_360buy/js/xj/制动系统/制动分泵.png","themes/68ecshopcom_360buy/js/xj/制动系统/制动器活塞.png","themes/68ecshopcom_360buy/js/xj/制动系统/制动器防尘罩.png","themes/68ecshopcom_360buy/js/xj/制动系统/制动器.png","themes/68ecshopcom_360buy/js/xj/制动系统/制动总泵.png","themes/68ecshopcom_360buy/js/xj/制动系统/制动片.png","themes/68ecshopcom_360buy/js/xj/制动系统/制动盘.png","themes/68ecshopcom_360buy/js/xj/制动系统/制动真空助力器.png","themes/68ecshopcom_360buy/js/xj/制动系统/制动踏板支架.png","themes/68ecshopcom_360buy/js/xj/制动系统/制动踏板.png","themes/68ecshopcom_360buy/js/xj/制动系统/制动蹄片.png","themes/68ecshopcom_360buy/js/xj/制动系统/制动钳.png","themes/68ecshopcom_360buy/js/xj/制动系统/刹车油管.png","themes/68ecshopcom_360buy/js/xj/制动系统/手刹拉柄.png","themes/68ecshopcom_360buy/js/xj/制动系统/手刹拉线.png","themes/68ecshopcom_360buy/js/xj/制动系统/磨耗传感器.png","themes/68ecshopcom_360buy/js/xj/制动系统/ABS泵.png","themes/68ecshopcom_360buy/js/xj/制动系统/ABS电脑.png","themes/68ecshopcom_360buy/js/xj/制动系统/ABS继电器.png"];
	var zhuanxiang=["themes/68ecshopcom_360buy/js/xj/转向系统/动力缸.png","themes/68ecshopcom_360buy/js/xj/转向系统/方向盘.png","themes/68ecshopcom_360buy/js/xj/转向系统/横拉杆球头.png","themes/68ecshopcom_360buy/js/xj/转向系统/直拉杆球头.png","themes/68ecshopcom_360buy/js/xj/转向系统/转向减震器.png","themes/68ecshopcom_360buy/js/xj/转向系统/转向助力泵轮.png","themes/68ecshopcom_360buy/js/xj/转向系统/转向助力泵.png","themes/68ecshopcom_360buy/js/xj/转向系统/转向器.png","themes/68ecshopcom_360buy/js/xj/转向系统/转向柱.png","themes/68ecshopcom_360buy/js/xj/转向系统/转向油管.png","themes/68ecshopcom_360buy/js/xj/转向系统/转向油罐.png","themes/68ecshopcom_360buy/js/xj/转向系统/转向直拉杆.png","themes/68ecshopcom_360buy/js/xj/转向系统/转向节臂.png","themes/68ecshopcom_360buy/js/xj/转向系统/转向节.png","themes/68ecshopcom_360buy/js/xj/转向系统/转向轴.png"];
	var gonyou=["themes/68ecshopcom_360buy/js/xj/供油系统/压力补偿器.png","themes/68ecshopcom_360buy/js/xj/供油系统/回油管.png","themes/68ecshopcom_360buy/js/xj/供油系统/油位传感器.png","themes/68ecshopcom_360buy/js/xj/供油系统/油气分离器.png","themes/68ecshopcom_360buy/js/xj/供油系统/活性炭罐.png","themes/68ecshopcom_360buy/js/xj/供油系统/燃油压力调节器.png","themes/68ecshopcom_360buy/js/xj/供油系统/燃油泵.png","themes/68ecshopcom_360buy/js/xj/供油系统/燃油滤清器.png","themes/68ecshopcom_360buy/js/xj/供油系统/燃油箱.png","themes/68ecshopcom_360buy/js/xj/供油系统/燃油高压油管.png","themes/68ecshopcom_360buy/js/xj/供油系统/进油管.png"];
	var jinpaiqi=["themes/68ecshopcom_360buy/js/xj/进排气系统/中冷器.png","themes/68ecshopcom_360buy/js/xj/进排气系统/中段消声器.png","themes/68ecshopcom_360buy/js/xj/进排气系统/催化转换器.png","themes/68ecshopcom_360buy/js/xj/进排气系统/排气歧管.png","themes/68ecshopcom_360buy/js/xj/进排气系统/排气温度传感器.png","themes/68ecshopcom_360buy/js/xj/进排气系统/排气管前段.png","themes/68ecshopcom_360buy/js/xj/进排气系统/排气管吊耳.png","themes/68ecshopcom_360buy/js/xj/进排气系统/排气管尾喉.png","themes/68ecshopcom_360buy/js/xj/进排气系统/排气连接管.png","themes/68ecshopcom_360buy/js/xj/进排气系统/氧传感器.png","themes/68ecshopcom_360buy/js/xj/进排气系统/消声器.png","themes/68ecshopcom_360buy/js/xj/进排气系统/空气流量计.png","themes/68ecshopcom_360buy/js/xj/进排气系统/空气滤清器.png","themes/68ecshopcom_360buy/js/xj/进排气系统/空气谐振器.png","themes/68ecshopcom_360buy/js/xj/进排气系统/进气分配阀.png","themes/68ecshopcom_360buy/js/xj/进排气系统/进气歧管.png","themes/68ecshopcom_360buy/js/xj/进排气系统/进气温度传感器.png","themes/68ecshopcom_360buy/js/xj/进排气系统/进气管.png",];

	CBPFWTabs.prototype._initEvents = function() {
		var self = this;
		this.tabs.forEach( function( tab, idx ) {
			/*tab.addEventListener( 'click', function( ev ) {
				ev.preventDefault();
				self._show( idx );
			});*/
			tab.onmouseover= function( ev ) {
				ev.preventDefault();
				self._show( idx );
			} ;
		} );
	};
	for (var i=0;i<carbody.length;i++){
		var cbody=carbody[i];
		var ah=carbody[i].substring(carbody[i].lastIndexOf("/")+1,carbody[i].lastIndexOf(".png"));
		$("#section-bar-2 ul").append('<li style="cursor:pointer;float:left;width:80px;height:80px; margin:10px 25px;"><img width="80%" height="80%" title="'+ah+'" src='+cbody+'><h5 style="width:80px;height:19px;white-space:nowrap;overflow:hidden;">'+ah+'</h5></li>');
	}
	for (var i=0;i<fadong.length;i++){
		var fa=fadong[i];
		var bh=fadong[i].substring(fadong[i].lastIndexOf("/")+1,fadong[i].lastIndexOf(".png"));
		$("#section-bar-3 ul").append('<li style="cursor:pointer;float:left;width:80px;height:80px; margin:10px 25px;"><img width="80%" height="80%" title="'+bh+'" src='+fa+'><h5 style="text-overflow:ellipsis;width:80px;height:19px;white-space:nowrap;overflow:hidden;">'+bh+'</h5></li>');
	}
	for (var i=0;i<chuandon.length;i++){
		var chuan=chuandon[i];
		var ch=chuandon[i].substring(chuandon[i].lastIndexOf("/")+1,chuandon[i].lastIndexOf(".png"));
		$("#section-bar-4 ul").append('<li style="cursor:pointer;float:left;width:80px;height:80px; margin:10px 25px;"><img width="80%" height="80%" title="'+ch+'" src='+chuan+'><h5 style="text-overflow:ellipsis;width:80px;height:19px;white-space:nowrap;overflow:hidden;">'+ch+'</h5></li>');
	}
	for (var i=0;i<xinshi.length;i++){
		var xin=xinshi[i];
		var dh=xin.substring(xin.lastIndexOf("/")+1,xin.lastIndexOf(".png"));
		$("#section-bar-5 ul").append('<li style="cursor:pointer;float:left;width:80px;height:80px; margin:10px 25px;"><img width="80%" height="80%" title="'+dh+'" src='+xin+'><h5 style="text-overflow:ellipsis;width:80px;height:19px;white-space:nowrap;overflow:hidden;">'+dh+'</h5></li>');
	}
	for (var i=0;i<lenque.length;i++){
		var len=lenque[i];
		var eh=len.substring(len.lastIndexOf("/")+1,len.lastIndexOf(".png"));
		$("#section-bar-6 ul").append('<li style="cursor:pointer;float:left;width:80px;height:80px; margin:10px 25px;"><img width="80%" height="80%" title="'+eh+'" src='+len+'><h5 style="text-overflow:ellipsis;width:80px;height:19px;white-space:nowrap;overflow:hidden;">'+eh+'</h5></li>');
	}
	for (var i=0;i<zhidon.length;i++){
		var zhi=zhidon[i];
		var fh=zhi.substring(zhi.lastIndexOf("/")+1,zhi.lastIndexOf(".png"));
		$("#section-bar-7 ul").append('<li style="cursor:pointer;float:left;width:80px;height:80px; margin:10px 25px;"><img width="80%" height="80%" title="'+fh+'" src='+zhi+'><h5 style="text-overflow:ellipsis;width:80px;height:19px;white-space:nowrap;overflow:hidden;">'+fh+'</h5></li>');
	}
	for (var i=0;i<zhuanxiang.length;i++){
		var zhuan=zhuanxiang[i];
		var gh=zhuan.substring(zhuan.lastIndexOf("/")+1,zhuan.lastIndexOf(".png"));
		$("#section-bar-8 ul").append('<li style="cursor:pointer;float:left;width:80px;height:80px; margin:10px 25px;"><img width="80%" height="80%" title="'+gh+'" src='+zhuan+'><h5 style="text-overflow:ellipsis;width:80px;height:19px;white-space:nowrap;overflow:hidden;">'+gh+'</h5></li>');
	}
	for (var i=0;i<gonyou.length;i++){
		var gon=gonyou[i];
		var hh=gon.substring(gon.lastIndexOf("/")+1,gon.lastIndexOf(".png"));
		$("#section-bar-9 ul").append('<li style="cursor:pointer;float:left;width:80px;height:80px; margin:10px 25px;"><img width="80%" height="80%" title="'+hh+'" src='+gon+'><h5 style="text-overflow:ellipsis;width:80px;height:19px;white-space:nowrap;overflow:hidden;">'+hh+'</h5></li>');
	}
	for (var i=0;i<jinpaiqi.length;i++){
		var jin=jinpaiqi[i];
		var ih=jin.substring(jin.lastIndexOf("/")+1,jin.lastIndexOf(".png"));
		$("#section-bar-10 ul").append('<li style="cursor:pointer;float:left;width:80px;height:80px; margin:10px 25px;"><img width="80%" height="80%" title="'+ih+'" src='+jin+'><h5 style="text-overflow:ellipsis;width:80px;height:19px;white-space:nowrap;overflow:hidden;">'+ih+'</h5></li>');
	}
	CBPFWTabs.prototype._show = function( idx ) {
		if( this.current >= 0 ) {
		this.tabs[ this.current ].className = this.items[ this.current ].className = '';
		}
		// change current
		this.current = idx != undefined ? idx : this.options.start >= 0 && this.options.start < this.items.length ? this.options.start : 0;
		this.tabs[ this.current ].className = 'tab-current';
		this.items[ this.current ].className = 'content-current';
	};
	// add to global namespace
	window.CBPFWTabs = CBPFWTabs;
	$("section.nav-content ul li").hover(
		function () {
		$(this).css({"transition":"0.5s","box-shadow":"0px 10px 15px #ddd"});return false;},
		function () {
	    $(this).css({"background":"none","box-shadow":"none"});return false;});

})( window );