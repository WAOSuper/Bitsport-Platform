@extends('layouts.master')
@section('title')
    Betting
@endsection
@section('head')
<meta name="csrf_token"  content="{{ csrf_token() }}" />
@endsection

@section('content')

<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="min-height: 1603px;">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>Sub Sub Category

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
                <span class="active">Sub Sub Category</span>
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
                            <span class="caption-subject bold uppercase">Sub Sub Category</span>
                        </div>

                    </div>


                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif


                    <div class="portlet-body form">
                        <form role="form" method="post" action="{{route('admin-subsubcategory.store')}}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                            <div class="form-body">
                              
                              <div class="form-group {{ $errors->has('catid') ? ' has-error' : '' }}">
                                    <label>Category Name</label>
                                    <select class="form-control" name="catid" id="category">
                                        <option value="">Select Category</option>
                                        @foreach($category as $cat)
                                        <option value="{{$cat->id}}">{{$cat->name}}</option> 
                                        @endforeach               
                                    </select>
                                     @if ($errors->has('catid'))
                                 <span class="help-block">
                                     <strong>{{ $errors->first('catid') }}</strong>
                                 </span>
                                 @endif
                                </div>

                                <div class="form-group {{ $errors->has('scatid') ? ' has-error' : '' }}">
                                    <label>Sub Category Name</label>
                                    <select class="form-control" name="scatid" id="subcatlist">  
                                <option value="">Select Subcategory</option>                                              
                                    </select>  
                                      @if ($errors->has('scatid'))
                                 <span class="help-block">
                                     <strong>{{ $errors->first('scatid') }}</strong>
                                 </span>
                                 @endif                                 
                                </div>


                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label>Sub Sub Category Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Name" name="name">
                                         @if ($errors->has('name'))
                                 <span class="help-block">
                                     <strong>{{ $errors->first('name') }}</strong>
                                 </span>
                                   @endif 
                                </div>

                                <div class="form-group {{ $errors->has('slug') ? ' has-error' : '' }}">
                                    <label>Slug Name</label>
                                    <input type="text" class="form-control"  placeholder="Enter Slug" name="slug">
                                         @if ($errors->has('slug'))
                                 <span class="help-block">
                                     <strong>{{ $errors->first('slug') }}</strong>
                                 </span>
                                   @endif 
                                </div>


                            </div>
                            <div class="form-actions">
                                <button type="submit"  class="btn blue">Submit</button>
                                <button type="button" class="btn default">Cancel</button>
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
$('#category').change(function () {

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
                            if (result) {
                                    $('#subcatlist').html(result.html);
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
             $('#subcatlist').html('<option value="">Select Subcategory</option>');
        }
    })
</script>

@endsection