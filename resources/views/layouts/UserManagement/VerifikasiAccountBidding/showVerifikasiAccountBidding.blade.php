@extends('layouts.master')
@section('title','ACCBid - Account Approval')
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
  <!-- untuk setdefault timezone Indonesia -->
  <?php
  date_default_timezone_set('Asia/Bangkok');
  $script_tz = date_default_timezone_get();
  ?>
  <div class="row">
      <div class="col-md-12" >
				<div class="page-head-line">
				<h1>Verifikasi Account Bidding</h1>
				</div>
      </div>
  </div>
  <div class="row">
      <div class="col-md-12">
          <div class="alert alert-info">
            <form action="{{ url('/searchVerifikasiAccountBidding')}}"  method="get">
              <div class="form-group row">

                <div class="col-sm-9">
                  <input type="text" class="form-control1" name="keyword" placeholder="Type the Name,Username,NIK, or NPWP" />
                </div>

                <div class="col-sm-3" align='left'>
                  <button class="btn btn-primary" ><i class="fa fa-search "></i> Search</button>
                  <a href="/VerifikasiAccountBidding"><button class="btn btn-primary"><i class="fa fa-refresh "></i> Reset</button></a>
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
                      <th>NAME</th>
                      <th>USERNAME</th>
                      <th>NIK</th>
                      <th>NPWP</th>
  										<th>ACTION</th>
                  </tr>
              </thead>
              <tbody>
                @if($response != [])
                  <?php foreach ($response as $dt): ?>

                      <td>{{$dt['Name']}}</td>
                      <td>{{$dt['Username']}}</td>
                      <td>{{$dt['NIK']}}</td>
                      <td>{{$dt['NPWP']}}</td>
                      <td>
                        <form action="{{url('/showByIdAccountBidding')}}"  method="get">
                          <input style="display:none" name="id" id="id" value="{{$dt['Id']}}">
                          <button class="btn btn-primary"><i class="fa fa-edit "></i></button>
                        </form>
                      </td>
                      </tr>
                  <?php endforeach; ?>
                @else
                  No Account Bidding to show...
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
              {{$response->withPath('/VerifikasiAccountBidding')->links()}}
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
@section('AccountBindingNotif')
{{$response->total()}}
@endsection
@endsection
