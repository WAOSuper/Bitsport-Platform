@extends('frontend.layouts.master')
@section('head')
    <link href="{{ URL::asset('assets/css/header-footer.css') }}" rel="stylesheet" id="style_components" type="text/css" /> 
     <link href="{{ URL::asset('assets/css/offer.css') }}" rel="stylesheet" id="style_components" type="text/css" />
@endsection
@section('content')


<div class="wrapper background1 main-background">
		<a name="to-top" class="to-top" id="to-top"></a>
		<div class="content-container">
			<div class="middle">
				<div class="container">
					<div class="col-sm-12">
						<div class="middle-content clearfix" style="padding-top: 0">
							<article class="clearfix" style="border: none">
								<div id="mainBlockDesign"><div style="margin: -10px 0px 20px 0px;width: 100%;"><img src="https://s3.amazonaws.com/cdn.coingaming.io/sportsbet/images/Promotions/2017/treble-sportsbet-promo.jpg" width="100%"></div>

									<div class="col-sm-12" style="background:#fff; border: 1px solid #ccc; padding:20px; padding-top:0px; width:1230px;height: 100%;">
									     
									     {!! $promotion->long_description !!}

									     <p style="font-weight: bold" class="MsoNormal"><br></p>

									     <div style="font-weight: bold; margin: 0px 0%; text-align: center">
									          <a href="{{url('sports-pre-live')}}">BET NOW!</a>
									          <br>
									          <br>
									     </div>

									     <div style="font-weight: bold; margin: 0px 0%; text-align: left"></div><b><a href="{{url('promotions')}}" style="background-color: rgb(255, 255, 255); text-align: center; font-family: Oswald, sans-serif; font-weight: bold;">CHECK OUT OTHER BETTING ONGOING OFFERS AND PROMOTIONS &gt;</a></b>
									</div>

									<div style="font-weight: bold"></div>
								</div>

									
							<div><p><br></p></div>
						</article>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>


@endsection