@extends('layouts.master')
@section('title','ACCBid - Online Event')
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
                              <input type="text" id="StartDate" name="StartDate" class="form-control" value="<?php echo date('Y-m-d H:i:s', strtotime($dt1['MstOnlineEvent']['StartDate'])) ?>">
                            </div>
                            <div class="col-sm-3">
                              <input type="text" id="EndDate" name="EndDate" class="form-control" value="<?php echo date('Y-m-d H:i:s', strtotime($dt1['MstOnlineEvent']['EndDate'])) ?>">
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Open House Date</label>
                            <div class="col-sm-3">
                              <input type="text" id="OpenHouseStartDate" name="OpenHouseStartDate" class="form-control" value="<?php echo date('Y-m-d H:i:s', strtotime($dt1['MstOnlineEvent']['OpenHouseStartDate'])) ?>">
                            </div>
                            <div class="col-sm-3">
                              <input type="text" id="OpenHouseEndDate" name="OpenHouseEndDate" class="form-control" value="<?php echo date('Y-m-d H:i:s', strtotime($dt1['MstOnlineEvent']['OpenHouseStartDate'])) ?>">
                            </div>
                          </div>

                          <input type="text" style="display:none" name="EventCode" value="{{$dt1['MstOnlineEvent']['EventCode']}}">
                          <input type="text" style="display:none" name="AddedDate" value="{{$dt1['MstOnlineEvent']['AddedDate']}}">
                        <?php endforeach; ?>

                        <br>
                        @if($dt1['MstOnlineEvent']['IsActive'] = true)
                          <input type="text" style="display:none" name="IsActive" value=true>
                        @else
                          <input type="text" style="display:none" name="IsActive" value=false>
                        @endif
                        <input style="display:none" name="Id" value="{{$dt1['MstOnlineEvent']['Id']}}" required>
                        <input type="text" style="display:none"  name="UpdatedDate" value="<?php echo date('d-M-Y H:i:s');?>">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                      </form>
                      <a href="/OnlineEvent"><button class="btn btn-primary" onclick="myFunction()">Cancel</button></a>
                  </div>
              </div>
          </div>

<!-- /. PAGE INNER  -->
</div>
<script type="text/javascript">
$(function(){
  $('#StartDate').datetimepicker({
        format: 'Y-MM-DD HH:mm:ss',
      });
  $('#EndDate').datetimepicker({
        format: 'Y-MM-DD HH:mm:ss',
      });

      $('#StartDate').on('dp.change', function (e) {

          let eventStartDate = moment(e.date, 'DD/MM/YYYY');
          let minEventEndDate = eventStartDate.clone().add(0, 'days').startOf('day');
          let maxEventEndDate = eventStartDate.clone().add(30, 'days').endOf('day');

          $('#EndDate').data("DateTimePicker").clear();
          $('#EndDate').data("DateTimePicker").maxDate(maxEventEndDate);
          $('#EndDate').data("DateTimePicker").minDate(minEventEndDate);
      });
})

$(function(){
  $('#OpenHouseStartDate').datetimepicker({
        format: 'Y-MM-DD HH:mm:ss',
      });
  $('#OpenHouseEndDate').datetimepicker({
        format: 'Y-MM-DD HH:mm:ss',
      });

      $('#OpenHouseStartDate').on('dp.change', function (e) {

          let eventStartDate = moment(e.date, 'DD/MM/YYYY');
          let minEventEndDate = eventStartDate.clone().add(0, 'days').startOf('day');
          let maxEventEndDate = eventStartDate.clone().add(30, 'days').endOf('day');

          $('#OpenHouseEndDate').data("DateTimePicker").clear();
          $('#OpenHouseEndDate').data("DateTimePicker").maxDate(maxEventEndDate);
          $('#OpenHouseEndDate').data("DateTimePicker").minDate(minEventEndDate);
      });
})


</script>
@endsection
