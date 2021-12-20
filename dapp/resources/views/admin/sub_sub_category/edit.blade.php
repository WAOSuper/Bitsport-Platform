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
                <h1>Edit Sub Sub Category

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
                <span class="active">Edit Sub Sub Category</span>
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
                            <span class="caption-subject bold uppercase"> Edit Sub Sub Category</span>
                        </div>

                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
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
                        {{ Form::model($subsubcategory, array('route' => array('admin-subsubcategory.update', $subsubcategory->id), 'method' => 'PUT')) }}
                            <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                            <div class="form-body">
                              
                              <div class="form-group">
                                    <label>Category Name</label>
                                    <select class="form-control" name="catid" id="category">
                                        <option value="">Select Category</option>
                                        @foreach($category as $cat)
                                        <option value="{{$cat->id}}" @if($subsubcategory->subsubcat->subcat->id == $cat->id) selected @endif>{{$cat->name}}</option>
                                        @endforeach               
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Sub Category Name</label>
                                    <select class="form-control" name="scatid" id="subcatlist">  
                                <option value="">Select Subcategory </option>
                                 @foreach($subcategory as $scat)
                                        <option value="{{$scat->id}}" @if($subsubcategory->subsubcat->id == $scat->id) selected @endif>{{$scat->name}}</option>
                                        @endforeach                                                
                                    </select>                                   
                                </div>


                                <div class="form-group">
                                    <label>Sub Sub Category Name</label>
                                    <input type="text" class="form-control" value="{{$subsubcategory->name}}" placeholder="Enter Name" name="name">
                                </div>

                                <div class="form-group">
                                    <label>Slug Name</label>
                                    <input type="text" class="form-control" value="{{$subsubcategory->slug}}" placeholder="Enter Slug" name="slug">
                                </div>


                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn blue">Submit</button>
                                <button type="button" class="btn default">Cancel</button>
                            </div>
                         {!! Form::close(); !!}
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
                          //  console.log(result);
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