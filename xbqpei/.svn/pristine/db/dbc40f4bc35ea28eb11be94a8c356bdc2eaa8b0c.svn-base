$(function () {
    //滚动条

    //图片延迟加载
 //   $(".lazyload").scrollLoading({ container: $(".category2") });
    //点击切换2 3级分类
    $("#category1").niceScroll({ cursorwidth: 0,cursorborder:0 });

    $('.category-box').height($(window).height());

    //点击切换2 3级分类
	var array=new Array();
	$('#category1 li').each(function(){ 
		array.push($(this).position().top);
	});
	
	$('#category1 li').click(function() {
		var index=$(this).index();
		$('#category1').delay(200).animate({scrollTop:array[index]},300);
		$('#category1 li').removeClass('cur');
		$('#category2 li').removeClass('cur');
		$(this).addClass('cur').siblings().removeClass();

		$('.category2').hide();
		$('.category3').show();
		$('.category3 dl').eq(index).show().siblings().hide();

        $('.category3').scrollTop(0);
	});

});


$(function () {
    //滚动条

    //图片延迟加载
 //   $(".lazyload").scrollLoading({ container: $(".category2") });
    //点击切换2 3级分类
    $("#category2").niceScroll({ cursorwidth: 0,cursorborder:0 });

    $('.category-box').height($(window).height());

    //点击切换2 3级分类
	var array=new Array();
	$('#category2 li').each(function(){ 
		array.push($(this).position().top-90);
	});
	
	$('#category2 li').click(function() {
		var index=$(this).index();
		$('#category2').delay(200).animate({scrollTop:array[index]},300);
		$('#category1 li').removeClass('cur');
		$('#category2 li').removeClass('cur');
		$(this).addClass('cur').siblings().removeClass();
		$('.category2').show();
		$('.category3').hide();
		$('.category2 dl').eq(index).show().siblings().hide();
        $('.category2').scrollTop(0);
	});

});
