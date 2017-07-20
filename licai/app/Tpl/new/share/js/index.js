$(function(){
	//一段正则，匹配所有_min.的图片src属性
	var test = /_min\./
	//遍历所有的图片节点
	$("img").each(function(index,obj){	
		if(test.test($(this).attr("src"))){
			var reSrc = $(this).attr("src").replace(test,".");
			$(this).attr("src",reSrc)
		}		
	})
})
$(".goback").hover(function() {
$(this).css({"transition":"1s","opacity":"1"});
}, function() {
$(this).css({"transition":"1s","opacity":"0.3"});
});
for(var i=0;i<6;i++){
			$(".money").clone().appendTo(".page1");
		}
		for(var i=0;i<$(".money").length;i++){
			$(".money:eq("+i+")").css("left",100*Math.random()+"%");
		}
$("img").load(function() {
setTimeout(function () {
			$(".p1").css({"transition":"0.3s","transform":"scale(1.3,1.3)","opacity":"1"});
		},200);
		setTimeout(function () {
			$(".p1").css({"transition":"0.3s","transform":"scale(0.8,0.8)","opacity":"1"});
		},400);
		setTimeout(function () {
			$(".p1").css({"transition":"0.3s","transform":"scale(1,1)","opacity":"1"});
		},600);
for(var i=0;i<$(".money").length;i++){
				(function (i) {
					setTimeout(function () {
						$(".money:eq("+i+")").css({"transition":"0.5s","transform":"translateY(360px)","opacity":"0"});	
					//console.log($(".money").length);	
						//	console.log(i);
					},i*30);
				})(i);
		}
});


$(".p3_3").hover(function() {
	$(this).css({"transition":"0.5s","transform":"scale(1.1, 1.1)"});
}, function() {
	$(this).css({"transition":"0.5s","transform":"scale(1, 1)"});
});
for(var i=0;i<$(".share_img").length;i++){
	$(".share_img:eq("+i+")").hover(function() {
	$(this).css({"transition":"0.5s","transform":"scale(1.1, 1.1)"});
}, function() {
	$(this).css({"transition":"0.5s","transform":"scale(1, 1)"});
});
}

/*for(var i=0;i<$(".share_img").length;i++){
	$(".share_img:eq("+i+")").click(function() {

});
}*/


function cpu() {
			var fr_m=$(".cpu_input1").val();
			var fr_t=$(".cpu_input2").val();
			var get=(Number(fr_m)*0.002)/12*Number(fr_t);
			var g=Math.round(get*100)/100;
			if (fr_m&&fr_t) {
				console.log(g);
				$(".myget").html("我的佣金:"+g+"元");
			}
			else{
				$(".myget").html("请输入金额,日期");
			}

		}
