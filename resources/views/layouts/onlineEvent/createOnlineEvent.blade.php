@extends('layouts.master')
@section('title','CreateOnlineEvent')
@section('content')
<div id="page-inner">
  <form action="{{ url('/UpdateOnlineEvent') }}"  method="post">
    <div class="row">
        <div class="col-md-12" class="page-head-line">
                  <h1 class="page-head-line">Online Event </h1>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
                  <div class="alert alert-info">

                      <label for="">Area Lelang</label>
                      <select class="form-control" name="AreaLelang">
                        @<?php foreach ($response as $dt): ?>
                          <option>{{$dt['AreaLelang']}}</option>
                        <?php endforeach; ?>
                      </select>

                        <label for="">Balai Lelang</label>
                      <select class="form-control" name="BalaiLelang">
                        <option>Astria</option>
                        <option>Balai Lelang 1999</option>
                        <option>IBID</option>
                      </select>

                      <label for="">Event Name</label>
                      <input type="text" class="form-control1" name="EventName" placeholder="Type the Event Name, Area Lelang, Balai Lelang" />

                      <label>Event Date</label>
                      <br>
                      <input type="datetime-local" name="StartDate" value=""> <input type="datetime-local" name="EndDate" value="">
                      <br>
                      <label>Open House Date</label>
                      <br>
                      <input type="datetime-local" name="OpenHouseStartDate" value=""> <input type="datetime-local" name="OpenHouseEndDate" value="">
                      <br>
                  </div>
                  <button class="btn btn-primary"><i class="fa fa-save "></i> Save</button>
                  <button class="btn btn-primary">Cancel</button>
              </div>
          </div>
  </form>
<!-- /. PAGE INNER  -->
</div>
@endsection
