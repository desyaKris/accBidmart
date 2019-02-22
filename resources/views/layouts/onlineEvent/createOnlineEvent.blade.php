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
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Area Lelang</label>
                        <div class="col-sm-6">
                          <select class="form-control" name="AreaLelang" required>
                            @<?php foreach ($response as $dt): ?>
                              <option>{{$dt['CharDesc1']}}</option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Balai Lelang</label>
                        <div class="col-sm-6">
                          <select class="form-control" name="BalaiLelang" required>
                            @<?php foreach ($response2 as $dt2): ?>
                              @if(!empty($dt2['Description']))
                              <option>{{$dt2['Description']}}</option>
                              @else

                              @endif

                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Event Name</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control1" name="EventName" required/>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Event Date</label>
                        <div class="col-sm-3">
                          <input type="text" id="StartDate" name="StartDate" class="form-control">
                        </div>
                        <div class="col-sm-3">
                          <input type="text" id="EndDate" name="EndDate" class="form-control">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Open House Date</label>
                        <div class="col-sm-3">
                          <input type="text" id="OpenHouseStartDate" name="OpenHouseStartDate" class="form-control">
                        </div>
                        <div class="col-sm-3">
                          <input type="text" id="OpenHouseEndDate" name="OpenHouseEndDate" class="form-control">
                        </div>
                      </div>

                        <input type="text" style="display:none"  name="AddedDate" value="<?php echo date('d-M-Y H:i:s');?>">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                      </form>
                        <a href="/OnlineEvent"><button class="btn btn-primary">Cancel</button></a>
                  </div>

              </div>
          </div>

<!-- /. PAGE INNER  -->

</div>

<script type="text/javascript">

$(function(){
  $('#StartDate').datetimepicker({
        format: 'd-M-Y H:m:s',
      });
  $('#EndDate').datetimepicker({
        format: 'd-M-Y H:m:s',
      });

      $('#StartDate').on('dp.change', function (e) {

          let eventStartDate = moment(e.date, 'DD/MM/YYYY');
          let minEventEndDate = eventStartDate.clone().add(1, 'days').startOf('day');
          let maxEventEndDate = eventStartDate.clone().add(30, 'days').endOf('day');

          $('#EndDate').data("DateTimePicker").clear();
          $('#EndDate').data("DateTimePicker").maxDate(maxEventEndDate);
          $('#EndDate').data("DateTimePicker").minDate(minEventEndDate);
      });
})

$(function(){
  $('#OpenHouseStartDate').datetimepicker({
        format: 'd-M-Y H:m:s',
      });
  $('#OpenHouseEndDate').datetimepicker({
        format: 'd-M-Y H:m:s',
      });

      $('#OpenHouseStartDate').on('dp.change', function (e) {

          let eventStartDate = moment(e.date, 'DD/MM/YYYY');
          let minEventEndDate = eventStartDate.clone().add(1, 'days').startOf('day');
          let maxEventEndDate = eventStartDate.clone().add(30, 'days').endOf('day');

          $('#OpenHouseEndDate').data("DateTimePicker").clear();
          $('#OpenHouseEndDate').data("DateTimePicker").maxDate(maxEventEndDate);
          $('#OpenHouseEndDate').data("DateTimePicker").minDate(minEventEndDate);
      });
})

</script>
@endsection
