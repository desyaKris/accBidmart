@extends('layouts.master')
@section('title','ACCBid - Bank Account')
@section('Bank Account','active-menu')
@section('Master Management','a')
@section('content')
<div id="page-inner">

  <?php
  date_default_timezone_set('Asia/Bangkok');
  $script_tz = date_default_timezone_get();
  ?>
    <div class="row">
        <div class="col-md-12" class="page-head-line">
                  <h1 class="page-head-line">Create Bank Accout</h1>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
                  <div class="alert alert-info">
                    <form action="{{url('/createBalaiLelang')}}"  method="get">
                      <div class="form-group row">

                        <label class="col-sm-2 col-form-label">Balai Lelang</label>
                        <div class="col-sm-4">
                          <select class="form-control" name="BalaiLelangId" required>
                            <option>{{$response3[0]['MstBalaiLelang']['Description']}}</option>
                            <?php foreach ($response1 as $dt): ?>
                              @if($dt['Description'] != $response3[0]['MstBalaiLelang']['Description'])
                                <option>{{$dt['Description']}}</option>
                              @endif

                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Bank</label>
                        <div class="col-sm-4">
                          <select class="form-control" name="GCMId" required>
                            <option>{{$response3[0]['MstGCM']['CharDesc1']}}</option>
                            <?php foreach ($response2 as $dt2): ?>
                                @if($dt2['CharDesc1'] != $response3[0]['MstGCM']['CharDesc1'])
                                  <option>{{$dt2['CharDesc1']}}</option>
                                @endif
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">No Rekening</label>
                        <div class="col-sm-4">
                          <input type="number" class="form-control1" name="NoRekening" value="{{$response3[0]['MstBankAccountBalang']['NoRekening']}}" required/>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nama Pemilik</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control1" name="NamaRekening"  value="{{$response3[0]['MstBankAccountBalang']['NamaRekening']}}"required/>
                        </div>
                      </div>
                        <input type="text" style="display:none" name="id" value="{{$response3[0]['MstBankAccountBalang']['Id']}}">
                        <input type="text" style="display:none" name="AddedDate" value="{{$response3[0]['MstBankAccountBalang']['AddedDate']}}">
                        <input type="text" style="display:none"  name="UpdatedDate" value="<?php echo date('d-M-Y H:i:s');?>">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                      </form>
                        <a href="/BankAccountBalaiLelang"><button class="btn btn-primary">Cancel</button></a>
                  </div>

              </div>
          </div>

<!-- /. PAGE INNER  -->

</div>
@endsection
