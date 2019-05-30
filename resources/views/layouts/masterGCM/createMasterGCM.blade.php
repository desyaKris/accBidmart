@extends('layouts.master')
@section('title','ACCBid - New Master GCM')
@section('Dashboard','a')
@section('Master Management','active-menu')
@section('User Management','a')
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
                  <h1 class="page-head-line">New Master GCM</h1>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
                  <div class="alert alert-info">
                    <form action="{{url('/CreateMasterGCM')}}"  autocomplete="off" method="POST"  enctype="multipart/form-data">
                      {!! csrf_field() !!}

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Condition <span style="color:red">*</span></label>
                        <div class="col-sm-4">
                          <input class="form-control1" type="text" id="myInput" name="Condition" oninput="validateAlpha();" placeholder="Type AutoComplete or new condition" required/>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Char Value 1 <span style="color:red">*</span></label>
                        <div class="col-sm-2">
                          <input type="text" class="form-control1" name="CharValue1" required/>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Char Desc 1 <span style="color:red">*</span></label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control1" name="CharDesc1" required/>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Char Value 2</label>
                        <div class="col-sm-2">
                          <input type="text" class="form-control1" name="CharValue2"/>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Char Desc 2</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control1" name="CharDesc2"/>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Char Value 3</label>
                        <div class="col-sm-2">
                          <input type="text" class="form-control1" name="CharValue3"/>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Char Desc 3</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control1" name="CharDesc3"/>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Char Value 4</label>
                        <div class="col-sm-2">
                          <input type="text" class="form-control1" name="CharValue4"/>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Char Desc 4</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control1" name="CharDesc4"/>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Char Value 5</label>
                        <div class="col-sm-2">
                          <input type="text" class="form-control1" name="CharValue5"/>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Char Desc 5</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control1" name="CharDesc5"/>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Picture</label>
                        <div class="col-sm-5">
                          <img id="output" width="30%" height="30%"/>
            							<input type="file" id="exampleInputFile" name="Pict" accept="image/*" onchange="loadFile(event)" />
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">IsActive</label>
                        <div class="col-sm-5">
                          <input type="hidden" name="IsActive" value="N">
                          <input type="checkbox" name="IsActive" value="Y" >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Time Stamp1</label>
                        <div class="col-sm-3">
                          <input type="text" id="TimeStamp1" name="TimeStamp1" placeholder="YYYY-MM-DD HH:mm:SS">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Time Stamp2</label>
                        <div class="col-sm-3">
                          <input type="text" id="TimeStamp2" name="TimeStamp2" placeholder="YYYY-MM-DD HH:mm:SS">
                        </div>
                      </div>

                        <input type="text" style="display:none"  name="AddedDate" value="<?php echo date('d-M-Y H:i:s');?>">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                    </form>
                    <a href="/MasterGCM" class="btn btn-primary">Cancel</a>

                  </div>

              </div>
          </div>

<!-- /. PAGE INNER  -->

</div>
<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
  };

function validateAlpha(){
    var textInput = document.getElementById("myInput").value;
    textInput = textInput.replace(/[^A-Za-z_]/g, "");
    document.getElementById("myInput").value = textInput;
};

$( function() {
  var availableTags = [
    <?php foreach ($response3 as $dt1): ?>
    "{{$dt1['Condition']}}",
    <?php endforeach; ?>
  ];
  $( "#myInput" ).autocomplete({
    source: availableTags
  });
});

</script>

<script type="text/javascript">
$(function(){
  $('#TimeStamp1').datetimepicker({
        format: 'Y-MM-DD HH:mm:ss',
      });
  $('#TimeStamp2').datetimepicker({
        format: 'Y-MM-DD HH:mm:ss',
      });
})
</script>
@endsection
