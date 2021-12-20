 <!-- Javascript Files
  ================================================== -->

 
  <!-- Vendor JS -->
  <script src="{{ URL::asset('assets1/vendor/jquery-duotone/jquery.duotone.min.js')}}"></script>
  <script src="{{ asset('assets/js/script.js') }}" type="text/javascript"></script>
  
  <script src="{{ URL::asset('assets1/vendor/marquee/jquery.marquee.min.js')}}"></script>
  
  <!-- Template JS -->
  <script src="{{ URL::asset('assets1/js/init.js')}}"></script>
    <script src="{{ URL::asset('assets1/js/owl.carousel.min.js')}}"></script>
  
  <script type="text/javascript">
    $(".custom-select").each(function() {
  var classes = $(this).attr("class"),
      id      = $(this).attr("id"),
      name    = $(this).attr("name");
  var template =  '<div class="' + classes + '">';
      template += '<span class="custom-select-trigger">' + $(this).attr("placeholder") + '</span>';
      template += '<div class="custom-options">';
      $(this).find("option").each(function() {
        template += '<span class="custom-option ' + $(this).attr("class") + '" data-value="' + $(this).attr("value") + '">' + $(this).html() + '</span>';
      });
  template += '</div></div>';
  
  $(this).wrap('<div class="custom-select-wrapper"></div>');
  $(this).hide();
  $(this).after(template);
});
$(".custom-option:first-of-type").hover(function() {
  $(this).parents(".custom-options").addClass("option-hover");
}, function() {
  $(this).parents(".custom-options").removeClass("option-hover");
});
$(".custom-select-trigger").on("click", function() {
  $('html').one('click',function() {
    $(".custom-select").removeClass("opened");
  });
  $(this).parents(".custom-select").toggleClass("opened");
  event.stopPropagation();
});
$(".custom-option").on("click", function() {
  $(this).parents(".custom-select-wrapper").find("select").val($(this).data("value"));
  $(this).parents(".custom-options").find(".custom-option").removeClass("selection");
  $(this).addClass("selection");
  $(this).parents(".custom-select").removeClass("opened");
  $(this).parents(".custom-select").find(".custom-select-trigger").text($(this).text());
  getEventByDate("elem",$(this).data("value"));
});
function showmenu(){
  $('#notification12').toggle();
}
  </script>
  <script>
$('.shownev').on('click', function(e) {
    //alert();

  $('.mobileslidemenu').toggleClass('mobileslidemenu1');
  $('mobileslidemenu').fadeIn("slow");
});

</script>

<script type="text/javascript">
  $('input:checkbox').click(function() {
 // alert();
  $('.enabled:has(input:checkbox:checked)').addClass('active1');
  $('.selectlable:has(input:checkbox:checked)').addClass('colorblue');
  $('.enabled:has(input:checkbox:not(:checked))').removeClass('active1');
  $('.selectlable:has(input:checkbox:not(:checked))').removeClass('colorblue');
  });

</script>
<script type="text/javascript">
$("#partner-slider").owlCarousel({

        autoplay: false,
        loop: true,
        dots: false,
        items: 4,
        lazyLoad: true,
        navigation: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 3,
                nav: false
            },
            300: {
                items: 1,
               autoplay: true
            },
            400: {
                items: 1,
               autoplay: true
            },
            700: {
                items: 1,
               autoplay: true
            },
            1000: {
                items: 4,
                nav: false
            }
        }
    });
</script>
 @yield('script')
 @yield('script_bottom')
 