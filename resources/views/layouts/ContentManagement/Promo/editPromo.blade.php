@extends('layouts.master')
@section('title','ACCBid - Master Content')
@section('Dashboard','a')
@section('Master Management','a')
@section('User Management','a')
@section('Auction Event','a')
@section('Auction Result','a')
@section('Bank Account','a')
@section('Deposit','a')
@section('ContentManagement','active-menu')
@section('View History','a')
@section('content')

<div id="page-inner">

  <?php
  date_default_timezone_set('Asia/Bangkok');
  $script_tz = date_default_timezone_get();
  ?>
    <div class="row">
        <div class="col-md-12" class="page-head-line">
                  <h1 class="page-head-line">New Promo</h1>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
                  <div class="alert alert-info">
                    <form action="{{url('/createContentManagementPromo')}}"  method="POST" enctype="multipart/form-data">
                      {!! csrf_field() !!}
                      <?php foreach ($response as $dt): ?>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-6">
                              <input type="text" class="form-control1" name="Name" value="{{$dt['Name']}}" required>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Description</label>
                          <div class="col-sm-10">
                              <textarea name="Description" id="summernote" required>{{$dt['Description']}}</textarea>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">IsActive</label>
                          <div class="col-sm-2">
                            <label>
                              @if($dt['IsActive'] = true)
                              <input type="hidden" name="IsActive" value="N">
                              <input type="checkbox" name="IsActive" value="Y" checked>
                              @else
                              <input type="hidden" name="IsActive" value="N">
                              <input type="checkbox" name="IsActive" value="Y">
                              @endif

                						</label>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Picture</label>
                          <div class="col-sm-3">
                            <input type="file" name="Picture" value="">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Promo Code</label>
                          <div class="col-sm-6">
                              <input type="text" class="form-control1" name="PromoCode" value="{{$dt['PromoCode']}}">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Promo Type</label>
                          <div class="col-sm-3">
                            <select class="form-control" name="PromoType">
                              @if($dt['PromoType'] == "FIXED VALUE")
                              <option>{{$dt['PromoType']}}</option>
                              <option>PERCENTAGE</option>
                              <option>UNO</option>
                              @elseif($dt['PromoType'] == "PERCENTAGE")
                              <option>{{$dt['PromoType']}}</option>
                              <option>FIXED VALUE</option>
                              <option>UNO</option>
                              @else
                              <option>{{$dt['PromoType']}}</option>
                              <option>FIXED VALUE</option>
                              <option>PERCENTAGE</option>
                              @endif

                            </select>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Promo Amount</label>
                          <div class="col-sm-6">
                              <input type="number" class="form-control1" name="PromoAmount" value="{{$dt['PromoAmount']}}">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Start Date</label>
                          <div class="col-sm-3">
                            <input type="text" id="StartDate" name="StartDate" class="form-control" value="<?php echo date('Y-m-d H:i:s', strtotime($dt['StartDate'])) ?>">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">End Date</label>
                          <div class="col-sm-3">
                            <input type="text" id="EndDate" name="EndDate" class="form-control" value="<?php echo date('Y-m-d H:i:s', strtotime($dt['EndDate'])) ?>">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Syarat Dan Ketentuan</label>
                          <div class="col-sm-10">
                              <textarea name="SyaratDanKetentuan" id="summernote1" required>{{$dt['SyaratDanKetentuan']}}</textarea>
                          </div>
                        </div>
                      <?php endforeach; ?>

                      <div class="form-group row">
                        <div class="col-sm-3">
                          <input type="text" name="Id"  style="display:none" value="{{$dt['Id']}}">
                          <input type="text" name="AddedDate" style="display:none" value="<?php echo date('Y-m-d H:i:s', strtotime($dt['AddedDate'])) ?>">
                          <input type="text" style="display:none"  name="UpdatedDate" value="<?php echo date('Y-m-d H:i:s');?>">
                          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                        </div>
                      </div>
                      </form>
                        <a href="#"><button class="btn btn-primary">Cancel</button></a>
                  </div>

              </div>
          </div>

<!-- /. PAGE INNER  -->

</div>

<script>
  $('#summernote').summernote({
    tabsize: 3,
    height: 150,
    toolbar: [
    // [groupName, [list of button]]
    ['misc',['undo','redo']],
    ['style', ['bold', 'italic', 'underline']],
    ['font', ['strikethrough']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['insert',['link','picture','table']]
  ]
  });

  $('#summernote1').summernote({
    tabsize: 3,
    height: 150,
    toolbar: [
    // [groupName, [list of button]]
    ['misc',['undo','redo']],
    ['style', ['bold', 'italic', 'underline']],
    ['font', ['strikethrough']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['insert',['link','picture','table']]
  ]
  });
</script>

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
</script>

@endsection
