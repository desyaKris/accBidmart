@extends('layouts.master')
@section('title','EditOnlineEvent')
@section('Bank Account','a')
@section('Master Management','active-menu')
@section('content')
<div id="page-inner">

    <div class="row">
        <div class="col-md-12" class="page-head-line">
          <?php foreach ($response3 as $dt1): ?>
            <h1 class="page-head-line">Edit Online Event '{{$dt1['MstOnlineEvent']['EventName']}}' - {{$dt1['MstOnlineEvent']['EventCode']}}</h1>
          <?php endforeach; ?>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
                  <div class="alert alert-info">
                    <form action="{{url('/CreateOnlineEvent')}}"  method="get">
                        <?php foreach ($response3 as $dt1): ?>
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Area Lelang</label>
                            <div class="col-sm-6">
                              <select class="form-control" name="AreaLelang" required>
                                <option>{{$dt1['MstGCM']['CharDesc1']}}</option>
                                @<?php foreach ($response as $dt): ?>
                                  if({{$dt['CharDesc1']}} != {{$dt1['MstGCM']['CharDesc1']}})
                                  {
                                    <option>{{$dt['CharDesc1']}}</option>
                                  }
                                  endif
                                <?php endforeach; ?>
                              </select>
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Balai Lelang</label>
                            <div class="col-sm-6">
                              <select class="form-control" name="BalaiLelang" required>
                                <option>{{$dt1['MstBalaiLelang']['Description']}}</option>
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
                              <input type="text" class="form-control1" name="EventName" value="{{$dt1['MstOnlineEvent']['EventName']}}" required/>
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Event Date</label>
                            <div class="col-sm-3">
                              <div class='input-group date' id='start_date_picker'>
                                <input type='text' class="form-control"  name="StartDate" value="{{$dt1['MstOnlineEvent']['StartDate']}}"/>
                                <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                              </div>
                            </div>

                            <div class="col-sm-3">
                              <div class='input-group date' id='end_date_picker'>
                                <input type='text' class="form-control" name="EndDate" value="{{$dt1['MstOnlineEvent']['EndDate']}}"/>
                                <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                              </div>
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Open House Date</label>
                            <div class="col-sm-3">
                              <div class='input-group date' id='start_date_picker1'>

                                <input type='text' class="form-control"  name="OpenHouseStartDate" value="{{$dt1['MstOnlineEvent']['OpenHouseStartDate']}}"/>
                                <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class='input-group date' id='end_date_picker1'>
                                <input type='text' class="form-control" name="OpenHouseEndDate" value="{{$dt1['MstOnlineEvent']['OpenHouseEndDate']}}"/>
                                <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                              </div>
                            </div>
                          </div>
                        <?php endforeach; ?>

                        <br>
                        <input style="display:none" name="AddDate" value="{{$dt1['MstOnlineEvent']['AddedDate']}}" required>
                        @if($dt1['MstOnlineEvent']['IsActive'] = true)
                          <input type="text" style="display:none" name="IsActive" value=true>
                        @else
                          <input type="text" style="display:none" name="IsActive" value=false>
                        @endif
                        <input style="display:none" name="Id" value="{{$dt1['MstOnlineEvent']['Id']}}" required>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                      </form>
                      <a href="/OnlineEvent"><button class="btn btn-primary" onclick="myFunction()">Cancel</button></a>
                  </div>
              </div>
          </div>

<!-- /. PAGE INNER  -->
</div>
<script type="text/javascript">
    $(function () {
    $('#start_date_picker').datetimepicker({
          format: 'd-M-Y H:m:s',
        });
    $('#end_date_picker').datetimepicker({
          format: 'd-M-Y H:m:s',
        });
    $('#start_date_picker').on('dp.change', function (e) {

        let eventStartDate = moment(e.date, 'DD/MM/YYYY');
        let minEventEndDate = eventStartDate.clone().add(1, 'days').startOf('day');
        let maxEventEndDate = eventStartDate.clone().add(30, 'days').endOf('day');

        $('#end_date_picker').data("DateTimePicker").clear();
        $('#end_date_picker').data("DateTimePicker").maxDate(maxEventEndDate);
        $('#end_date_picker').data("DateTimePicker").minDate(minEventEndDate);
    });

  });



  $(function () {
  $('#start_date_picker1').datetimepicker({
        format: 'd-M-Y H:m:s',
      });
  $('#end_date_picker1').datetimepicker({
        format: 'd-M-Y H:m:s',
      });
      $('#start_date_picker1').on('dp.change', function (e) {

          let eventStartDate1 = moment(e.date, 'DD/MM/YYYY');
          let minEventEndDate1 = eventStartDate.clone().add(1, 'days').startOf('day');
          let maxEventEndDate1 = eventStartDate.clone().add(30, 'days').endOf('day');

          $('#end_date_picker1').data("DateTimePicker").clear();
          $('#end_date_picker1').data("DateTimePicker").maxDate(maxEventEndDate1);
          $('#end_date_picker1').data("DateTimePicker").minDate(minEventEndDate1);
      });
});


</script>
@endsection
