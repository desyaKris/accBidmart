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
          <?php foreach ($response as $dt1): ?>
            <h1 class="page-head-line">{{$dt1['ContentType']}}</h1>
          <?php endforeach; ?>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
                  <div class="alert alert-info">
                    <form action="{{url('/createContentManagementMasterContent')}}"  method="POST" enctype="multipart/form-data">
                      {!! csrf_field() !!}
                      <?php foreach ($response as $dt): ?>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Content Type</label>
                          <div class="col-sm-6">
                            <select class="form-control" name="ContentType" value="{{$dt['ContentType']}}">
                                <!-- <option>{{$dt['ContentType']}}</option> -->
                                <?php foreach ($response2 as $dt2): ?>
                                  if({{$dt2['TypeContent']}} != {{$dt['ContentType']}})
                                  {
                                    <option>{{$dt2['TypeContent']}}</option>
                                  }
                                  endif
                                <?php endforeach; ?>
                            </select>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Order</label>
                          <div class="col-sm-6">
                            <input type="number" name="Order" value="{{$dt['Order']}}" required>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Title</label>
                          <div class="col-sm-6">
                            <input type="text" class="form-control1" name="Title"  value="Title" required/>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Snippet</label>
                          <div class="col-sm-3">
                            <input type="text" name="Snippet" value="{{$dt['Snipset']}}"class="form-control">
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
                            <input type="text" name="Detail" value="Detail" class="form-control" required>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Category</label>
                          <div class="col-sm-3">
                            <select class="form-control" name="Category" value="{{$dt['Category']}}">
                                <option value="{{$dt['Category']}}">{{$dt['Category']}}</option>
                                @if($dt['Category'] == "Finance")
                                  <option>Otomotif</option>
                                @else
                                <option>Finance</option>
                                @endif
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
                                <option value="{{$dt['Status']}}">{{$dt['Status']}}</option>
                                @if($dt['Status'] == "Published")
                                <option>Unphublished</option>
                                <option>Save As Draft</option>
                                @elseif($dt['Status'] == "Unphublished")
                                <option>Published</option>
                                <option>Save As Draft</option>
                                @else
                                <option>Published</option>
                                <option>Unphublished</option>
                                @endif
                            </select>
                          </div>
                        </div>

                        <input type="text" style="display:none" name="Id" value="{{$dt['Id']}}">
                      <?php endforeach; ?>
                      <div class="form-group row">
                        <div class="col-sm-3">
                          <input type="text" style="display:none" name="AddedDate" value="{{$dt['AddedDate']}}">
                          <input type="text" style="display:none"  name="UpdatedDate" value="<?php echo date('Y-m-d H:i:s');?>">
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
