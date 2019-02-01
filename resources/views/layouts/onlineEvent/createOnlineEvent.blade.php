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
                  <h1 class="page-head-line">Online Event </h1>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
                  <div class="alert alert-info">
                    <form action="{{url('/CreateOnlineEvent')}}"  method="get">
                        <label>Area Lelang</label>
                        <select class="form-control" name="AreaLelang">
                          @<?php foreach ($response as $dt): ?>
                            <option>{{$dt['AreaLelang']}}</option>
                          <?php endforeach; ?>
                        </select>

                        <label for="">Balai Lelang</label>
                        <select class="form-control" name="BalaiLelang">
                          @<?php foreach ($response2 as $dt2): ?>
                            <option>{{$dt2['BalaiLelang']}}</option>
                          <?php endforeach; ?>
                        </select>

                        <label for="">Event Name</label>
                        <input type="text" class="form-control1" name="EventName" />

                        <label>Event Date</label>
                        <br>
                        <input type="datetime-local" name="StartDate"> <input type="datetime-local" name="EndDate" value="">
                        <br>
                        <label>Open House Date</label>
                        <br>
                        <input type="datetime-local" value="" class="date" name="OpenHouseStartDate"> <input type="datetime-local" name="OpenHouseEndDate" value="">
                        <br>
                        <br>
                        <input type="text" style="display:none"  name="AddDate" value="<?php echo date('d-M-Y H:i:s');?>">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                        <a href="/OnlineEvent"><button class="btn btn-primary">Cancel</button></a>
                      </form>

                  </div>

              </div>
          </div>

<!-- /. PAGE INNER  -->

</div>
@endsection
