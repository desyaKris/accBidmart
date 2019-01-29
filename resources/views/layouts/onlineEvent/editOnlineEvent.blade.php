@extends('layouts.master')
@section('title','CreateOnlineEvent')
@section('content')
<div id="page-inner">

    <div class="row">
        <div class="col-md-12" class="page-head-line">
                  <h1 class="page-head-line">Edit Online Event </h1>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
                  <div class="alert alert-info">
                    <form action="{{url('/CreateOnlineEvent')}}"  method="get">
                        @<?php foreach ($response3 as $dt1): ?>

                          <label>Area Lelang</label>
                          <select class="form-control" name="AreaLelang" value="{{$dt1['AreaLelang']}}">
                            @<?php foreach ($response as $dt): ?>
                              <option>{{$dt['AreaLelang']}}</option>
                            <?php endforeach; ?>
                          </select>

                          <label for="">Balai Lelang</label>
                          <select class="form-control" name="BalaiLelang" value="{{$dt1['BalaiLelang']}}">
                            @<?php foreach ($response2 as $dt2): ?>
                              <option>{{$dt2['BalaiLelang']}}</option>
                            <?php endforeach; ?>
                          </select>

                          <label for="">Event Name</label>

                          <input type="text" class="form-control1" name="EventName" value="{{$dt1['EventName']}}" placeholder="Type the Event Name, Area Lelang, Balai Lelang" />
                          <label>Event Date</label>
                          <br>
                          <input type="datetime-local" name="StartDate" value=""> <input type="datetime-local" name="EndDate" value="">
                          <br>
                          <label>Open House Date</label>
                          <br>
                          <input type="datetime-local" name="OpenHouseStartDate"> <input type="datetime-local" name="OpenHouseEndDate" value="">
                        <?php endforeach; ?>

                        <br>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                        <a href="/OnlineEvent"><button class="btn btn-primary">Cancel</button></a>
                      </form>

                  </div>
              </div>
          </div>

<!-- /. PAGE INNER  -->
</div>
@endsection
