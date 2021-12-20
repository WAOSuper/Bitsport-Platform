$(document).ready(function () {

/*Get Subcategory from category on selection*/
    $('#category').change(function () { 
         cat_id = $.trim($(this).val());
         if (cat_id != '') {

            $.ajax({
                type:'get',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                // url:"{{url('getSubcategoryFromCategory')}}",
                url:"/getSubcategoryFromCategory",
                data: {'category':cat_id},
                success: function (responseData) {
                    if(responseData)
                    {
                         $("#sub_category").html(responseData);  
                         $('#sub_sub_category').html('<option value="0">Select SubSubcategory</option>');                    
                    }
                }
            });
            
        } else {
             $( ".subcate").hide();
             $('#sub_category').html('<option value="0">Select Subcategory</option>');
             $('#sub_sub_category').html('<option value="0">Select SubSubcategory</option>');
        }
    })

/*Get SubSubcategory from Subcategory on selection*/
    $('#sub_category').change(function () {
         subcat_id = $.trim($(this).val());
        if (subcat_id != '') {
            $.ajax({
                type:'get',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
               // url:"{{url('getSubSubcategoryFromSubCategory')}}",
                url:"/getSubSubcategoryFromSubCategory",
                data: {'subcategory':subcat_id},
                success: function (responseData) {
                    if(responseData)
                    {
                        $("#sub_sub_category").html(responseData);                      
                    }
                }
            });
        } else {
             $('#sub_sub_category').html('<option value="0">Select SubSubcategory</option>');
        }
      })
   })
//get channel id from channel url and channel

function getChannelId(){
   
  var video_url = $("#video_url").val();
  //var channel = $("#channel").val();

  if(video_url!=''){
       $("#channel-id-msg").html('');
     $.ajax({
          type:'get',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
          url:"/topGames",
          data: {'video_url': video_url},
          success: function (responseData) {
              if(responseData==0)
              {
                $("#channel-id-msg").html('<strong style="color:#b20811;" >Oops! channel or video url is not valid</strong>');  
               console.log("Oops! channel or video url is not valid.");
                $("#channel_id").val('');
              }
              if(responseData==2)
              {
                $("#channel-id-msg").html('<strong style="color:#b20811;">No channel id set in twitch yet! Try letter.</strong>');    
                console.log("No channel id set yet! Try letter.");
                $("#channel_id").val('');
              }
              else{
                 $("#channel-id-msg").html('<strong style="color:#178e09;">Channel id set successfully.</strong>');      
                 $("#channel_id").val(responseData);
              }
          }
      });
  }
}
/*

// Get Team from category
$('.cateid').change(function () {
        val = $.trim($(this).val());
        token = $.trim($('#_token').val());
        if (val != '') {
              $.ajax({
              url: '/getTeamCat',
              type: "get",
              data: {'category': val, '_token': token},
              success: function(data){
                     if (data) {
                            result = $.parseJSON(data);
                          //  console.log(result);
                            if (result) {
                                    $('.team1').html(result.html);
                                    $('.team2').html(result.html);
                            } else {
                                alert("Something went wrong!");
                            }
                        }
                    }
                })
          
        } else {
            $('#loadingDiv').hide();
             $('#subcatlist').html('<option value="0">Select Subcategory</option>');
        }
    })

// Get Team from subcategory
$('.subcatid').change(function () {
        cat = $( "select#category option:checked" ).val();
      //  console.log(cat);
        val = $.trim($(this).val());
        token = $.trim($('#_token').val());
        if (val != '') {
              $.ajax({
              url: '/getTeamSubCat',
              type: "get",
              data: {'category':cat, 'subcategory': val, '_token': token},
              success: function(data){
                     if (data) {
                            result = $.parseJSON(data);
                          //  console.log(result);
                            if (result) {
                                    $('.team1').html(result.html);
                                    $('.team2').html(result.html);
                            } else {
                                alert("Something went wrong!");
                            }
                        }
                    }
                })
          
        } else {
            $('#loadingDiv').hide();
             $('#subcatlist').html('<option value="0">Select Subcategory</option>');
        }
    })

//Get Team from subsubcategory
$('.subsubcatid').change(function () {
        cat = $( "select#category option:checked" ).val();
        scat = $( "select#sub_category option:checked" ).val();
       // console.log(cat+scat);
        val = $.trim($(this).val());
        token = $.trim($('#_token').val());
        if (val != '') {
              $.ajax({
              url: '/getTeamSubSubCat',
              type: "get",
              data: {'category': cat,'subcategory': scat,'subsubcategory': val, '_token': token},
              success: function(data){
                     if (data) {
                            result = $.parseJSON(data);
                          //  console.log(result);
                            if (result) {
                                    $('.team1').html(result.html);
                                    $('.team2').html(result.html);
                            } else {
                                alert("Something went wrong!");
                            }
                        }
                    }
                })
        } else {
            $('#loadingDiv').hide();
             $('#subcatlist').html('<option value="0">Select Subcategory</option>');
        }
    }) */


/*Get team member is not equal For team */
    $('.team1').change(function () {
       // cat = $( "select#category option:checked" ).val();
       //  scat = $( "select#sub_category option:checked" ).val();
       //   sscat = $( "select#sub_sub_category option:checked" ).val();
         team_1 = $.trim($(this).val());
         console.log(team_1);
        if (team_1 != '') {
            $.ajax({
                type:'get',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
               // url:"{{url('getSubSubcategoryFromSubCategory')}}",
                url:"/getTeamMember",
                data: {'team1':team_1},
                 success: function (responseData) {
                    if(responseData)
                    {
                      result = $.parseJSON(responseData);{
                        $(".team2").html(result.html);
                      }                      
                    }
                }
                })
          
        } else {
            $('#loadingDiv').hide();
             $('#subcatlist').html('<option value="0">Select Subcategory</option>');
        }
    })



// Get sub category for team
$('.categoryteam').change(function () {
        $('#loadingDiv').show();
        val = $.trim($(this).val());
        token = $.trim($('#_token').val());
        if (val != '') {
              $.ajax({
              url: '/getSubcategory',
              type: "get",
              data: {'category': val, '_token': token},
              success: function(data){
                     if (data) {
                            result = $.parseJSON(data);
                          //  console.log(result);
                            if (result) {
                                    $('.sub_categoryteam').html(result.html);
                                    $('#loadingDiv').hide();
                            } else {
                                $('#loadingDiv').hide();
                                alert("Something went wrong!");
                            }
                        }
                    }
                })
          
        } else {
            $('#loadingDiv').hide();
             $('.sub_categoryteam').html('<option value="0">Select Subcategory</option>');
        }
    })

 /*Get SubSubcategor For team */
    $('.sub_categoryteam').change(function () {
         subcat_id = $.trim($(this).val());
        if (subcat_id != '') {
            $.ajax({
                type:'get',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
               // url:"{{url('getSubSubcategoryFromSubCategory')}}",
                url:"/getSubSubcategoryFromSubCategory",
                data: {'subcategory':subcat_id},
                success: function (responseData) {
                    if(responseData)
                    {
                        $(".sub_sub_categoryteam").html(responseData);                      
                    }
                }
            });
        } else {
             $('.sub_sub_categoryteam').html('<option value="0">Select SubSubcategory</option>');
        }
      })


   


 // Get sub category
    $('#categoryid').change(function () {
        val = $.trim($(this).val());
        token = $.trim($('#_token').val());
        if (val != '') {
              $.ajax({
              url: '/getSubcategory',
              type: "get",
              data: {'category': val, '_token': token},
              success: function(data){
                     if (data) {
                            result = $.parseJSON(data);
                          //  console.log(result);
                            if (result) {
                                    $('#sub_categoryid').html(result.html);
                            } else {
                                alert("Something went wrong!");
                            }
                        }
                    }
                })
          
        } else {
            $('#loadingDiv').hide();
             $('#subcatlist').html('<option value="0">Select Subcategory</option>');
        }
    })






// Category Insert Data ajax 
     $('#Submit-cat').click( function(e){
     var formdata = $("#cat").serialize();
        $.ajax({
            type:'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
            url:"/addCategory",
            data: formdata,
            success: function (responseData) {
          //  console.log(responseData);
            $(".cate").val("");
            $( ".alert-danger").hide();
            $(".val_errors1").html('');
            $('#eventcat').modal('hide');
            $(".cateid").append(responseData);
            $(".categoryteam").append(responseData);                      
            },
            error: function (responseData) {
               // console.log(responseData);
               $(".val_errors1").html('');
                var errors = $.parseJSON(responseData.responseText);
                var i=1;
                $.each( errors, function( key, value ) {
                    $(".val_errors1").append('<li>'+ i++ +'.'+ value+'</li><br>' );
                    $( ".alert-danger").show();
                });
            }
        });
    });


// Sub Category Insert Data ajax 
$('#Submit-subcat').click( function(e){
  var cat = $( ".cateid option:checked" ).val();
  var scat = $( ".subcatid option:checked" ).val();
  console.log(scat);
 var formdata = $("#subcat").serialize();
        $.ajax({
            type:'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
            url:"/addSubCategory",
            data: formdata,
            success: function (responseData) {
          //  console.log(responseData);
            $("#subcatname , .cat").val("");
            $( ".alert-danger").hide();
            $(".val_errors2").html('');
            $(".sub_categoryteam").append(responseData);
            $('#eventscat').modal('hide');
            if(cat != "" & scat != "") {
            $(".subcatid").append(responseData);                      
            }
            if(scat == ""){ 
              $(".subcatid").html('<option value="0">Select Subcategory</option>'+responseData);
            }
            },
            error: function (responseData) {
               // console.log(responseData);
               $(".val_errors2").html('');
                var errors = $.parseJSON(responseData.responseText);
                var i=1;
                $.each( errors, function( key, value ) {
                    $(".val_errors2").append('<li>'+ i++ +'.'+ value+'</li><br>' );
                    $( ".alert-danger").show();
                });
            }
        });
    });

// Sub Sub Category Insert Data ajax 
$('#Submit-subsubcat').click( function(e){
  var cat = $( ".cateid option:checked" ).val();
  var scat = $( ".subcatid option:checked" ).val();
  console.log(scat);
  var sscat = $( ".subsubcatid option:checked" ).val();
 var formdata = $("#subsubcat").serialize();
        $.ajax({
            type:'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
            url:"/addSubSubCategory",
            data: formdata,
            success: function (responseData) {
          //  console.log(responseData);
            $(".ssc").val("");
            $('#eventsscat').modal('hide');
            $(".val_errors3").html('');
            $( ".alert-danger").hide();
            $(".sub_sub_categoryteam").append(responseData);
            if(cat != "" && scat != "" && scat != "0" && sscat != "") {
            $("#sub_sub_category").append(responseData);                      
            }
            if(sscat == ""){ 
              $("#sub_sub_category").html('<option value="0">Select SubSubcategory</option>'+responseData);
            }

            },
            error: function (responseData) {
               // console.log(responseData);
               $(".val_errors3").html('');
                var errors = $.parseJSON(responseData.responseText);
                var i=1;
                $.each( errors, function( key, value ) {
                    $(".val_errors3").append('<li>'+ i++ +'.'+ value+'</li><br>' );
                    $( ".alert-danger").show();
                });
            }
        });
    });

// Team Insert Data ajax 
    $('#Submit-evntteam').click( function(e){
      var cat = $( ".cateid option:checked" ).val();
      var scat = $( ".subcatid option:checked" ).val();
      var sscat = $( ".subsubcatid option:checked" ).val();

      var team1 = $( ".team1 option:checked" ).val();
      var team2 = $( ".team2 option:checked" ).val();

     var formdata = $("#evntteam").serialize();
            $.ajax({
                type:'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                url:"/addTeam",
                data: formdata,
                success: function (responseData) {
                  $(".tm").val("");
                  $('#eventteam').modal('hide');
                  $(".val_errors4").html('');
                  $( ".alert-danger").hide();
                  if(cat != "" && cat != "0" && team1 != "" && team2 != "") {
                    $("select#team_1").append(responseData); 
                    $("select#team_2").append(responseData); 
                  }  
                  if(cat != "" && team1 == "" && team2 == "") { 
                    $("select#team_1").html('<option value="0">Select Team</option>'+responseData); 
                    $("select#team_2").html('<option value="0">Select Team</option>'+responseData);
                  }                  
                },
                error: function (responseData) {
                   // console.log(responseData);
                   $(".val_errors4").html('');
                    var errors = $.parseJSON(responseData.responseText);
                    var i=1;
                    $.each( errors, function( key, value ) {
                        $(".val_errors4").append('<li>'+ i++ +'.'+ value+'</li><br>' );
                        $( ".alert-danger").show();
                    });
                }
            });
        });

// Event Master Insert Data ajax 

$('#Submit-evntmaster').click( function(e){
 var formdata = $("#evntmaster").serialize();
        $.ajax({
            type:'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
            url:"/addEventMaster",
            data: formdata,
            success: function (responseData) {
          //  console.log(responseData);
           $(".eventnm").val("");
           $(".val_errors5").html('');
           $( ".alert-danger").hide();
            $('#evtmaster').modal('hide');
            $("#eventmaster").append(responseData);                       
            },
            error: function (responseData) {
               // console.log(responseData);
               //console.log('error');
                $(".val_errors5").html('');
                var errors = $.parseJSON(responseData.responseText);
                var i=1;
                $.each( errors, function( key, value ) {
                    $(".val_errors5").append('<li>'+ i++ +'.'+ value+'</li><br>' );
                    $( ".alert-danger").show();
                });
                
            }
        });
    });

// Odd master Insert Data ajax 

$('#Submit-oddmaster').click( function(e){
 var formdata = $("#oddmstr").serialize();
 console.log(formdata);
 var i = 1000;
  i = i+1;
        $.ajax({
            type:'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
            url:"/addOddMaster",
            data: formdata,
            success: function (responseData) {
          //  console.log(responseData);
            $(".oddm").val("");
            $('#oddmaster').modal('hide');
            $(".alert-danger").hide();
            $(".odd_master").append(responseData);
            window.location.reload();                       
            },
            error: function (responseData) {
               // console.log(responseData);
               //console.log('error');
                $(".val_errors_odd").html('');
                var errors = $.parseJSON(responseData.responseText);
                var i=1;
                $.each( errors, function( key, value ) {
                    $(".val_errors_odd").append('<li>'+ i++ +'.'+ value+'</li><br>' );
                    $( ".alert-danger").show();
                });
                
            }
        });
    });

