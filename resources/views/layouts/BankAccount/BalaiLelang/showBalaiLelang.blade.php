@extends('layouts.master')
@section('title','ACCBid - Bank Account')
@section('Dashboard','a')
@section('Master Management','a')
@section('User Management','a')
@section('Auction Event','a')
@section('Auction Result','a')
@section('Bank Account','active-menu')
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
              <div class="col-md-12" >
    						<div class="page-head-line">
    						<h1>Bank Account Balai Lelang </h1>
                <a href="/showCreateBalaiLelang"><button class="btn btn-primary"><i class="fa fa-plus">  </i>Create Bank Accout</button></a>
    						</div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                  <div class="alert alert-info">
                    <form action="{{ url('/searchBankAccountBalaiLelang')}}"  method="get">
                    <input type="text" class="form-control1" name="searchKeyword" placeholder="Type the Balai Lelang, Bank, No Rekening, Nama Rekening" />
                      <button class="btn btn-primary" ><i class="fa fa-search "></i> Search</button>
                      <a href="/BankAccountBalaiLelang"><button class="btn btn-primary"><i class="fa fa-refresh "></i> Reset</button></a>
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
                  <table class="table table-striped table-bordered table-hover">
                      <thead>
                          <tr>
                              <th>BALAI LELANG</th>
                              <th>BANK</th>
                              <th>NO REKENING</th>
          										<th>NAMA REKENING</th>
          										<th>ADDED DATE</th>
          										<th>UPDATED DATE</th>
                              <th>ACTION</th>
                              <th></th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($response as $dt): ?>
                          <tr>
                            <td>{{$dt['MstBalaiLelang']['Description']}}</td>
                            <td>{{$dt['MstGCM']['CharDesc1']}}</td>
                            <td>{{$dt['MstBankAccountBalang']['NoRekening']}}</td>
                            <td>{{$dt['MstBankAccountBalang']['NamaRekening']}}</td>
                            <td><?php echo date('d-M-Y H:i:s', strtotime($dt['MstBankAccountBalang']['AddedDate'])) ?></td>
                            @if(!empty($dt['MstBankAccountBalang']['UpdatedDate']))
                              <td><?php echo date('d-M-Y H:i:s', strtotime($dt['MstBankAccountBalang']['UpdatedDate'])) ?></td>
                            @else
                              <td>-</td>
                            @endif
                            <td>
                              <form action="{{url('/editBalaiLelang')}}" method="get">
                                <input style="display:none" name="id" value="{{$dt['MstBankAccountBalang']['Id']}}">
                                <button class="btn btn-primary"><i class="fa fa-edit"></i></button>
                              </form>
                            </td>
                            <td>
                              <form action="{{url('/deteleBalaiLelang')}}" method="get">
                                <input style="display:none" name="id" value="{{$dt['MstBankAccountBalang']['Id']}}">
                                <button  class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data?')"><i class="fa fa-trash"></i></button>
                              </form>
                            </td>
                          </tr>
                        <?php endforeach; ?>
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
                      {{$response->withPath('/BankAccountBalaiLelang')->links()}}
                    </div>
                  </div>

              </div>
            </div>
          </div>
</div>
@endsection
