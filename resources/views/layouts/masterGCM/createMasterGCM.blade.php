@extends('layouts.master')
@section('title','CreateOnlineEvent')
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
                    <form action="{{url('/CreateMasterGCM')}}"  method="get">

            						<label for="">Condition</label>
                                    <input type="text" class="form-control1" name="Condition" />
            						<label for="">Char Value 1</label>
                                    <input type="text" class="form-control1" name="CharValue1" />
            						<label for="">Char Desc 1</label>
                                    <input type="text" class="form-control1" name="CharDesc1" />

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
            							<label for="exampleInputFile">Upload Picture</label>
            							<input type="file" id="exampleInputFile" name="Picture"/>
            						</div>

            						<label>
            						  IsActive <input type="checkbox" name="IsActive"/>
            						</label>
            						<br>
            						<br>
                        <label>Time Stamp1</label>
                        <br>
                        <input type="datetime-local" name="AddedDate">
                        <br>
                        <label>Time Stamp2</label>
                        <br>
                        <input type="datetime-local" value="" class="date" name="UpdatedDate">
                        <br>
                        <br>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                        <a href="/MasterGCM"><button class="btn btn-primary">Cancel</button></a>
                    </form>

                  </div>

              </div>
          </div>

<!-- /. PAGE INNER  -->

</div>
@endsection
