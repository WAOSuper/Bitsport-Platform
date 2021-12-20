@extends('layouts.master')
<!-- head -->
@section('title')
    Betting
@endsection
<!-- title -->
@section('head')
 <meta name="csrf_token"  content="{{ csrf_token() }}" />
 <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
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
                              <span class="caption-subject bold uppercase"> Odd for {{$event->master->event_name}}</span>
                          </div>

                      </div>

                    

                      @if(session('success'))
                      <div class="alert alert-success">
                          {{ session('success') }}
                      </div>
                      @endif


                      <div class="portlet-body form">
                          <form role="form" method="post" action="{{route('admin-odd.store')}}" >
                              <input type="hidden" name="_token" value="{{csrf_token()}}">
                              <input type="hidden" name="event_id" value="{{$event->id}}">
                              <div class="form-body">
                                   <div class="row">
                                  <div class="form-group" style="float:right;">
                                    <span> <a class="btn blue btn-outline sbold" data-toggle="modal" href="#oddmaster"> <i class="fa fa-plus" aria-hidden="true"></i> Add Odd Master</a></span> 
                                      
                                  </div>
                                   </div>
                                 <div class="row">
                                    <div class="form-group {{ $errors->has('team') ? ' has-error' : '' }} col-md-3">
                                        <label>Team</label> 
                                        <select name="odd[1][team]" id="team" required class="form-control">
                                          <option value="">Select Team </option>  
                                          @foreach($teams as $team)
                                          <option value="{{$team->id}}" >{{$team->name}}</option>
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
                                        <select name="odd[1][odd_master]" id="odd_master"  class="form-control odd_master">
                                          <option value="">Select Odd Master</option>  
                                          @foreach($odd_masters as $odd_master)
                                          <option value="{{$odd_master->id}}">{{$odd_master->odd_title}}</option>
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
                                        <input type="text" class="form-control" placeholder="Enter Odd title" name="odd[1][title]" value="{{ old('title') }}">
                                        @if ($errors->has('title'))
                                           <span class="help-block">
                                               <strong>{{ $errors->first('title') }}</strong>
                                           </span>
                                       @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('odd') ? ' has-error' : '' }} col-md-3">
                                        <label>Odd</label>
                                        <input type="text" class="form-control" placeholder="Enter Odd " name="odd[1][odd_val]" value="{{ old('odd') }}">
                                        @if ($errors->has('odd'))
                                           <span class="help-block">
                                               <strong>{{ $errors->first('odd') }}</strong>
                                           </span>
                                       @endif
                                    </div>
                                  </div>

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

  <!-- Odd master model -->
<div class="modal fade" id="oddmaster" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add Odd Master</h4>
            </div>
            <div class="modal-body"> 
               <div class="alert alert-danger" style="display:none"><ul class="val_errors_odd" ></ul></div> 
           <form action="" method="post" id="oddmstr">
            <div class="form-group">
              <label>Odd Title</label>
                 <input type="text" class="form-control oddm" placeholder="Enter Odd  Name" name="oddtitle">                       
            </div>
          </form>
          </div>
       <div class="modal-footer">
            <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
            <button type="button" id="Submit-oddmaster" class="btn green">Save</button>
        </div>
    </div>                                 
    </div>                                       
</div>
@endsection
@section('script')
  <script>
   var i = 1000;
    function addOdds()
    {
        var odd_masters='';
        var teams='';
        var pausecontent = new Array();
        <?php foreach($odd_masters as $key => $val){ ?>
           odd_masters+=' <option value="<?php echo $val['id'] ?>"><?php echo $val['odd_title'] ?></option>';
        <?php } ?>
        <?php foreach($teams as $key => $val){ ?>
           teams+=' <option value="<?php echo $val['id'] ?>"><?php echo $val['name'] ?></option>';
        <?php } ?>
       var odd='';
         odd +='<div class="row" id="removeThis'+i+'" ><div class="form-group col-md-3"><label>Team</label>&nbsp;&nbsp;&nbsp;<i class="fa fa-times" aria-hidden="true" style="color:red; cursor: pointer;" onclick="remove('+i+');"> Remove </i> <select name="odd['+i+'][team]" id="team'+i+'" class="form-control team">  <option value="">Select Team</option>'+teams+'</select></div><div class="form-group col-md-3"><label>Odd Master</label><select name="odd['+i+'][odd_master]" id="odd_master'+i+'" class="form-control odd_master">  <option value="">Select Odd Master</option>'+odd_masters+'</select></div><div class="form-group  col-md-3">   <label>Odd Title</label>   <input type="text" class="form-control" placeholder="Enter Odd title" name="odd['+i+'][title]" ></div> <div class="form-group  col-md-3"> <label>Odd</label> <input type="text" class="form-control" placeholder="Enter Odd " name="odd['+i+'][odd_val]" >  </div></div>';
        $('#new-period').append(odd);
        i = i+1;
    }
     function remove($id){
        $('#removeThis'+$id).remove();
      }
  </script>
  <script src="{{ asset('js/custome.js') }}" type="text/javascript"></script>
@endsection