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
                  <h1>Insert Event Odd-Masters
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
                  <span class="active">Insert Event Odd-Masters</span>
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
                              <span class="caption-subject bold uppercase"> Insert Event Odd-Masters</span>
                          </div>

                      </div>
                      @if(session('success'))
                      <div class="alert alert-success">
                          {{ session('success') }}
                      </div>
                      @endif
                      <div class="portlet-body form">
                          <form role="form" method="post" action="{{route('admin-event-odd-master.store')}}" >
                              <input type="hidden" name="_token" value="{{csrf_token()}}">
                              <div class="form-body">
                                  <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                      <label>Event Odd-Masters Title</label>
                                      <input type="text" class="form-control" placeholder="Enter Event Odd-Masters title" name="title" value="{{ old('title') }}">
                                      @if ($errors->has('title'))
                                         <span class="help-block">
                                             <strong>{{ $errors->first('title') }}</strong>
                                         </span>
                                     @endif
                                  </div>
                              </div>
                              <div class="form-actions">
                                  <button type="submit" class="btn blue">Submit</button>
                                   <a  class="btn default" href="{{route('admin-event-odd-master.index')}}">Cancel</a>
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