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
                            @<?php foreach ($response1 as $dt): ?>
                              <option>{{$dt['Description']}}</option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Bank</label>
                        <div class="col-sm-4">
                          <select class="form-control" name="GCMId" required>
                            @<?php foreach ($response2 as $dt2): ?>
                              @if(!empty($dt2['CharDesc1']))
                              <option>{{$dt2['CharDesc1']}}</option>
                              @else

                              @endif

                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">No Rekening</label>
                        <div class="col-sm-4">
                          <input type="number" class="form-control1" name="NoRekening" required/>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nama Pemilik</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control1" id="myInput" oninput="validateAlpha();" name="NamaRekening" required/>
                        </div>
                      </div>


                        <input type="text" style="display:none"  name="AddedDate" value="<?php echo date('d-M-Y H:i:s');?>">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                      </form>
                        <a href="/BankAccountBalaiLelang"><button class="btn btn-primary">Cancel</button></a>
                  </div>

              </div>
          </div>

<!-- /. PAGE INNER  -->

</div>
<script>
function validateAlpha(){
    var textInput = document.getElementById("myInput").value;
    textInput = textInput.replace(/[^A-Za-z]/g, "");
    document.getElementById("myInput").value = textInput;
}
</script>
@endsection
