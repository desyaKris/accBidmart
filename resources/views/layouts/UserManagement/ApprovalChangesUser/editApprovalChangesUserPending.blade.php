@extends('layouts.master')
@section('title','ACCBid - User CMS Approval')
@section('Dashboard','a')
@section('Master Management','a')
@section('User Management','active-menu')
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
          <?php foreach ($response as $dt): ?>
            <h1 class="page-head-line">Verify '{{$dt['Name']}}'</h1>
          <?php endforeach; ?>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
                  <div class="alert alert-info">
                    <form action="{{url('/editApprovalChangesUserPending')}}"  method="POST" enctype="multipart/form-data">
                      {!! csrf_field() !!}
                      <?php foreach ($response as $dt): ?>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">FullName</label>
                          <div class="col-sm-6">
                              <label class="col-sm-5 col-form-label" name="FullName" value="{{$dt['FullName']}}">{{$dt['FullName']}}</label>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Username</label>
                          <div class="col-sm-6">
                              <label class="col-sm-5 col-form-label" name="Username" value="{{$dt['Username']}}">{{$dt['Username']}}</label>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-6">
                              <label class="col-sm-5 col-form-label" name="Email" value="{{$dt['Email']}}">{{$dt['Email']}}</label>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Role</label>
                          <div class="col-sm-6">
                              <label class="col-sm-5 col-form-label" name="Role" value="{{$dt['Role']}}">{{$dt['Role']}}</label>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">User Category</label>
                          <div class="col-sm-6">
                              <label class="col-sm-5 col-form-label" name="UserCategory" value="{{$dt['UserCategory']}}">{{$dt['UserCategory']}}</label>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Organization</label>
                          <div class="col-sm-6">
                              <label class="col-sm-5 col-form-label" name="Organization" value="{{$dt['Organization']}}">{{$dt['Organization']}}</label>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">AddedDate</label>
                          <div class="col-sm-6">
                              <label class="col-sm-5 col-form-label" name="AddedDate" value="{{$dt['AddedDate']}}">{{$dt['AddedDate']}}</label>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">UserUpdated</label>
                          <div class="col-sm-6">
                            <?php if (!empty($dt['UserUpdated'])): ?>
                              <label class="col-sm-5 col-form-label" name="UserUpdated" value="{{$dt['UserUpdated']}}">{{$dt['UserUpdated']}}</label>
                            <?php endif; ?>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Status</label>
                          <div class="col-sm-6">
                              <label class="col-sm-5 col-form-label" name="Status" value="{{$dt['Status']}}">{{$dt['Status']}}</label>
                          </div>
                        </div>


                      <?php endforeach; ?>

                      <div class="form-group row">
                        <div class="col-sm-3">
                          <input type="text" name="Id"  style="display:none" value="{{$dt['Id']}}">
                          <input type="text" name="AddedDate" style="display:none" value="<?php echo date('Y-m-d H:i:s', strtotime($dt['AddedDate'])) ?>">
                          <input type="text" style="display:none"  name="UpdatedDate" value="<?php echo date('Y-m-d H:i:s');?>">
                          <button type="submit" name="action" value="Verify" class="btn btn-primary"> Verify</button>
                          <button type="submit" name="action" value="Reject" class="btn btn-primary"> Reject</button>
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
