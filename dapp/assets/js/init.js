/** *************Init JS*********************
	
   /**Preloader JS**/
	/**Counter JS**/
	/**Nice Scroll**/
	/**Placeholder JS call**/
	/**Subscribe JS**/
	/**Contact Us JS**/


/*************************************/

/*"use strict";*/

/*************************************/
/* Preloader */
/**************************************/
jQuery(window).load(function() {
    // will first fade out the loading animation
	jQuery(".status").fadeOut();
    // will fade out the whole DIV that covers the website.
	jQuery(".preloader").delay(100).fadeOut("slow");
	jQuery("body").css('overflow-y','visible');
});


/***********************************/
/*Counter JS*/
/**********************************/
var austDay = new Date();
//Set counter date
austDay =  new Date(2019,01,12);
jQuery('#defaultCountdown').countdown({
until: austDay, padZeroes: true,format: 'DHMS'});
jQuery('#year').text(austDay.getFullYear());


/*************************************/
/* Ready Function */
/**************************************/
	
jQuery( document ).ready(function( $ ) {
	$.noConflict();
	
	/*** Auto height function ***/
	var setElementHeight = function () {
		var height = $(window).height();
		$('.autoheight').css('min-height', (height));
		
	};

	$(window).on("resize", function () {
		setElementHeight();
	}).resize();
	
	/* Overlay */
	if (Modernizr.touch) {
	// show the close overlay button
	$(".close-overlay").removeClass("hidden");
	// handle the adding of hover class when clicked
	$(".img").click(function(e){
		if (!$(this).hasClass("hover")) {
			$(this).addClass("hover");
		}
	});
	// handle the closing of the overlay
	$(".close-overlay").click(function(e){
		e.preventDefault();
		e.stopPropagation();
		if ($(this).closest(".img").hasClass("hover")) {
			$(this).closest(".img").removeClass("hover");
		}
	});
	} else {
		// handle the mouseenter functionality
		$(".img").mouseenter(function(){
			$(this).addClass("hover");
		})
		// handle the mouseleave functionality
		.mouseleave(function(){
			$(this).removeClass("hover");
		});
	}
	
	
	/** Menu Close Logic **/
	$('.navbar-collapse.in').niceScroll({cursorcolor:"#c8bd9f"});
		$('.nav li a').click(function(){
			$('.navbar-collapse.collapse').toggleClass('in');
	});	
	/***********************************/
	/*Nice Scroll*/
	/**********************************/
	 $("html").niceScroll();

	/***********************************/
	/*Placeholder JS call*/
	/**********************************/	 
	$('input[type=text], textarea').placeholder();	

	/***********************************/
	/*Subscribe JS*/
	/**********************************/	

	$("#notifyMe").notifyMe(); // Activate notifyMe plugin on a '#notifyMe' element 

	/***********************************/
	/*Contact Us JS*/
	/**********************************/	
	
	$("#submit_btn").click(function() 
	{ 
			
	    var filter = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		
		var e = document.getElementById("field_1");
		var user_type = e.options[e.selectedIndex].text;
		
		/*var e1 = document.getElementById("field_2");
		var registration_purpose = e1.options[e1.selectedIndex].text;
		
		var e2 = document.getElementById("field_3");
		var event_time = e2.options[e2.selectedIndex].text;*/
		
		var person_name = document.getElementById("name").value;
		var user_email = document.getElementById("email1").value;
		
		var proceed = true;
		
		
		if(person_name == ""){ 
            var error1 = '<div class="enter-name col-lg-3 align-center"> Enter the name </div>';
			jQuery("#result").hide().html(error1).fadeIn(500);
			proceed = false;
			return false;
        }
		
        if(user_email== ""){
			var error2 = '<div class="enter-email col-lg-3 align-center"> Enter the email </div>';
			jQuery("#result").hide().html(error2).fadeIn(500);
            proceed = false;
			
		}
		else if(!filter.test(user_email)) {
			var invalid = '<div class="invalid-email col-lg-3 align-center"> Invalid Email </div>';
			jQuery("#result").hide().html(invalid).fadeIn(500);
            proceed = false;
			
        }
	
		if (proceed) //everything looks good! proceed...
		{
			
			//data to be sent to server
			var post_data = {
				'userName': person_name,
				'userType': user_type,
				'userEmail': user_email,

			}
			
			//Ajax post data to server
			jQuery.post('contact_me.php', post_data, function(response) {
				//load json data from server and output message
				if (response.type == 'error') {
					var output = '<div class="error col-lg-3 align-center">' + response.text + '</div>';
				} else {
					var output = '<div class="success col-lg-3 align-center">' + response.text + '</div>';
					//reset values in all input fields
					
				}
				jQuery("#result").hide().html(output).fadeIn(500);
				
			}, 'json');
		}

		return false;
	 
	});
	
	/** Overlay close **/
	$('.md-overlay').click(function(e){
		$("#terms_conditions").removeClass("md-show");
		$("#modal-11").removeClass("md-show");
	});
	

});
