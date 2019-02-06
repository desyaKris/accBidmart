@extends('layouts.master')
@section('title','EditOnlineEvent')
@section('content')
<div id="page-inner">

    <div class="row">
        <div class="col-md-12" class="page-head-line">
          <?php foreach ($response3 as $dt1): ?>
            <h1 class="page-head-line">Edit Online Event '{{$dt1['EventName']}}' - {{$dt1['EventCode']}}</h1>
          <?php endforeach; ?>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
                  <div class="alert alert-info">
                    <form action="{{url('/CreateOnlineEvent')}}"  method="get">
                        <?php foreach ($response3 as $dt1): ?>
                          <input style="display:none" name="Id" value="{{$dt1['Id']}}" required>
                          <label>Area Lelang</label>
                          <select class="form-control" name="AreaLelang" required>
                            <option>{{$dt1['AreaLelang']}}</option>
                            @<?php foreach ($response as $dt): ?>
                              if({{$dt['AreaLelang']}} != {{$dt1['AreaLelang']}})
                              {
                                <option>{{$dt['AreaLelang']}}</option>
                              }
                              endif
                            <?php endforeach; ?>
                          </select>
                          <label>Balai Lelang</label>
                          <select class="form-control" name="BalaiLelang" required>
                            <option>{{$dt1['BalaiLelang']}}</option>
                            @<?php foreach ($response2 as $dt2): ?>
                              <option>{{$dt2['BalaiLelang']}}</option>
                            <?php endforeach; ?>
                          </select>
                          <input style="display:none" name="AddDate" value="{{$dt1['AddDate']}}" required>
                          <label for="">Event Name</label>
                          <input type="text" class="form-control1" name="EventName" value="{{$dt1['EventName']}}" placeholder="Type the Event Name, Area Lelang, Balai Lelang" required/>
                          <label>Event Date</label>
                          <br>
                          <input type="datetime-local" name="StartDate" value="{{$dt1['StartDate']}}" required> <input type="datetime-local" name="EndDate" value="{{$dt1['EndDate']}}"required>
                          <br>
                          <label>Open House Date</label>
                          <br>
                          <input type="datetime-local" name="OpenHouseStartDate" value="{{$dt1['OpenHouseStartDate']}}" required> <input type="datetime-local" name="OpenHouseEndDate" value="{{$dt1['OpenHouseEndDate']}}"required>
                          <input type="text" style="display:none" name="IsActive" value="{{$dt1['IsActive']}}">
                        <?php endforeach; ?>

                        <br>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                      </form>
                      <a href="/OnlineEvent"><button class="btn btn-primary" onclick="myFunction()">Cancel</button></a>
                  </div>
              </div>
          </div>

<!-- /. PAGE INNER  -->
</div>
@endsection
