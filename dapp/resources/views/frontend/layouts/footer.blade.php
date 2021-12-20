<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

 <footer id="footer" class="footer">
    <div class="footer-info">
        <div class="container">
          <!-- <div class="row">
            <div class="col-md-12">
              <div class="marquee1 customcrow">
                <div class="img1"><img src="{{URL::asset('/')}}{{$banner->partner_1}}" class="img-responsive center-block partner-image"></div>  
                <div class="img1"><img src="{{URL::asset('/')}}{{$banner->partner_2}}" class="img-responsive center-block partner-image"></div> 
                <div class="img1"><img src="{{URL::asset('/')}}{{$banner->partner_3}}" class="img-responsive center-block partner-image"></div> 
                <div class="img1"><img src="{{URL::asset('/')}}{{$banner->partner_4}}" class="img-responsive center-block partner-image"></div>
              </div>
            </div>
          </div> -->
          <div class="footer-info__inner">

            <!-- Footer Logo -->
            <div class="footer-logo footer-logo--has-txt">
             <center> <a href="https://bitsport.io">
                <img src="{{URL::asset('assets1/images/football/logo.png')}}"  class="footer-logo__img"></a>
                <div class="footer-logo__heading">
                  <a href="https://bitsport.io"><h5 class="footer-logo__txt">BitSports</h5></a>
                  <span class="footer-logo__tagline"></span>
                  <!--<img src="{{URL::asset('assets1/images/askgambler.png')}}" style="width:120px; display:inline-block; margin-left:10px;" >-->
                  <img src="{{URL::asset('assets1/images/bitcoin.png')}}" style="width:120px; display:inline-block; margin-left:10px;">
                  <!--<img src="{{URL::asset('assets1/images/plus.png')}}" style="width:56px; display:inline-block; margin-left:10px;">-->
                </div>
              </center>
            </div>
            <!-- Footer Logo / End -->

            <!--Start of Tawk.to Script-->

<!--End of Tawk.to Script-->

            <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-134625368-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-134625368-1');
</script>

    
            <!-- Info Block -->
            <div class="info-block info-block--horizontal">
              <div class="info-block__item info-block__item--helmet width50a">
               <h6 class="info-block__heading">Sports</h6>

                  <ul class="footerul">
                   <li><a href="#">Promotions</a></li>
                    <li><a href="#">In play</a></li>
                    <li><a href="#">Upcoming</a></li>
                    <li><a href="/register/creator">Creator</a></li>
                    <li><a href="/register/moderator">Moderator</a></li>
                  </ul>
              </div>
              <div class="info-block__item width50a">
                <svg role="img" class="df-icon df-icon--football-ball">
                  <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="assets/images/football/icons-football.svg#football-ball"></use>
                </svg>
               <h6 class="info-block__heading">About</h6>
               <ul class="footerul">
                   <li><a href="https://www.bitsport.gg/content/about"> About us</a></li>
                    <li><a href="https://www.bitsport.gg/content/privacy_policy"> Privacy policy</a></li>
                    <li><a href="https://www.bitsport.gg/content/terms_condition"> Terms & Condition</a></li>   
                </ul>
                    
              </div>
              <div class="info-block__item info-block__item--social">
                 <ul class="social-links social-links--circle">
                      <li class="social-links__item">
                        <a href="https://www.twitter.com/bitsportgaming" class="social-links__link" target="_blank"><i class="fa fa-twitter"></i></a>
                      </li>
                      <li class="social-links__item">
                        <a href="http://twitch.com/bitsport" class="social-links__link" target="_blank"><i class="fa fa-twitch"></i></a>
                      </li>
                      <li class="social-links__item">
                        <a href="https://www.instagram.com/bitsport/" class="social-links__link" target="_blank"><i class="fa fa-instagram"></i></a>
                      </li>
                      <li class="social-links__item">
                        <a href="https://t.me/bitsport_finance" class="social-links__link" target="_blank"><i class="fa fa-telegram"></i></a>
                      </li>
                    </ul>
                  <br>
                  <h3 class="theme-color font-weight-bold mt-0">Subscribe to our newsletter</h3>
                  <p class="mt-4">Subscribe here and we will keep you  up to date on our project and offers</p>
                  <form class="form-subscribe mt-4">
                      <div class="input-group">
                          <input type="text" id="subscribe_email" class="form-control input-lg" placeholder="Enter E-mail">
                          <span class="input-group-btn">
                              <button onclick="addSubscribe()"  class="btn btn-success btn-lg" type="button" style="padding: 10px 30px;"><i class="fa fa-envelope"></i> </button>
                          </span>
                      </div>
                  </form>
              </div> 
            </div>
            <!-- Info Block / End -->
    <iframe src="https://discordapp.com/widget?id=551067975625605140&theme=dark" width="250" height="300" allowtransparency="true" frameborder="0"></iframe>
          </div>
              <h6>© 2020 BitSport, All rights reserved.</h6>
        </div>
      </div>
     
     
    </footer>

 
<div class="modal fade product_view" id="betingplace" >
    <div class="modal-dialog">
        <div class="modal-content modelcontent-main">
            <div class="modal-header">
                <a href="#" data-dismiss="modal" class="class pull-right"><span class="glyphicon glyphicon-remove removepopup"></span></a>
                <h3 class="modal-title">Please Confirm Your Bet</h3>
            </div>
            <form action="{{url('/')}}/confirmbet" id="betingplaceform" method="post" accept-charset="utf-8">
            <div class="modal-body">
                <div class="row betsPopUp">
                  <div class="content">
                
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="table">
                     
                  </div>
                <div class="row totalstackdiv">
                    <h3 class="ttextbottom">Total Stake :- <span class="totoelstack" id="total_stake">0.00</span></h3>

                </div>
                <div class="row buttonbottompopup">
                      <span class="spanpopup">Potential Win: <span id="total_pot_win"> 0.00 </span> BTP</span>
                  </div>
                
              
            </div>
                   
                    <div class="col-md-12 product_content">
                        
                        <div class="btn-ground">
                          <div class="col-md-6">
                            <button type="submit" class="btn btn-primary popupbutton">Confirm Bet</button>
                          </div>
                          <div class="col-md-6">
                            <button type="button" class="btn btn-primary popupbutton" data-dismiss="modal">Cancel</button>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
          </form>
        </div>
    </div>
</div>

<div class="modal fade product_view" id="betingMplace" >
    <div class="modal-dialog">
        <div class="modal-content modelcontent-main">
            <div class="modal-header">
                <a href="#" data-dismiss="modal" class="class pull-right"><span class="glyphicon glyphicon-remove removepopup"></span></a>
                <h3 class="modal-title">Please Confirm Your Bet</h3>
            </div>
            <form action="{{url('/')}}/confirmMbet" id="mbetingplaceform" method="post" accept-charset="utf-8">
            <div class="modal-body">
                <div class="row betsPopUp">
                  <div class="content">
                
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="table">
                     
                  </div>
                <div class="row totalstackdiv">
                    <h3 class="ttextbottom">Total Stake :- <span class="totoelstack" id="mtotal_stake">0.00</span></h3>

                </div>
                <div class="row buttonbottompopup">
                      <span class="spanpopup">Potential Win: <span id="mtotal_pot_win"> 0.00 </span> BTP</span>
                  </div>
            </div>
                    <div class="col-md-12 product_content">
                        
                        <div class="btn-ground">
                          <div class="col-md-6">
                            <button type="submit" class="btn btn-primary popupbutton">Confirm Bet</button>
                          </div>
                          <div class="col-md-6">
                            <button type="button" class="btn btn-primary popupbutton" data-dismiss="modal">Cancel</button>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
          </form>
        </div>
    </div>
</div>
<div class="modal fade in" style="display: none;" id="profileModal" class="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel">
</div>
<div class="modal fade" style="display: none;" id="acceptProfileModal" tabindex="-1" role="dialog" aria-labelledby="acceptProfileModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="acceptProfileModalLabel">Accept Challenge</h4>
            </div>
            <div class="modal-body mainsectionbg">
                <div class="row">
                    <div class="col-md-12 profile-rules-container">
                        <div class="col-md-4">Rules Proposed by Creator :</div>
                        <div class="col-md-8" id="profile-rules-c"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group col-md-12">
                            <label for="rules" class="control-label">Proposed rules and settings (optional):</label>
                            <textarea id="rules" class="form-control" placeholder="Write rules here..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="profile-confirm">Accept</button>
            </div>
        </div>
    </div>
</div>
<script src="{{ URL::asset('assets/js/bootstrap-autocomplete.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pagination.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/socket.io.js') }}"></script>
<script src="{{ URL::asset('assets/js/chat.service.js') }}"></script>
<script src="{{ URL::asset('assets/js/chat.controller.js') }}"></script>
<script src="{{ URL::asset('assets/js/activity.controller.js') }}"></script>
<script src="{{ URL::asset('assets/js/sweetalert.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/js/profile.js') }}"></script>
<script src="https://js.pusher.com/5.1/pusher.min.js"></script>
<script src="{{ URL::asset('assets/js/push.min.js') }}"></script>
@if(Sentinel::check())
<script type="text/javascript" charset="utf-8" async defer>
  var socketUrl = "{{\config('chat.socket.url')}}";
  var token = "{{csrf_token()}}";
  new loadChats(socketUrl, false, token);
  new loadActivities(socketUrl, false, token);  
  document.addEventListener('DOMContentLoaded', function () {
      Push.Permission.request(function(){}, onDenied);    
  });
  function onDenied(){
    setInterval(function(){
      new loadChats(socketUrl, true);
      new loadActivities(socketUrl, true);
    },3000);
  }
  var pusher = new Pusher("{{env('PUSHER_APP_KEY')}}", {
    cluster: 'ap2',
    forceTLS: true,
    authEndpoint: "{{route('pusher.auth')}}", // just a helper method to create a link
      auth: {
        headers: {
          'X-CSRF-Token': token // CSRF token
        }
      }
  });
  var channel = pusher.subscribe("private-user.{{Sentinel::check()->id}}");
</script>
<script src="{{ URL::asset('assets/js/notification.service.js') }}"></script>
@endif
<script type="text/javascript" charset="utf-8" async defer>

    function addSubscribe()
    {
         var email = $("#subscribe_email").val();
         var _token="{{csrf_token()}}";           
        if(email!='')
        {
           // alert('Yes Email');
          if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))
          {
          $.ajax({    
              type:'post',
              data: { 'email': email, '_token':_token},
              dataType: 'json',
              headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
              url:'{{url("email-subscribe")}}',
              success:function(data){
                console.log(data);
                if(data==0)
                {  
                  // console.log(data);
                  $("#subscribe_email").val('');
                  swal("Warning", "You email address was already subscribed!", "warning");
                }
                else if(data==1)
                {
                  console.log(data);
                  $("#subscribe_email").val('');
                  swal("Success", "Your subscribption done successfully!", "success");
                }
                else
                {
                   swal("Error", "Oops! Something went wrong, Please try again.", "error");
                }
              }

            });

         }
         else{
            swal("Warning", "Enter valid email address.", "warning");
         }
      }
      else{
        // alert('No Email');
        swal("Error", "Please enter email address first.", "warning");
      }
    }
</script>