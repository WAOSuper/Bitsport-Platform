<script type="text/javascript">

    $(".placeBtn").attr('disabled',true);
    $(".placeBtnMul").attr('disabled',true);
    // odd click function to show data in above cart
    // multiple bet button click 
    $("#multipleBet").click(function(){
        var stake = $("#multi_stake").val();
        // console.log(stake);
        var multiple_odds = new Array();
        $("#senction2Multiple .odds_v").each(function() {
            multiple_odds.push($(this).html());
        });
        var select_odds = new Array(); 
        $("#senction2Multiple .odds_v").each(function() {
            select_odds.push($(this).attr('id'));
        });
        var single_team1 = new Array(); 
        $("#senction2Multiple .header-cart__product-price").each(function() {
            single_team1.push($(this).html());
        });
        var multi_bet = new Array(); 
        $("#senction2Multiple > li").each(function() {
            multi_bet.push($(this).attr('id'));
        });
        var single_team2 = new Array(); 
        $("#senction2Multiple .header-cart__product-count").each(function() {
            single_team2.push($(this).html());
        });
        var single_odd_master = new Array();
        $("#senction1single .header-cart__product-name a").each(function() {
            single_odd_master.push($(this).html());
        });
        var potential = 0.00;
        var total =0;
        $("#betingMplace .table").html('');
        for(var i=0;i<multiple_odds.length;i++){
            if(stake!=""){
                potential = potential + ( parseFloat(stake) * parseFloat(multiple_odds[i]) );
                total = total + parseFloat(stake);
                var winner =single_team1[i];
                if(select_odds[i]=='odd_1') winner = single_team1[i]; else if(select_odds[i]=='odd_3') winner = single_team2[i];
                $("#betingMplace .table").append('<div class="match cell">\
                    <div class="pull-right model-right"><div class="in-a-month monthcustom"><div class="winp"><span class="potential-win-figure">\
                              Potential Win\
                              <b>'+stake*multiple_odds[i]+' <small class="text-muted">BTP</small></b>\
                            </span></div></div></div>\
                    <div class="name nametitle"><p class="conformbettext">'+single_team1[i]+' v '+single_team2[i]+'</p></div>\
                    <hr class="conformbetline">\
                    <input type="hidden" name="single_value[]" value="'+stake+'">\
                    <input type="hidden" name="multi_bet[]" value="'+multi_bet[i]+'">\
                    <input type="hidden" name="select_odds[]" value="'+select_odds[i]+'">\
                    <div><p class="conformmodeltextinner">'+single_odd_master[i]+' | <span>'+winner+'</span></p></div><br>\
                    <div class="stake"><span class="stake">Stake:</span>\
                        <div class="grey">'+stake+' <small class="text-muted">BTP</small></div>\
                      <div class="green">@Odds: '+multiple_odds[i]+'</div>\
                    </div></div>');
            }
        }
        // console.log(potential);
        $("#mtotal_stake").html((total).toFixed(2));
        $("#mtotal_pot_win").html((potential).toFixed(2));

        if($("#inlineCheckbox4").prop("checked")==false){
            $("#betingMplace").modal('show');
        }
        else{
            $("#mbetingplaceform").submit();
        }

    });
    //multibet close
    // singlebet  button click 
    $("#singleBet").click(function(){
        var single_input = new Array(); 
        $("#senction1single .betting :input:text").each(function() {
            if($(this).val()=="") disable=1; 
            single_input.push($(this).val());
        });
        //console.log(single_input);
        var single_odds = new Array(); 
        $("#senction1single .odds_v").each(function() {
            single_odds.push($(this).html());
        });
        var select_odds = new Array(); 
        $("#senction1single .odds_v").each(function() {
            select_odds.push($(this).attr('id'));
        });
        var single_team1 = new Array(); 
        $("#senction1single .header-cart__product-price").each(function() {
            single_team1.push($(this).html());
        });
        var single_bet = new Array(); 
        $("#senction1single > div").each(function() {
            single_bet.push($(this).attr('id'));
        });
        var single_team2 = new Array();
        $("#senction1single .header-cart__product-count").each(function() {
            single_team2.push($(this).html());
        });
        var single_odd_master = new Array();
        $("#senction1single .header-cart__product-name a").each(function() {
            single_odd_master.push($(this).html());
        });
        var potential = 0.00;
        var total =0;
        $("#betingplace .table").html('');
        for(var i=0;i<single_input.length;i++){
            if(single_input[i]!=""){
                potential = potential + ( parseFloat(single_input[i]) * parseFloat(single_odds[i]) );
                total = total + parseFloat(single_input[i]);
                var winner =single_team1[i];
                if(select_odds[i]=='odd_1') winner = single_team1[i]; else if(select_odds[i]=='odd_3') winner = single_team2[i];
                $("#betingplace .table").append('<div class="match cell">\
                    <div class="pull-right model-right"><div class="in-a-month monthcustom"><div class="winp"><span class="potential-win-figure">\
                              Potential Win\
                              <b>'+single_input[i]*single_odds[i]+' <small class="text-muted">BTP</small></b>\
                            </span></div></div></div>\
                    <div class="name nametitle"><p class="conformbettext">'+single_team1[i]+' v '+single_team2[i]+'</p></div>\
                    <hr class="conformbetline">\
                    <input type="hidden" name="single_value[]" value="'+single_input[i]+'">\
                    <input type="hidden" name="single_bet[]" value="'+single_bet[i]+'">\
                    <input type="hidden" name="select_odds[]" value="'+select_odds[i]+'">\
                    <div><p class="conformmodeltextinner">'+single_odd_master[i]+' | <span> '+winner+' </span></p></div><br>\
                    <div class="stake"><span class="stake">Stake:</span>\
                        <div class="grey">'+single_input[i]+' <small class="text-muted">BTP</small></div>\
                      <div class="green">@Odds: '+single_odds[i]+'</div>\
                    </div></div>');
            }
        }
        $("#total_stake").html((total).toFixed(2));
        $("#total_pot_win").html((potential).toFixed(2));

        if($("#inlineCheckbox2").prop("checked")==false){
            $("#betingplace").modal('show');
        }
        else{
            $("#betingplaceform").submit();
        }
        
    });
    var store_bet = [];
    var balance = ({{$balance}});
    $(".badge-primary").hide();
    var badge = 0;
@if($bets)
    @foreach($bets as $bet)
        var odd_select1 = ({{$bet->bet_on}});
        var odd_val1 = ({{$bet->odds}});
        var odd_id1 = ({{$bet->event_id}});
        var odd_name1 = "{{$bet->team_1_name}}";
        var odd_name2 = "{{$bet->team_2_name}}";
        var odd_name = "{{$bet->odd_name}}";
        var odd_title = "{{$bet->odd_title}}";
        var more_id = ({{$bet->team_id}});
        var team = @if($bet->bet_on ==3) "{{$bet->team_2_name}}" @else "{{$bet->team_1_name}}" @endif;        
        update_cart(odd_select1,odd_val1,odd_id1,odd_name1,odd_name2,team,odd_name, odd_title, more_id);
        
    @endforeach
      localStorage.clear();
@endif
    // localStorage.clear();
  //  console.log(localStorage.betting);     
    if(localStorage.getItem("betting")){
        var olddstore_bet = JSON.parse(localStorage.getItem("betting"));
        $.each(olddstore_bet, function (i) {
            store_bet.push({bet_id:olddstore_bet[i].bet_id,odd_select:olddstore_bet[i].odd_select,odd_id:olddstore_bet[i].odd_id,more_id:olddstore_bet[i].more_id});
            var old_odds = olddstore_bet[i].odd_id.split('|');
            update_cart(old_odds[0], old_odds[1], old_odds[2], old_odds[3], old_odds[4], old_odds[5],old_odds[6],olddstore_bet[i].more_id);
        });
        // console.log(store_bet);
    }
    function update_odd(elem){
         console.log(elem);
        if($(elem).hasClass("pink")){
            $(elem).removeClass('pink')
        }else{
            $(elem).addClass('pink');
        }
        new_odds(elem);
    }
    function new_odds(elem){
        //console.log(elem)
        var odd_select = $(elem).attr('odd-select'); // 123
        var odd_val = $(elem).attr('odd-val'); //
        var odd_id = $(elem).attr('odd-id');  // event id
        var odd_name1 = $(elem).attr('odd-name1'); 
        var odd_name2 = $(elem).attr('odd-name2');
        var odd_title = $(elem).attr('odd_title');
        var attr = $(elem).attr('odd-name');
        if(typeof attr !== typeof undefined && attr !== false) {
            var odd_name = $(elem).attr('odd-name');
            var more_id = $(elem).attr('more-id');
        }else{
            var odd_name ="";
            var more_id =0;
        }
        // var team = (odd_select == 1) ? odd_name1 : odd_name2;
        var team;
        if(odd_select == 1)
            team = odd_name1;
        else if(odd_select == 2)
            team = 'Draw';
        else if(odd_select == 3)
            team = odd_name2;
        
        var betid = odd_id+'-'+odd_select+'-'+more_id;
        $.post("{{url('/')}}/mybets",
        {
            odd_select: odd_select,
            odd_val: odd_val,
            odd_id: betid,
            remove_odd:0,
            odd_name1: odd_name1,
            odd_name2: odd_name2,
            more_id: more_id,
            odd_name: odd_name,
            odd_title: odd_title,
            _token: "{{csrf_token()}}"
        },
        function(data, status){
            if(data>0){
                // console.log("update");
                update_cart(odd_select,odd_val,betid,odd_name1,odd_name2,team,odd_name, odd_title, more_id);
                localStorage.clear();
            }
            else if(data==-1){
            //    console.log("remove");
                remove_cart(betid);
                localStorage.clear();
            }else{
               // console.log(store_bet);
                var check = 0;
                 check = store_bet.filter(function (bet) {if (bet.bet_id == betid ) { return bet }  }); // check which odd selected
                // console.log(check);
               if(check!=0){ 
                        //remove if checked
                        store_bet = store_bet.filter(function(e) {
                            if (e.bet_id != betid ) { return e };
                        });
                        localStorage.setItem("betting", JSON.stringify(store_bet));
                        remove_cart(betid);
                         // console.log("remove")
                         // console.log(store_bet);
                }
                else{
                    var bet_on_one = odd_select+"|"+odd_val+"|"+odd_id+"|"+odd_name1+"|"+odd_name2+"|"+team+"|"+odd_name+"|"+odd_title;
                    update_cart(odd_select,odd_val,odd_id,odd_name1,odd_name2,team,odd_name, odd_title,more_id);
                    store_bet.push({bet_id:betid,odd_select:odd_select,odd_id:bet_on_one,more_id:more_id});
                    //var check = store_bet.filter(function (bet) { if (bet.bet_id == 8) { return 1 } else { return 0 } }); // check which odd selected
                    localStorage.setItem("betting", JSON.stringify(store_bet));
                    
                    // console.log("insert");
                    // console.log(store_bet);
               }
            }
        });

    }
function update_cart(odd_select,odd_val,odd_id,odd_name1,odd_name2,team,odd_name=null, odd_title, more_id)    {
            var bet_id =odd_id+'-'+odd_select+'-'+more_id;
            var bet_id1 ="remove_bet('"+odd_id+"-"+odd_select+"-"+more_id+"')";
            var bet_id2 ="check_odd(this,'"+odd_id+"-"+odd_select+"-"+more_id+"')";
            $("#senction1single").append('<div odd_name="'+odd_name+'" id="bet_'+bet_id+'"><div class="header-cart__inner" >\
                <div class="header-cart__product-sum">\
                  <span class="header-cart__product-price">'+odd_name1+'</span> vs <span class="header-cart__product-count"> '+odd_name2+'</span>\
                </div>\
                <h5 class="header-cart__product-name"><a href="javascript:;">'+odd_title+'</a></h5>\
                <hr style="margin-bottom: 0;">\
                <span class="header-cart__product-price1" style="font-size: 18px;">'+team+' - '+odd_name+'</span> <span id="odd_'+odd_select+'" class="odds_v">'+odd_val+'</span> \
                <div class="fa fa-times header-cart__close" onclick="'+bet_id1+'" ></div>\
              </div>\
              <div class="row" id="bet_c'+bet_id+'" style="margin-top: 9px; margin-bottom: 9px;">\
                <div class="col-md-12 betting">\
                <center><form id="myform" method="POST" action="#">\
                  <button type="button" value="-50" class="qtyminus itemsaddbutton" field="quantity" onclick="'+bet_id2+'" > -50</button>\
                  <button type="button" value="-10" class="qtyminus itemsaddbutton" field="quantity" onclick="'+bet_id2+'" > -10</button>\
                  <input type="text" name="quantity" id="input_'+bet_id+'" onkeyup="return isNotNumberKey('+odd_select+',this);" value="" placeholder="Stake" class="qty itrmaddinput" />\
                  <button type="button" value="10" class="qtyplus itemsaddbutton" field="quantity" onclick="'+bet_id2+'" > +10</button>\
                  <button type="button" value="50" class="qtyminus itemsaddbutton" field="quantity" onclick="'+bet_id2+'" > +50</button>\
                </form></center>\
              </div></div></div></li>');
            
            $("#senction2Multiple").append('<li odd_name="'+odd_name+'" class="header-cart__item" id="mbet_'+bet_id+'">\
              <figure class="header-cart__product-thumb"></figure><div class="header-cart__inner"><h5 class="header-cart__product-name"><a href="javascript:;">'+odd_title+'</a></h5><div class="header-cart__product-sum">\
                  <span class="header-cart__product-price">'+odd_name1+'</span> vs <span class="header-cart__product-count">'+odd_name2+'</span></div>\
                <hr style="margin-bottom: 0;">\
                <span class="header-cart__product-price1" style="font-size: 18px;">'+team+'</span><span id="odd_'+odd_select+'" class="odds_v" >'+odd_val+'</span> \
                <div class="fa fa-times header-cart__close" onclick="remove_bet('+bet_id1+')" ></div>\
              </div>\
            </li>');
            badge++;
            if(badge>0){
                $(".badge-primary").html(badge);
                $(".badge-primary").show();
            }
}
function remove_bet(id){
    $.post("{{url('/')}}/mybets",
        {
            odd_id: id,
            remove_odd:1,
            _token: "{{csrf_token()}}"
        },
        function(data, status){
          //  console.log(data);
          if(data==0)
            remove_from_cart(id);
          else
            remove_cart(id);
        });
}
function remove_from_cart(id){
    store_bet = store_bet.filter(function(e) {
    if (e.bet_id != id ) { return e };
    });
    localStorage.setItem("betting", JSON.stringify(store_bet));
    remove_cart(id);
}
function remove_cart(odd_id){
    // console.log(odd_id);
    $(".badge-primary").addClass('animatiom-eff');
    $("#bet_"+odd_id).remove(); $("#mbet_"+odd_id).remove();
    badge--;
    $(".badge-primary").html(badge);
    if(badge>0) $(".badge-primary").show(); else {$(".badge-primary").hide();$(".placeBtnMul").attr('disabled',true);$(".placeBtn").attr('disabled',true);  }
    // $(".badge-primary").removeClass('animatiom-eff');
}
$(".alert1").fadeOut("slow");
$(".alert2").fadeOut("slow");
$(".alert3").fadeOut("slow");

function final_calculation(){
        var single_input = new Array(); 
        var disable = 0;
        $("#Spotential_win").html("0.00");
        $("#senction1single .betting :input:text").each(function() {
            if($(this).val()=="" || $(this).val()==0) disable=1; 
            else if($(this).val() < 0) disable=1; 
            single_input.push($(this).val());
        });
      //  console.log(single_input);
        var single_odds = new Array(); 
        $("#senction1single .odds_v").each(function() {
            single_odds.push($(this).html());
        });
        var potential = 0.00;
        var total =0;
        for(var i=0;i<single_input.length;i++){
            if(single_input[i]!=""){
                potential = potential + ( parseFloat(single_input[i]) * parseFloat(single_odds[i]) );
                total = total + parseFloat(single_input[i]);
            }
        }
         $("#Spotential_win").html((potential).toFixed(2));
        if(parseFloat(balance) < parseFloat(total) ){ // to enable/diable place button if num of odds is higher than balance
          //      console.log("acc"+disable);
                $(".placeBtn").attr('disabled',true);
                $(".alert1").fadeIn("slow");
                disable =1;
            }else{
            //    console.log("rej"+disable);
                $(".alert1").fadeOut("slow");
            }
        if(disable==1) $(".placeBtn").attr('disabled',true); 
        else $(".placeBtn").attr('disabled',false); 
    }
    function isInteger(x) { return typeof x === "number" && isFinite(x) && Math.floor(x) === x; }
    function check_odd(elem,id,input_val=null){
        var stake = (input_val==null) ? $(elem).val() : input_val;
        var input = $("#input_"+id);
        var check_int = isInteger(stake);
        if(stake==""){
            $(".placeBtn").attr('disabled',true);
            return false;
        }
        stake = check_int ? parseInt(stake) : parseFloat(stake);
    //    console.log(stake);
        if(input.val() == "" && input_val == null && !elem ){
        }else{

            if(input_val==null && input.val()){ // check if inputh has value than add stake on old value
                stake = parseFloat(input.val())+stake;
                input.val(stake);
                // console.log(stake);
            }
            else if(input_val==null || input_val==""){
                stake = parseFloat(stake);
                input.val(stake);
                // console.log(stake);
            }
            else if(input.val() =="")
                input.val(stake);
        final_calculation();
        return false;
        }
    }
// return if character enter
function isNotNumberKey(evt,elem){
    var val = $(elem).val();
    if(isNaN(val)){
         val = val.replace(/[^0-9\.]/g,'');
         if(val.split('.').length>2) 
             val = val.replace(/\.+$/,"");
         $(elem).val(val); 
    }
    check_odd(null,evt,val);
    //console.log(val);
    return true;
}
function isNotNumberKeyMul(elem){
    var val = elem;
    if(isNaN(val)){
        // console.log(val+'if');
         val = val.replace(/[^0-9\.]/g,'');
         if(val.split('.').length>2) 
             val = val.replace(/\.+$/,"");
         $("#multi_stake").val(val); 
    }
    // console.log(val+'val');
    if(val && badge > 0)
        mul_final_calculation(val);
    else{
        $("#Spotential_mul_win").html("0.00");    
        $(".placeBtnMul").attr('disabled',true); 
        $(".alert2").fadeIn("slow");
    }
    return true;
}
function check_oddMultiple(elem){
    var stake = elem; // input value current
    if(stake==""){
        $(".placeBtnMul").attr('disabled',true); 
        return false;
    }
    var check_int = isInteger(stake);
    stake = check_int ? parseInt(stake) : parseFloat(stake);
    var old_stake = $("#multi_stake").val();
    if(old_stake)
        stake = parseFloat(stake)+parseFloat(old_stake);
    $("#multi_stake").val(stake);
    mul_final_calculation(stake);
        return false;
}

function mul_final_calculation(single_input){
    if(single_input<0){
        $(".alert2").fadeIn("slow");
        $(".placeBtnMul").attr('disabled',true);
        return false;
    }else
        $(".alert2").fadeOut("slow");

    var disable = 0;
    var single_odds = new Array(); 
    $("#senction2Multiple .odds_v").each(function() {
        single_odds.push($(this).html());
    });
    var potential = 0.00;
    var total = parseFloat(single_input);
    for(var i=0;i<single_odds.length;i++){
        if(single_odds[i]!=""){
            potential = potential + ( parseFloat(total) * parseFloat(single_odds[i]) );
        }
    }
     //console.log(total+"-"+balance)
    $("#Spotential_mul_win").html((potential).toFixed(2));
    if(parseFloat(balance) < parseFloat(potential) ){ // to enable/diable place button if num of odds is higher than balance
      //      console.log("acc"+disable);
            $(".placeBtnMul").attr('disabled',true);
            $(".alert2").fadeIn("slow");
            disable =1;
        }else{
        //    console.log("rej"+disable);
            $(".alert2").fadeOut("slow");
        }
    if(disable==1) $(".placeBtnMul").attr('disabled',true); 
    else $(".placeBtnMul").attr('disabled',false); 
}

$(document).on('click', '.timer', function(evt) {
    showDiff($(this).attr('id'),$(this).html());
}); 

    function showDiff(elem,start_date){
        // console.log($('#'+elem));
        // console.log($('#cart-title'));
        var date2 = new Date(start_date);
        var date1 = new Date();   

        var diff = (date2 - date1)/1000;
        var diff = Math.abs(Math.floor(diff));

        var days = Math.floor(diff/(24*60*60));
        var leftSec = diff - days * 24*60*60;

        var hrs = Math.floor(leftSec/(60*60));
        var leftSec = leftSec - hrs * 60*60;

        var min = Math.floor(leftSec/(60));
        var leftSec = leftSec - min * 60;
        //console.log(elem);
        // console.log("- Start in " + hrs + " hours " + min + " minutes");
        $('#'+elem).html("- Start in " + hrs + " hours " + min + " minutes");
        //document.getElementById("showTime").innerHTML = "You have " + days + " days " + hrs + " hours " + min + " minutes and " + leftSec + " seconds .";

    }
    $(".clear_bets").click(function(){
        $.ajax({
                type:'post',
            url:"{{url('clearbet')}}",
                data: {_token: "{{csrf_token()}}"},
                success: function (responseData) {
                     console.log(responseData)
                    if(responseData==0)
                        window.location.reload();
                }
            });

    });

var call = 0;
var timer = null;    
var timer1 = null;    
  function checkbal() 
  {
      var url = '{{ url("checkbal") }}';
        $.ajax({
            url: url,   
            type:'get',
            data: { _token: "{{csrf_token()}}"},
            success: function(result)
            { 
                if(result >= 0 && call == 0){ 
                   timer = setInterval(function(){ checkbal() }, 3000 );call = 1;balance = result;                     
                }else if(result== -1){ 
                   clearTimeout(timer);timer = setInterval(function(){ checkbal() }, 8000 );call=0;
                }

            } 
        });
  }
  checkbal();
  function checkbet() 
  {
    if(badge>0){
        var checkodd = new Array(); 
        $("#senction1single > div").each(function() {
            checkodd.push($(this).attr('id'));
        });
    //    console.log('1'+checkodd);
          var url = '{{ url("checkodd") }}';
            $.ajax({
                url: url,   
                type:'post',
                data: { _token: "{{csrf_token()}}","checkodd":checkodd},
                success: function(result)
                { 
                    // console.log(result.length);
                    var single_odds = new Array(); 
                    $("#senction1single .odds_v").each(function() {
                        single_odds.push($(this).html());
                    });
                    var i=0;
                    jQuery.each(result, function(key, val) {
                      if(val != single_odds[i]){
                        $("#senction1single #"+key +" .odds_v").html(val);
                        if($("#inlineCheckbox1").prop("checked")==false)
                            $("#senction1single #"+key +" .odds_v").parent().after('<button class="alert-danger alert-3 text-center" onclick="this.remove()">Odds change</button>');
                        $("#senction1single #"+key +" input").trigger("onkeyup");
                      }
                      i++;
                    });
                    // console.log(single_odds[0]);
                } 
            });
    }
  }
  timer1 = setInterval(function(){ checkbet() }, 3000 );
  checkbet();

</script>
