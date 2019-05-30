@extends('layouts.master')
@section('title','ACCBid - Master Content')
@section('Dashboard','a')
@section('Master Management','a')
@section('User Management','a')
@section('Auction Event','a')
@section('Auction Result','a')
@section('Bank Account','a')
@section('Deposit','a')
@section('ContentManagement','Active-menu')
@section('View History','a')
<!-- @section('head')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.js"></script>
@endsection -->
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
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control1" name="Name" id="Name" oninput="validateAlpha();" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                          <textarea name="Description" id="summernote" required></textarea>
                        </div>
                          <!-- <input type="text" name="Description" id="summernote" required> -->
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">IsActive</label>
                        <div class="col-sm-2">
                          <label>
                            <input type="hidden" name="IsActive" value="N">
                            <input type="checkbox" name="IsActive" value="Y" >
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
                            <input type="text" class="form-control1" name="PromoCode" id="PromoCode" oninput="validateAlpha2();">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Promo Type</label>
                        <div class="col-sm-3">
                          <select class="form-control" name="PromoType">
                              <option>FIXED VALUE</option>
                                <option>PERCENTAGE</option>
                                <option>UNO</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Promo Amount</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control1" name="PromoAmount">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Start Date</label>
                        <div class="col-sm-3">
                          <input type="text" id="StartDate" name="StartDate" class="form-control" placeholder="YYYY-MM-DD HH:mm:SS">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">End Date</label>
                        <div class="col-sm-3">
                          <input type="text" id="EndDate" name="EndDate" class="form-control" placeholder="YYYY-MM-DD HH:mm:SS">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Syarat Dan Ketentuan</label>
                        <div class="col-sm-10">
                          <textarea name="SyaratDanKetentuan" id="summernote1" required></textarea>
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-sm-3">
                          <input type="text" style="display:none"  name="AddedDate" value="<?php echo date('Y-m-d H:i:s');?>">
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

function validateAlpha(){
    var textInput = document.getElementById("Name").value;
    textInput = textInput.replace(/[^A-Za-z_]/g, "");
    document.getElementById("Name").value = textInput;
};

function validateAlpha2(){
    var textInput = document.getElementById("PromoCode").value;
    textInput = textInput.replace(/[^A-Za-z_]/g, "");
    document.getElementById("PromoCode").value = textInput;
};

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
