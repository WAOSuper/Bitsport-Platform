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
                  <h1>Edit Odd-Masters

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
                  <span class="active">Edit Odd-Masters</span>
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
                              <span class="caption-subject bold uppercase"> Edit Odd-Masters</span>
                          </div>

                      </div>

                     

                      @if(session('success'))
                      <div class="alert alert-success">
                          {{ session('success') }}
                      </div>
                      @endif


                      <div class="portlet-body form">
                           {{ Form::model($odd_master, array('route' => array('admin-odd-master.update', $odd_master->id), 'method' => 'PUT')) }}
                              <input type="hidden" name="_token" value="{{csrf_token()}}">
                              <div class="form-body">
                              
                                  <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                      <label>Odd-Masters Title</label>
                                      <input type="text" class="form-control" placeholder="Enter Odd-Masters title" name="title" value="{{$odd_master->odd_title}}">
                                      @if ($errors->has('title'))
                                         <span class="help-block">
                                             <strong>{{ $errors->first('title') }}</strong>
                                         </span>
                                     @endif
                                  </div>
                              </div>
                              <div class="form-actions">
                                  <button type="submit" class="btn blue">Submit</button>
                                   <a  class="btn default" href="{{route('admin-team.index')}}">Cancel</a>
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

@endsection