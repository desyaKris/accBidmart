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
  <!-- untuk setdefault timezone Indonesia -->
  <?php
  date_default_timezone_set('Asia/Bangkok');
  $script_tz = date_default_timezone_get();
  ?>
          <div class="row">
              <div class="col-md-12" >
    						<div class="page-head-line">
    						<h1>Master Content</h1>
                <form action="{{url('/showCreateContentManagementMasterContent')}}"  method="get">
                  <a href="#"><button class="btn btn-primary"><i class="fa fa-create">  </i>Create new Master Content  </button></a>
                </form>

    						</div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                  <div class="alert alert-info">
                    <form action="{{ url('/showContentManagementMasterContent')}}"  method="get">
                      <div class="form-group row">
                        <div class="col-sm-4">
                          <select class="form-control" name="ContentType" id="ContentType">
                              <option>--Chose Content Type--</option>
                              <?php foreach ($response2 as $dt): ?>
                                <option>{{$dt['TypeContent']}}</option>
                              <?php endforeach; ?>
                          </select>
                        </div>

                        <div class="col-sm-4">
                          <input type="text" class="form-control1" name="keyword" placeholder="Type title or description" />
                        </div>

                        <div class="col-sm-3" align='left'>
                          <button class="btn btn-primary" ><i class="fa fa-search "></i> Search</button>
                          <a href="/showContentManagementMasterContent"><button class="btn btn-primary"><i class="fa fa-refresh "></i> Reset</button></a>
                        </div>
                      </div>
                    </form>
                  </div>
              </div>
          </div>
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

          <div class="row">
            <div class=" col-sm-4 col-md-12">
              <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover text-center">
                      <thead>
                          <tr>
                              <th>NO</th>
                              <th>TITLE</th>
                              <th>SNIPPET</th>
                              <th>DETAIL</th>
          										<th>CATEGORY</th>
          										<th>STATUS</th>
          										<th>ACTION</th>
                              <th> </th>
                          </tr>
                      </thead>
                      <tbody>
                        @if($response != [])
                          <?php foreach ($response as $dt): ?>

                              <td>{{$dt['Id']}}</td>
                              <td>{{$dt['Title']}}</td>
                              <td>{{$dt['Snipset']}}</td>
                              <td>{{$dt['Detail']}}</td>
                              <td>{{$dt['Category']}}</td>
                              <td>{{$dt['Status']}}</td>
                              <td>
                                <form action="{{url('/showByIdContentManagementMasterContent')}}"  method="get">
                                  <input style="display:none" name="id" value="{{$dt['Id']}}">
                                  <button class="btn btn-primary"><i class="fa fa-edit "></i></button>
                                </form>
                              </td>

                              <td>
                                <form action="{{url('/deleteContentManagementMasterContent')}}"  method="get">
                                  <input style="display:none" name="id" value="{{$dt['Id']}}">
                                  <button class="btn btn-danger"><i class="fa fa-trash "></i></button>
                                </form>
                              </td>
                              </tr>
                          <?php endforeach; ?>
                        @else
                          No mst contents to show...
                        @endif

                      </tbody>
                  </table>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      @if($response->total() < 10)
                        <label>
                          {{$response->total()}} records
                        </label>
                      @else
                        <label>
                          {{$response->firstItem()}} to
                          {{$response->lastItem()}} of
                          {{$response->total()}} records
                        </label>
                      @endif
                    </div>
                    <div class="form-group col-md-6" align="right">
                      {{$response->withPath('/showContentManagementMasterContent')->links()}}
                    </div>
                  </div>
              </div>
            </div>
          </div>
</div>
@endsection
