@extends('layouts.master')
@section('title','ACCBid - New Master GCM')
@section('Dashboard','a')
@section('Master Management','active-menu')
@section('User Management','a')
@section('Auction Event','a')
@section('Auction Result','a')
@section('Bank Account','a')
@section('Deposit','a')
@section('ContentManagement','a')
@section('View History','a')
@section('content')
<div id="page-inner">
  <?php
  date_default_timezone_set('Asia/Bangkok');
  $script_tz = date_default_timezone_get();
  ?>
    <div class="row">
        <div class="col-md-12" class="page-head-line">
                  <h1 class="page-head-line">New Master GCM</h1>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <!-- alert -->
        @if (Session::get('alert')  == "success")
        <div class="alert alert-success alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>{{ Session::get('message') }}</strong>
        </div>

        @elseif(Session::get('alert')  == "error")
        <div class="alert alert-danger alert-dismissible">
           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>{{ Session::get('message') }}</strong>
         </div>
        @endif

        @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
         </div>
       @endif
        <div class="alert alert-info">
          <form action="{{url('/UploadMasterGCM')}}"  autocomplete="off" method="POST" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <label>Structure : Condition, CharValue1, CharDesc1, CharValue2, CharDesc2, CharValue3, CharDesc3, CharValue4, CharDesc4, CharValue5, CharDesc5, IsActive, TimeStamp1, TimeStamp2
            </label>
            <br>
            <label>Format : .xlsx file, no double-quotes for text</label>
            <br>
            <div class="form-group row">
              <div class="form-group col-sm-4">
                <input type="file" id="exampleInputFile" name="import_excel" required/>
              </div>
              <div class="col-sm-2">
                <button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
              </div>
            </div>

            <input type="text" style="display:none"  name="AddDate" value="<?php echo date('d-M-Y H:i:s');?>">
          </form>
          <a href="/MasterGCM"><button class="btn btn-primary">Cancel</button></a>
        </div>
    </div>
  </div>

<!-- /. PAGE INNER  -->

</div>
@endsection
