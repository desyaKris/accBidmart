@extends('layouts.master')
@section('title','ACCBid - Master Content')
@section('Dashboard','a')
@section('Master Management','a')
@section('User Management','a')
@section('Auction Event','a')
@section('Auction Result','a')
@section('Bank Account','a')
@section('Deposit','a')
@section('ContentManagement','Active-menu')
@section('View History','a')
@section('content')

<div id="page-inner">

  <?php
  date_default_timezone_set('Asia/Bangkok');
  $script_tz = date_default_timezone_get();
  ?>
    <div class="row">
        <div class="col-md-12" class="page-head-line">
                  <h1 class="page-head-line">New Master Content</h1>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
                  <div class="alert alert-info">
                    <form action="{{url('/createContentManagementMasterContent')}}"  method="POST" enctype="multipart/form-data">
                      {!! csrf_field() !!}
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Content Type</label>
                        <div class="col-sm-6">
                          <select class="form-control" name="ContentType" id="ContentType">
                              <option>--Chose Content Type--</option>
                              <?php foreach ($response2 as $dt): ?>
                                <option>{{$dt['TypeContent']}}</option>
                              <?php endforeach; ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Order</label>
                        <div class="col-sm-6">
                          <input type="number" name="Order" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control1" name="Title" required/>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Snippet</label>
                        <div class="col-sm-3">
                          <input type="text" name="Snippet" class="form-control">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-2" align="left">
                          <label>
                            <input type="hidden" name="IsActive" value="N">
                            <input type="checkbox" name="IsActive" value="Y" >
                            Use Text Editor?
              						</label>
                        </div>
                        <div class="col-sm-2">
                          <input type="text" name="Detail" class="form-control" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-3">
                          <select class="form-control" name="Category">
                              <option>--Choose Content Category--</option>
                                <option>Finance</option>
                                <option>Otomotif</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Picture</label>
                        <div class="col-sm-3">
                          <input type="file" name="Picture" value="">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-3">
                          <select class="form-control" name="Status" required>
                              <option>--Choose Content Status--</option>
                                <option>Published</option>
                                <option>Unphublished</option>
                                <option>Save As Draft</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-sm-3">
                          <input type="text" style="display:none"  name="AddedDate" value="<?php echo date('Y-m-d H:i:s');?>">
                          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                        </div>
                      </div>
                      </form>
                        <a href="#"><button class="btn btn-primary">Cancel</button></a>
                  </div>

              </div>
          </div>

<!-- /. PAGE INNER  -->

</div>


@endsection
