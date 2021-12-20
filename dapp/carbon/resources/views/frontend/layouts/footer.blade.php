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
                   <li><a href="https://www.bitsport.io/content/about"> About us</a></li>
                    <li><a href="https://www.bitsport.io/content/privacy_policy"> Privacy policy</a></li>
                    <li><a href="https://www.bitsport.io/content/terms_condition"> Terms & Condition</a></li>   
                </ul>
                    
              </div>
              <div class="info-block__item info-block__item--social">
                 <center>   <ul class="social-links social-links--circle">
                      <li class="social-links__item">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=http://bitsport.io/" class="social-links__link" target="_blank"><i class="fa fa-facebook"></i></a>
                      </li>
                      <li class="social-links__item">
                        <a href="http://twitter.com/intent/tweet/?url=http://bitsport.io/" class="social-links__link" target="_blank"><i class="fa fa-twitter"></i></a>
                      </li>
                      <li class="social-links__item">
                        <a href="https://www.instagram.com/bitsport/" class="social-links__link" target="_blank"><i class="fa fa-instagram"></i></a>
                      </li>
                      <li class="social-links__item">
                        <a href="https://rss.com/" class="social-links__link" target="_blank"><i class="fa fa-rss"></i></a>
                      </li>
                    </ul>
                  </center>
                  <br>
                  <h3 class="theme-color font-weight-bold mt-0">Subscribe to our newsletter</h3>
                  <p class="mt-4">Subscribe here and we will keep you  up to date on our project and offers</p>
                  <form class="form-subscribe mt-4">
                      <div class="input-group">
                          <input type="text" id="subscribe_email" class="form-control input-lg" placeholder="Enter E-mail">
                          <span class="input-group-btn">
                              <button onclick="addSubscribe()"  class="btn btn-success btn-lg" type="button" style="padding: 16px 30px;"><i class="fa fa-envelope"></i> </button>
                          </span>
                      </div>
                  </form>
              </div> 
            </div>
            <!-- Info Block / End -->
    <iframe src="https://discordapp.com/widget?id=551067975625605140&theme=dark" width="250" height="300" allowtransparency="true" frameborder="0"></iframe>
          </div>
              <h6>© 2018 BitPlay Gaming Limited, All rights reserved.</h6>
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
<script src="{{ URL::asset('assets/js/sweetalert.min.js')}}" type="text/javascript"></script>
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