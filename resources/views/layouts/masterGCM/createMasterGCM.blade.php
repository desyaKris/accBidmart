@extends('layouts.master')
@section('title','CreateOnlineEvent')
@section('Bank Account','a')
@section('Master Management','active-menu')
@section('content')
<div id="page-inner">
  <?php
  date_default_timezone_set('Asia/Bangkok');
  $script_tz = date_default_timezone_get();
  ?>
    <div class="row">
        <div class="col-md-12" class="page-head-line">
                  <h1 class="page-head-line">New Master GCM </h1>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
                  <div class="alert alert-info">
                    <form action="{{url('/CreateMasterGCM')}}"  autocomplete="off" method="POST"  enctype="multipart/form-data">
                      {!! csrf_field() !!}

                        <label for="">Condition &emsp;&emsp;</label>
                          <div  style="width:300px;">
                            <input class="form-control1" type="text" id="myInput" name="Condition" oninput="validateAlpha();" placeholder="Type AutoComplete or new condition" required/>
                          </div>
                        <br>
            						<label for="">Char Value 1</label>
                                    <input type="text" class="form-control1" name="CharValue1" required/>
            						<label for="">Char Desc 1</label>
                                    <input type="text" class="form-control1" name="CharDesc1" required/>

            						<label for="">Char Value 2</label>
                                    <input type="text" class="form-control1" name="CharValue2" />
            						<label for="">Char Desc 2</label>
                                    <input type="text" class="form-control1" name="CharDesc2" />

            						<label for="">Char Value 3</label>
                                    <input type="text" class="form-control1" name="CharValue3" />
            						<label for="">Char Desc 3</label>
            						<input type="text" class="form-control1" name="CharDesc3" />

            						<label for="">Char Value 4</label>
                                    <input type="text" class="form-control1" name="CharValue4" />
            						<label for="">Char Desc 4</label>
                                    <input type="text" class="form-control1" name="CharDesc4" />

            						<label for="">Char Value 5</label>
                                    <input type="text" class="form-control1" name="CharValue5" />
            						<label for="">Char Desc 5</label>
                                    <input type="text" class="form-control1" name="CharDesc5" />
            						<br>
            						<div class="form-group">
            							<img id="output" width="30%" height="30%"/>
            							<input type="file" id="exampleInputFile" name="Pict" accept="image/*" onchange="loadFile(event)" />
            						</div>

            						<label>
            						  IsActive
                          <input type="hidden" name="IsActive" value="N">
                          <input type="checkbox" name="IsActive" value="Y" >
            						</label>
            						<br>
            						<br>
                        <label>Time Stamp1</label>
                        <br>
                        <input type="text" style="display:none"  name="AddedDate" value="<?php echo date('d-M-Y H:i:s');?>">

                        <input type="datetime-local" name="TimeStamp1">
                        <br>
                        <label>Time Stamp2</label>
                        <br>
                        <input type="datetime-local" class="date" name="TimeStamp2">
                        <br>
                        <br>
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
@endsection
