jQuery(document).ready(function($) {

  $('#default').click(function(){

    var linkcss = 'https://old4.commonsupport.com/appway/wp-content/themes/appway/assets/';

    $('link[rel*=jquery]').remove();

    $('head').append('<link rel="stylesheet jquery" href="'+linkcss+'css/color.php?main_color=fb4848" type="text/css" />');

    return false;

  });



  $('#color2').click(function(){

    var linkcss = 'https://old4.commonsupport.com/appway/wp-content/themes/appway/assets/';

	$('link[rel*=jquery]').remove();

    $('head').append('<link rel="stylesheet jquery" href="'+linkcss+'css/color.php?main_color=ba0505" type="text/css" />');

	return false;

  });



  $('#color3').click(function(){

    var linkcss = 'https://old4.commonsupport.com/appway/wp-content/themes/appway/assets/';

    $('link[rel*=jquery]').remove();

    $('head').append('<link rel="stylesheet jquery" href="'+linkcss+'css/color.php?main_color=ec10fa" type="text/css" />');

	return false;

  });

  

  $('#color4').click(function(){

    var linkcss = 'https://old4.commonsupport.com/appway/wp-content/themes/appway/assets/';

    $('link[rel*=jquery]').remove();

    $('head').append('<link rel="stylesheet jquery" href="'+linkcss+'css/color.php?main_color=610287" type="text/css" />');

	return false;

  });

  
  $('#color5').click(function(){

    var linkcss = 'https://old4.commonsupport.com/appway/wp-content/themes/appway/assets/';

    $('link[rel*=jquery]').remove();

    $('head').append('<link rel="stylesheet jquery" href="'+linkcss+'css/color.php?main_color=3064ee" type="text/css" />');

	return false;

  });


    $('#color6').click(function(){

    var linkcss = 'https://old4.commonsupport.com/appway/wp-content/themes/appway/assets/';

    $('link[rel*=jquery]').remove();

    $('head').append('<link rel="stylesheet jquery" href="'+linkcss+'css/color.php?main_color=a50da8" type="text/css" />');

	return false;

  });


  $('#color7').click(function(){

    var linkcss = 'https://old4.commonsupport.com/appway/wp-content/themes/appway/assets/';

    $('link[rel*=jquery]').remove();

    $('head').append('<link rel="stylesheet jquery" href="'+linkcss+'css/color.php?main_color=fa2a2a" type="text/css" />');

	return false;

  });
  



  $('#color8').click(function(){

    var linkcss = 'https://old4.commonsupport.com/appway/wp-content/themes/appway/assets/';

    $('link[rel*=jquery]').remove();

    $('head').append('<link rel="stylesheet jquery" href="'+linkcss+'css/color.php?main_color=47fff6" type="text/css" />');

	return false;

  });


  $('#color9').click(function(){

    var linkcss = 'https://old4.commonsupport.com/appway/wp-content/themes/appway/assets/';

    $('link[rel*=jquery]').remove();

    $('head').append('<link rel="stylesheet jquery" href="'+linkcss+'css/color.php?main_color=b8276d" type="text/css" />');

	return false;

  });

	

  $('#color10').click(function(){

    var linkcss = 'https://old4.commonsupport.com/appway/wp-content/themes/appway/assets/';

    $('link[rel*=jquery]').remove();

    $('head').append('<link rel="stylesheet jquery" href="'+linkcss+'css/color.php?main_color=FF69B1" type="text/css" />');

	return false;

  });	
	

  $('#color11').click(function(){

    var linkcss = 'https://old4.commonsupport.com/appway/wp-content/themes/appway/assets/';

    $('link[rel*=jquery]').remove();

    $('head').append('<link rel="stylesheet jquery" href="'+linkcss+'css/color.php?main_color=73B819" type="text/css" />');

	return false;

  });	
	
	

  $('#color12').click(function(){

    var linkcss = 'https://old4.commonsupport.com/appway/wp-content/themes/appway/assets/';

    $('link[rel*=jquery]').remove();

    $('head').append('<link rel="stylesheet jquery" href="'+linkcss+'css/color.php?main_color=19B8AF" type="text/css" />');

	return false;

  });	
	
	

  if ($.cookie('boxed') == "yes") {

            $("body").addClass("boxed");

        }



  if ($.cookie('boxed') == "no") {

    $("body").removeClass("boxed");

  }

});

/*

jQuery(document).ready(function($) {

	$("#boxed").click(function(e) { 

	e.preventDefault();

	$('body').addClass("boxed");

    $.cookie('boxed','yes', {expires: 7, path: '/'});

	return false;

	});

	$("#full").click(function(e) { 

	e.preventDefault();

	$('body').removeClass("boxed");

    $.cookie('boxed','no', {expires: 7, path: '/'});

	return false;

	});

});
*/

//RTL CLASS 

jQuery(document).ready(function($) {

	$("#rtl").click(function(e) { 

	e.preventDefault();

	$('body').addClass("rtl");

    $.cookie('rtl','yes', {expires: 7, path: '/'});

	return false;

	});

	$("#normal").click(function(e) { 

	e.preventDefault();

	$('body').removeClass("rtl");

    $.cookie('rtl','no', {expires: 7, path: '/'});

	return false;

	});

});


jQuery(document).ready(function($) {

	$(".switcher .fa-cog").click(function(e) { 

	e.preventDefault();

	$(".switcher").toggleClass("active");

	});

});
/*This file was exported by "Export WP Page to Static HTML" plugin which created by ReCorp (https://myrecorp.com) */