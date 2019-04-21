@extends('layouts.master')
@section('title','ACCBid - Auction Result')
@section('Dashboard','a')
@section('Master Management','a')
@section('User Management','a')
@section('Auction Event','a')
@section('Auction Result','active-menu')
@section('Bank Account','a')
@section('Deposit','a')
@section('View History','a')
@section('content')
<div id="page-inner">
  <!-- untuk setdefault timezone Indonesia -->
  <?php
  date_default_timezone_set('Asia/Bangkok');
  $script_tz = date_default_timezone_get();
  ?>
          <div class="col-md-12" >
            <form action="{{url('/DownloadAuctionResultSold')}}"  method="get">
            <div class="form-group row">
              <div class="col-sm-5">
                <h1>Sold</h1>
              </div>
              <div class="col-sm-6" class='vertical-center' align="center">
                  <a href="#"><button class="btn btn-primary"><i class="fa fa-download">  </i>Download Auction Result  </button></a>
              </div>
            </div>
            </form>
            <div class="page-head-line">
						</div>
          </div>

          <div class="tab">
            <button class="tablinks" onclick="openCity(event, 'WaitingPayment')" id="defaultOpen">Waiting Payment Verification</button>
            <button class="tablinks" onclick="openCity(event, 'Completed')">Completed</button>
            <button class="tablinks" onclick="openCity(event, 'Canceled')">Canceled</button>
          </div>

          <div id="WaitingPayment" class="tabcontent">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info">
                      <form action="{{ url('/SearchBatalLelang')}}"  method="get">
                        <div class="form-group row">
                          <div class="col-sm-9">
                            <input type="text" class="form-control1" name="keyword" placeholder="Type the Lot No, No Kontrak, No Polisi" />
                          </div>
                          <div class="col-sm-3" align='center'>
                            <button class="btn btn-primary" ><i class="fa fa-search "></i> Search</button>
                            <a href="/AuctionResultBatalLelang"><button class="btn btn-primary"><i class="fa fa-refresh "></i> Reset</button></a>
                          </div>
                        </div>
                      </form>
                      <div class="form-group row">
                        <div class="col-sm-3">
                          <input type="text" id="StartDate" name="StartDate"  class="form-control" value="<?php echo date('Y-m-d');?>">
                        </div>

                        <div class="col-sm-5">
                          <select class="form-control" name="OnlineEvent" id="OnlineEvent">
                              <option>--All Online Event--</option>
                              <?php foreach ($OnlineEventbyDate as $dt): ?>
                                <option>{{$dt['MstOnlineEvent']['EventName']}}</option>
                              <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                </div>
            </div>

            <div class="row">
              <div class=" col-sm-4 col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover text-center">
                        <thead>
                            <tr>
                                <th>LOT NO</th>
                                <th>NO KONTRAK</th>
                                <th>NO POLISI</th>
                                <th>SOLD PRICE</th>
                                <th>PRICE AFTER PROMO</th>
                                <th>EVENT NAME</th>
                                <th>START DATE</th>
                                <th>BUYER</th>
                                <th>ACTION</th>
                                <th>SYNC ERROR</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tr>
                        </tbody>
                    </table>
                    @if(!empty($response))
                    @else
                    <p>No units sold to show...</p>
                    @endif

                </div>
              </div>
            </div>
          </div>

          <div id="Completed" class="tabcontent">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info">
                      <form action="{{ url('/SearchBatalLelang')}}"  method="get">
                        <div class="form-group row">
                          <div class="col-sm-9">
                            <input type="text" class="form-control1" name="keyword" placeholder="Type the Lot No, No Kontrak, No Polisi" />
                          </div>
                          <div class="col-sm-3" align='center'>
                            <button class="btn btn-primary" ><i class="fa fa-search "></i> Search</button>
                            <a href="/AuctionResultBatalLelang"><button class="btn btn-primary"><i class="fa fa-refresh "></i> Reset</button></a>
                          </div>
                        </div>
                      </form>
                      <div class="form-group row">
                        <div class="col-sm-3">
                          <input type="text" id="StartDate1" name="StartDate1" value="<?php echo date('Y-m-d');?>" class="form-control">
                        </div>
                        <div class="col-sm-5">
                          <select class="form-control" name="OnlineEvent1" id="OnlineEvent1">
                              <option>--All Online Event--</option>
                              <?php foreach ($OnlineEventbyDate as $dt): ?>
                                <option>{{$dt['MstOnlineEvent']['EventName']}}</option>
                              <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                </div>
            </div>

            <div class="row">
              <div class=" col-sm-4 col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover text-center">
                        <thead>
                            <tr>
                              <th>LOT NO</th>
                              <th>NO KONTRAK</th>
                              <th>NO POLISI</th>
                              <th>SOLD PRICE</th>
                              <th>PRICE AFTER PROMO</th>
                              <th>EVENT NAME</th>
                              <th>START DATE</th>
                              <th>BUYER</th>
                              <th>ACTION</th>
                              <th>SYNC ERROR</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tr>
                        </tbody>
                    </table>
                    @if(!empty($response))
                    @else
                    <p>No units Completed to show...</p>
                    @endif

                </div>
              </div>
            </div>
          </div>

          <div id="Canceled" class="tabcontent">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info">
                      <form action="{{ url('/SearchBatalLelang')}}"  method="get">
                        <div class="form-group row">
                          <div class="col-sm-9">
                            <input type="text" class="form-control1" name="keyword" placeholder="Type the Lot No, No Kontrak, No Polisi" />
                          </div>
                          <div class="col-sm-3" align='center'>
                            <button class="btn btn-primary" ><i class="fa fa-search "></i> Search</button>
                            <a href="/AuctionResultBatalLelang"><button class="btn btn-primary"><i class="fa fa-refresh "></i> Reset</button></a>
                          </div>
                        </div>
                      </form>
                      <div class="form-group row">
                        <div class="col-sm-3">
                          <input type="text" id="StartDate2" name="StartDate2" value="<?php echo date('Y-m-d');?>" class="form-control">
                        </div>
                        <div class="col-sm-5">
                          <select class="form-control" name="OnlineEvent2" id="OnlineEvent2">
                              <option>--All Online Event--</option>
                              <?php foreach ($OnlineEventbyDate as $dt): ?>
                                <option>{{$dt['MstOnlineEvent']['EventName']}}</option>
                              <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                </div>
            </div>

            <div class="row">
              <div class=" col-sm-4 col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover text-center">
                        <thead>
                            <tr>
                                <th>LOT NO</th>
                                <th>NO KONTRAK</th>
                                <th>NO POLISI</th>
                                <th>SOLD PRICE</th>
                                <th>PRICE AFTER PROMO</th>
                                <th>EVENT NAME</th>
                                <th>START DATE</th>
                                <th>BUYER</th>
                                <th>ACTION</th>
                                <th>SYNC ERROR</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tr>
                        </tbody>
                    </table>
                    @if(!empty($response))
                    @else
                    <p>No units canceled to show...</p>
                    @endif
                </div>
              </div>
            </div>
          </div>
</div>
<script>
  function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
  }

  // Get the element with id="defaultOpen" and click on it
  document.getElementById("defaultOpen").click();
</script>

<script type="text/javascript">
$(function(){
  $('#StartDate').datetimepicker({
        format: 'Y-MM-DD',
      });

      $('#StartDate').on('dp.change', function(){
          var value = $(this).val();
           var base_url = '{{ url("/") }}';

          if(value != ''){
              $.ajax({
                  type: "GET",
                  url: base_url + '/OnlineEventByDate/'+value,
                  success: function(data){
                    var arr = {};
                    console.log(data)
                    data.forEach(function(mst){
                      arr[mst.MstOnlineEvent.EventCode] = mst.MstOnlineEvent.EventName
                    })
                    var d = JSON.stringify(arr)
                    buildDropdown(jQuery.parseJSON(d),$('#OnlineEvent'),'--All Online Event--');
                  }
              });
          }
      });

      function buildDropdown(result, dropdown, emptyMessage) {
            dropdown.html('');
            dropdown.append('<option value="">' + emptyMessage + '</option>');
            if(result != '')
            {
                $.each(result, function(k, v) {
                    dropdown.append('<option value="' + k + '">' + v + '</option>');
                });
            }
        }
})
</script>

<script type="text/javascript">
$(function(){
  $('#StartDate1').datetimepicker({
        format: 'Y-MM-DD',
      });

      $('#StartDate1').on('dp.change', function(){
          var value = $(this).val();
           var base_url = '{{ url("/") }}';

          if(value != ''){
              $.ajax({
                  type: "GET",
                  url: base_url + '/OnlineEventByDate/'+value,
                  success: function(data){
                    var arr = {};
                    console.log(data)
                    data.forEach(function(mst){
                      arr[mst.MstOnlineEvent.EventCode] = mst.MstOnlineEvent.EventName
                    })
                    var d = JSON.stringify(arr)
                    buildDropdown(jQuery.parseJSON(d),$('#OnlineEvent1'),'--All Online Event--');
                  }
              });
          }
      });

      function buildDropdown(result, dropdown, emptyMessage) {
            dropdown.html('');
            dropdown.append('<option value="">' + emptyMessage + '</option>');
            if(result != '')
            {
                $.each(result, function(k, v) {
                    dropdown.append('<option value="' + k + '">' + v + '</option>');
                });
            }
        }
})

</script>

<script type="text/javascript">
$(function(){
  $('#StartDate2').datetimepicker({
        format: 'Y-MM-DD',
      });

      $('#StartDate2').on('dp.change', function(){
          var value = $(this).val();
           var base_url = '{{ url("/") }}';

          if(value != ''){
              $.ajax({
                  type: "GET",
                  url: base_url + '/OnlineEventByDate/'+value,
                  success: function(data){
                    var arr = {};
                    console.log(data)
                    data.forEach(function(mst){
                      arr[mst.MstOnlineEvent.EventCode] = mst.MstOnlineEvent.EventName
                    })
                    var d = JSON.stringify(arr)
                    buildDropdown(jQuery.parseJSON(d),$('#OnlineEvent2'),'--All Online Event--');
                  }
              });
          }
      });

      function buildDropdown(result, dropdown, emptyMessage) {
            dropdown.html('');
            dropdown.append('<option value="">' + emptyMessage + '</option>');
            if(result != '')
            {
                $.each(result, function(k, v) {
                    dropdown.append('<option value="' + k + '">' + v + '</option>');
                });
            }
        }
})

</script>
@endsection
