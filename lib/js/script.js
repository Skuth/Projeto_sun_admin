$(document).ready(function() {
	var telaHeight = $(document).height() - 74;
	$(".nav_left").height(telaHeight);

	$(".user .user_box ul img").click(function() {
		$(".user .user_box .submenu").fadeToggle();
	});
  $(".nav_mobile #mobile").click(function() {
    $(".nav_left").toggleClass('active');
    $("#mobile i").toggleClass('fa-bars');
    $("#mobile i").toggleClass('fa-close');
    $(".content").toggleClass('active_content');
  });
});
$(window).on('load', function() {
  $('#status').fadeOut();
  $('#preloader').delay(350).fadeOut('slow');
  $('body').delay(350).css({'overflow':'visible'});
});

function abrirJanela(URL){
  var width = 900 ;
  var height = 200;
  
  var left = 100;
  var top = 10;
  
  window.open(URL, 'janela', 'width='+width+', height'+height+', top='+top+', left='+left+',scrollbars=yes,status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');
}