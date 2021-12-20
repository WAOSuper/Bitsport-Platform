
<!DOCTYPE html>
<html lang="en" >
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Bitsport | Subscription</title>
   <style type="text/css">
      .email {
         display: inline-block;
         text-align: center;
         margin: 0 auto;
         background-color: #F0F4F7;
         border-top: 3px solid #27A9E0;
         border-bottom: 3px solid #27A9E0;
         width: 600px;
         height: 650px;
         margin: 0 auto;
         display: block;
      }

      .logo {
         margin: 0 auto;
         text-align: center;
         display: block;
         margin-top: 30px;
         margin-bottom: 30px;
      }

      .white-container {
         background: #ffffff;
         width: 560px;
         text-align: center;
         margin: 0 auto;
         padding: 10px 0;
         margin-top: -10px; height: 225px;

      }

      h3 {
         font-weight: light;
      }

      .button {
         padding: 18px 25px;
         background-color: #27A9E0;
         border-radius: 30px;
         text-decoration: none;
         color: white;
         text-transform: uppercase;
         font-size: 13px;
         letter-spacing: 1px;
      }

      .link {
         margin-top: 30px;
         text-decoration: none;
         color: #303141;
         display: inline-block;
      }

      .links {
         margin: 0 auto;
         text-align: center;
         display: block;
      }

      .sm {
         max-width: 25px;
         display: inline-block;
         margin: 30px 5px;
      }

      h3 {
         width: 400px;
         margin: 0 auto;
         margin-bottom: 50px;
      }
      .enquiry{
         margin-top: 30px;
      }
      @media screen and (max-width: 768px){
         .email {
            width: 100%;
         }
         .white-container{
            width: 100%;
         }
         h3{
            width: 100%;
         }

      }
   </style>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div style="font-family:Tondo; margin: 20px;">
   <div class="email">
      <img src="{{url('')}}/assets/images/coins/bitplaywide.png" alt="" style="width: 210px;" />
      <!-- <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/615414/Image.jpg"> -->
      <div class="white-container">

         <h1 style="    font-family: 'Ubuntu', sans-serif;">Subscription Confirmation</h1>
         <br>
         <h2 style="font-family: 'Ubuntu', sans-serif;">Hello {{$user}},</h2>

         <hr>
         <h4 style="font-weight: normal; font-size: 15px; line-height: 23px;">Thank you for subscription. You will now receive regular news and updates from our Bitsport.</h4>

      </div>
   </div>
</body>
</html>


