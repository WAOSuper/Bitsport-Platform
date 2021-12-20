@extends('layouts.master')
<!-- head -->
@section('title')
    Betting
@endsection
<!-- title -->
@section('head')
 
@endsection
  
@section('content')
  <div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
      <div class="page-content" style="min-height: 1603px;">
          <!-- BEGIN PAGE HEAD-->
          <div class="page-head">
              <!-- BEGIN PAGE TITLE -->
              <div class="page-title">
                  <h1>Insert Odd

                  </h1>
              </div>
              <!-- END PAGE TITLE -->

          </div>
          <!-- END PAGE HEAD-->
          <!-- BEGIN PAGE BREADCRUMB -->
          <ul class="page-breadcrumb breadcrumb">
              <li>
                  <a href="{{url('admin-dashboard')}}">Home</a>
                  <i class="fa fa-circle"></i>
              </li>
              <li>
                  <span class="active">Insert Odd</span>
              </li>
          </ul>
          <!-- END PAGE BREADCRUMB -->
          <!-- BEGIN PAGE BASE CONTENT -->
          <div class="row">
              <div class="col-md-10 ">
                  <!-- BEGIN SAMPLE FORM PORTLET-->
                  <div class="portlet light bordered">
                      <div class="portlet-title">
                          <div class="caption font-blue-sunglo">
                              <i class="icon-settings font-blue-sunglo"></i>
                              <span class="caption-subject bold uppercase"> Insert Odd for {{$event->master->event_name}}</span>
                          </div>

                      </div>

                      @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul class="alert alert-danger">
                          @foreach ($errors->all() as $error)
                          <li> {{ $error }}</li><br>
                          @endforeach
                          </ul>
                      </div>
                      @endif

                      @if(session('success'))
                      <div class="alert alert-success">
                          {{ session('success') }}
                      </div>
                      @endif


                      <div class="portlet-body form">
                         {{ Form::model($event, array('route' => array($role == 'creator' ? 'creator-odd.update' :'admin-odd.update', $event->id), 'method' => 'PUT')) }}
                              <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                              <div class="form-body">
                              <?php $j=1; ?>
                              @foreach($odds as $odd)
                               <div class="row" id="removeThis<?php echo $j; ?>">
                               <div><i class="fa fa-times" id="remove" aria-hidden="true" style="color:red; cursor: pointer;" onclick="remove(<?php echo $odd->id.', '.$j;?>);"> Remove </i></div> 
                                  <div class="form-group {{ $errors->has('team') ? ' has-error' : '' }} col-md-3">
                                      <label>Team</label> 
                                      <select name="odd[<?php echo $j; ?>][team]" id="team" required class="form-control">
                                        <option value="">Select Team </option>  
                                        @foreach($teams as $team)
                                        <option value="{{$team->id}}" @if($team->id==$odd->team_id) selected @endif>{{$team->name}}</option>
                                        @endforeach
                                      </select>
                                      @if ($errors->has('team'))
                                         <span class="help-block">
                                             <strong>{{ $errors->first('team') }}</strong>
                                         </span>
                                     @endif
                                  </div>

                                  <div class="form-group {{ $errors->has('odd_master') ? ' has-error' : '' }} col-md-3">
                                      <label>Odd Master</label> 
                                      <select name="odd[<?php echo $j; ?>][odd_master]" id="odd_master" required class="form-control">
                                        <option value="">Select Odd Master</option>  
                                        @foreach($odd_masters as $odd_master)
                                        <option value="{{$odd_master->id}}" @if($odd_master->id==$odd->odd_id) selected @endif>{{$odd_master->odd_title}}</option>
                                        @endforeach
                                      </select>
                                      @if ($errors->has('odd_master'))
                                         <span class="help-block">
                                             <strong>{{ $errors->first('odd_master') }}</strong>
                                         </span>
                                     @endif
                                  </div>
                                 
                                    <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }} col-md-3">
                                        <label>Odd Title</label>
                                        <input type="text" class="form-control" placeholder="Enter Odd title" required name="odd[<?php echo $j; ?>][title]" value="{{ $odd->name}}">
                                        @if ($errors->has('title'))
                                           <span class="help-block">
                                               <strong>{{ $errors->first('title') }}</strong>
                                           </span>
                                       @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('odd') ? ' has-error' : '' }} col-md-3">
                                        <label>Odd</label>
                                        <input type="text" class="form-control" placeholder="Enter Odd" required name="odd[<?php echo $j; ?>][odd_val]" value="{{$odd->odd }}">
                                        <input type="hidden" class="form-control" placeholder="Enter Odd" required name="odd[<?php echo $j; ?>][odd_id]" value="{{$odd->id }}">
                                        @if ($errors->has('odd'))
                                           <span class="help-block">
                                               <strong>{{ $errors->first('odd') }}</strong>
                                           </span>
                                       @endif
                                    </div>
                                  </div>
                                    <?php $j++ ; ?>
                                  @endforeach

                                  <div id="new-period">

                                  </div>
                                  <div class="form-group" style="float:right;">
                                      <button type="button" class="btn btn-info" onclick="addOdds();">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Odd
                                      </button>
                                  </div>
                              </div>
                              <div class="form-actions">
                                  <button type="submit" class="btn blue">Submit</button>
                                   <a  class="btn default" href="{{route('admin-event.index')}}">Cancel</a>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
          <!-- END PAGE BASE CONTENT -->
      </div>
      <!-- END CONTENT BODY -->
  </div>
@endsection
@section('script')
  <script>
   var i = 1000;
    function addOdds()
    {
        var odd_masters='';
        var pausecontent = new Array();
        <?php foreach($odd_masters as $key => $val){ ?>
           odd_masters+=' <option value="<?php echo $val['id'] ?>"><?php echo $val['odd_title'] ?></option>';
        <?php } ?>

        var teams='';
        <?php foreach($teams as $key => $val){ ?>
           teams+=' <option value="<?php echo $val['id'] ?>"><?php echo $val['name'] ?></option>';
        <?php } ?>
      
       var odd='';
         odd +='<div class="row" id="removeThis'+i+'" ><div><i class="fa fa-times" aria-hidden="true" style="color:red; cursor: pointer;" onclick="removeDiv('+i+');"> Remove </i></div> <div class="form-group col-md-3"><label>Teams</label><select name="odd['+i+'][team]" id="team" required class="form-control">  <option value="">Select Team</option>'+teams+'</select></div><div class="form-group col-md-3"><label>Odd Master</label><select name="odd['+i+'][odd_master]" required id="odd_master" class="form-control">  <option value="">Select Odd Master</option>'+odd_masters+'</select></div><div class="form-group  col-md-3">   <label>Odd Title</label>   <input type="text" class="form-control" placeholder="Enter Odd title" name="odd['+i+'][title]" ></div> <div class="form-group  col-md-3"> <label>Odd</label> <input type="text" class="form-control" placeholder="Enter Odd " name="odd['+i+'][odd_val]" >  </div></div>';
        $('#new-period').append(odd);
        i = i+1;
    }
     function remove(oddid, divid){
        var _token=$("#_token").val();
        var url = '{{ url("remove-odd") }}';
        $.ajax({   
              url: url,   
              type:'post',
              data: { '_token' : _token, 'odd_id':oddid },
              success: function(result)
              { 
                console.log(result);
                $('#removeThis'+divid).remove();
              }
        });
      }
      function removeDiv(divId)
      {
        $('#removeThis'+divId).remove();
      }
  </script>
@endsection