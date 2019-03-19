@extends('layouts.master')
@section('title','ACCBid - Auction Result')
@section('Bank Account','a')
@section('Master Management','a')
@section('Auction Result','active-menu')
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
                <h1>Unsold</h1>
              </div>
              <div class="col-sm-6" class='vertical-center' align="center">
                  <a href="#"><button class="btn btn-primary"><i class="fa fa-download">  </i>Download Auction Result  </button></a>
              </div>
            </div>
            </form>
            <div class="page-head-line">
						</div>
          </div>

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
                          <input type="text" id="StartDate" name="StartDate" value="<?php echo date('Y-m-d');?>" class="form-control">
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
                    <table class="table table-striped table-bordered table-hover text-center" id="tableUnsold">
                        <thead>
                            <tr>
                                <th>LOT NO</th>
                                <th>NO KONTRAK</th>
                                <th>NO POLISI</th>
                                <th>MINIMUM PRICE</th>
                                <th>EVENT NAME</th>
                                <th>START DATE</th>
                                <th>STATUS UNIT</th>
                                <th>SYNC ERROR</th>
                            </tr>
                        </thead>
                    </table>
                    @if(!empty($response))
                    @else
                    <p>No units canceled to show...</p>
                    @endif
                </div>
              </div>
            </div>

            <input type="file" onchange="encodeImageFileAsURL(this)" name="" value="">
            <script type="text/javascript">
              function encodeImageFileAsURL(element) {
              var file = element.files[0];
              var reader = new FileReader();
              reader.onloadend = function() {
                console.log('RESULT', reader.result)
              }
              reader.readAsDataURL(file);
              }
            </script>
</div>
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
                  url: base_url + '/OnlineEventUnsoldByDate/'+value,
                  success: function(data){
                    var arr = {};
                    data.forEach(function(mst){
                      arr[mst.MstOnlineEvent.EventCode] = mst.MstOnlineEvent.EventName
                    })
                    var d = JSON.stringify(arr)
                    buildDropdown(jQuery.parseJSON(d),$('#OnlineEvent'),'--All Online Event--');
                  }
              });

              $.ajax({
                  type: "GET",
                  url: base_url + '/showAllUnsoldData/'+value,
                  success: function(data){
                    var arr = {};

                    var dataTable='';
                    data.forEach(function(mst){
                      dataTable += '<tr>';
                      dataTable += '<td>'+mst.MstUnit.LotNo+'</td>';
                      dataTable += '<td>'+mst.MstUnit.NoKontrak+'</td>';
                      dataTable += '<td>'+mst.MstUnit.NoPolisi+'</td>';
                      dataTable += '<td>'+mst.MstUnit.MinimumPrice+'</td>';
                      dataTable += '<td>'+mst.MstOnlineEvent.EventName+'</td>';
                      dataTable += '<td>'+mst.MstOnlineEvent.StartDate+'</td>';
                      dataTable += '<td>'+mst.MstUnit.StatusUnit+'</td>';
                      dataTable += '</tr>';
                    })
                    console.log(dataTable)
                    $('#tableUnsold').append(dataTable);

                  }
              });
              $('#tableUnsold').remove();

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
  $('#OnlineEvent').on('change',function(){
  var value = $(this).val();
  console.log(value)
  });
</script>


@endsection
