@extends('layouts.master')
@section('title','ACCBid - Bank Account')
@section('content')
@section('Bank Account','active-menu')
@section('Master Management','a')
<div id="page-inner">
  <?php
  date_default_timezone_set('Asia/Bangkok');
  $script_tz = date_default_timezone_get();
  ?>
          <div class="row">
              <div class="col-md-12" >
    						<div class="page-head-line">
    						<h1>Bank Account Customer </h1>
    						</div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                  <div class="alert alert-info">
                    <form action="{{ url('/searchBankAccountCustomer')}}"  method="get">
                    <input type="text" class="form-control1" name="searchKeyword" placeholder="Type the User, Bank, No Rekening, Nama Rekening" />
                                  <button class="btn btn-primary" ><i class="fa fa-search "></i> Search</button>
                                  <a href="/BankAccountCustomer"><button class="btn btn-primary"><i class="fa fa-refresh "></i> Reset</button></a>
                    </form>
                  </div>
              </div>
          </div>
          <script>

          </script>
          <div class="row">
            <div class=" col-sm-4 col-md-12">
              <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>USERNAME</th>
                                        <th>BANK</th>
                                        <th>NO REKENING</th>
                    										<th>NAMA REKENING</th>
                    										<th>ADDED DATE</th>
                    										<th>UPDATED DATE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($response as $dt): ?>
                                    <tr>
                                      <td>{{$dt['User']['Name']}}</td>
                                      <td>{{$dt['MstGCM']['CharDesc1']}}</td>
                                      <td>{{$dt['MstBankAccountCustomer']['NoRekening']}}</td>
                                      <td>{{$dt['MstBankAccountCustomer']['NamaRekening']}}</td>
                                      <td><?php echo date('d-M-Y H:i:s', strtotime($dt['MstBankAccountCustomer']['AddedDate'])) ?></td>
                                      @if(!empty($dt['MstBankAccountCustomer']['UpdatedDate']))
                                        <td><?php echo date('d-M-Y H:i:s', strtotime($dt['MstBankAccountCustomer']['UpdatedDate'])) ?></td>
                                      @else
                                        <td>-</td>
                                      @endif
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
                                {{$response->withPath('/BankAccountCustomer')->links()}}
                              </div>
                            </div>


                      <!-- <div id="app">
                        <button v-on:click="greet">Greet</button>
                        <h2>@{{ results }}</h2>
                      </div> -->
              </div>
            </div>
          </div>
</div>
@endsection
