@extends('layouts.master')
@section('title','UploadMasterGCM')
@section('Bank Account','a')
@section('Master Management','active-menu')
@section('content')
<div id="page-inner">
  <?php
  date_default_timezone_set('Asia/Bangkok');
  $script_tz = date_default_timezone_get();
  ?>
    <div class="row">
        <div class="col-md-12" class="page-head-line">
                  <h1 class="page-head-line">Upload MasterGCM</h1>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
                  <div class="alert alert-info">
                    <form action="{{url('/UploadMasterGCM')}}"  autocomplete="off" method="POST" enctype="multipart/form-data">
                      {!! csrf_field() !!}
                      <label>Structure : Condition, CharValue1, CharDesc1, CharValue2, CharDesc2, CharValue3, CharDesc3, CharValue4, CharDesc4, CharValue5, CharDesc5, IsActive, TimeStamp1, TimeStamp2
                      </label>
                      <br>
                      <label>Format : .xlsx file, no double-quotes for text</label>
                      <br>
                        <div class="form-group">
            							<input type="file" id="exampleInputFile" name="import_excel" required/>
            						</div>
                          <input type="text" style="display:none"  name="AddDate" value="<?php echo date('d-M-Y H:i:s');?>">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>

                    </form>
                    <a href="/MasterGCM"><button class="btn btn-primary">Cancel</button></a>

                  </div>

              </div>
          </div>

<!-- /. PAGE INNER  -->

</div>
@endsection
