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
@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

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
                      arr[mst.MstOnlineEvent.EventName] = mst.MstOnlineEvent.EventName
                    })
                    var d = JSON.stringify(arr)
                    buildDropdown(jQuery.parseJSON(d),$('#OnlineEvent'),'--All Online Event--');
                  }
              });

              $.ajax({
                  type: "GET",
                  url: base_url + '/showAllUnsoldData/'+value,
                  success: function(data){
                    $('tbody').children('tr').empty()
                    var dataTable=[];
                    var counter=0;
                    if(data!=null)
                    {
                      data.forEach(function(mst){
                        var lotNo
                        var StatusUnit

                        if(typeof mst.MstUnit.LotNo == 'undefined'){
                          lotNo=""
                        }
                        else {
                          lotNo=mst.MstUnit.LotNo
                        }

                        if(typeof mst.MstUnit.StatusUnit == 'undefined'){
                          StatusUnit=""
                        }
                        else {
                          StatusUnit=mst.MstUnit.StatusUnit
                        }
                        dataTable[counter] = [
                          lotNo,
                          mst.MstUnit.NoKontrak,
                          mst.MstUnit.NoPolisi,
                          mst.MstUnit.MinimumPrice,
                          mst.MstOnlineEvent.EventName,
                          mst.MstOnlineEvent.StartDate,
                          StatusUnit]
                        counter++
                      })

                      if ( $.fn.dataTable.isDataTable( '#tableUnsold' ) ) {
                          table = $('#tableUnsold').DataTable();
                          table.destroy()
                      }
                      else {
                        table = $('#tableUnsold').DataTable( {
                          // dom: 'Bfrtip',
                          //   buttons: [
                          //   {
                          //     extend: 'excel',
                          //     text: 'Export excel',
                          //     className: 'btn btn-primary',
                          //     filename: 'Export excel',
                          //     exportOptions: {
                          //       modifier: {
                          //         page: 'current'
                          //       }
                          //     }
                          //   }
                          // ]
                            data: dataTable,
                            columns: [
                                { title: "LOT NO" },
                                { title: "NO KONTRAK" },
                                { title: "NO POLISI" },
                                { title: "MINIMUM PRICE" },
                                { title: "EVENT NAME" },
                                { title: "START DATE" },
                                { title: "STATUS UNIT" }
                            ]


                        });
                        $('#tableUnsold tbody').on( 'mouseenter', 'td', function () {
                            var colIdx = table.cell(this).index().column;

                            $( table.cells().nodes() ).removeClass( 'highlight' );
                            $( table.column( colIdx ).nodes() ).addClass( 'highlight' );
                        } );
                      }

                    }
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

<script>
console.log("tommy")
function myFunction() {
  $('#tableUnsold').DataTable( {
    dom: 'Bfrtip',
      buttons: [
      {
        extend: 'excel',
        text: 'Export excel',
        className: 'exportExcel',
        filename: 'Export excel',
        exportOptions: {
          modifier: {
            page: 'all'
          }
        }
      }
    ]
})
}
</script>

@endsection
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
                  <button class="btn btn-primary" ><i class="fa fa-download">  </i>Download Auction Result  </button>
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
                            <input type="text" class="form-control1" name="keyword" id='search' placeholder="Type the Lot No, No Kontrak, No Polisi" />
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
                                <option value="{{$dt['MstOnlineEvent']['EventName']}}">{{$dt['MstOnlineEvent']['EventName']}}</option>
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
                    <table class="table table-striped table-bordered table-hover text-center" id="tableUnsold" style="width:100%">
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
  $('#OnlineEvent').on('change',function(){
  var value = $(this).val();
  var StartDate=$("#StartDate").val();
  var base_url = '{{ url("/") }}';
  if(value=='')
  {
    $.ajax({
        type: "GET",
        url: base_url + '/showAllUnsoldData/'+StartDate,
        success: function(data){
          $('tbody').children('tr').empty()
          var dataTable=[];
          var counter=0;
          console.log(data)
            data.forEach(function(mst){
              var lotNo
              var StatusUnit

              if(typeof mst.MstUnit.LotNo == 'undefined'){
                lotNo=""
              }
              else {
                lotNo=mst.MstUnit.LotNo
              }

              if(typeof mst.MstUnit.StatusUnit == 'undefined'){
                StatusUnit=""
              }
              else {
                StatusUnit=mst.MstUnit.StatusUnit
              }

              dataTable[counter] = [
                lotNo,
                mst.MstUnit.NoKontrak,
                mst.MstUnit.NoPolisi,
                mst.MstUnit.MinimumPrice,
                mst.MstOnlineEvent.EventName,
                mst.MstOnlineEvent.StartDate,
                StatusUnit]
              counter++
            })

            if ( $.fn.dataTable.isDataTable( '#tableUnsold' ) ) {
                table = $('#tableUnsold').DataTable();
                table.destroy()

                if ($.fn.dataTable.isDataTable( '#tableUnsold' )) {

                }
                else {
                  table = $('#tableUnsold').DataTable( {
                      data: dataTable,
                      columns: [
                          { title: "LOT NO" },
                          { title: "NO KONTRAK" },
                          { title: "NO POLISI" },
                          { title: "MINIMUM PRICE" },
                          { title: "EVENT NAME" },
                          { title: "START DATE" },
                          { title: "STATUS UNIT" }
                      ]
                  });
                  $('#tableUnsold tbody').on( 'mouseenter', 'td', function () {
                      var colIdx = table.cell(this).index().column;

                      $( table.cells().nodes() ).removeClass( 'highlight' );
                      $( table.column( colIdx ).nodes() ).addClass( 'highlight' );
                  } );
                }
            }
            else {
              table = $('#tableUnsold').DataTable( {
                  data: dataTable,
                  columns: [
                      { title: "LOT NO" },
                      { title: "NO KONTRAK" },
                      { title: "NO POLISI" },
                      { title: "MINIMUM PRICE" },
                      { title: "EVENT NAME" },
                      { title: "START DATE" },
                      { title: "STATUS UNIT" }
                  ]
              });
              $('#tableUnsold tbody').on( 'mouseenter', 'td', function () {
                  var colIdx = table.cell(this).index().column;

                  $( table.cells().nodes() ).removeClass( 'highlight' );
                  $( table.column( colIdx ).nodes() ).addClass( 'highlight' );
              } );
            }


        }
    });
  }
  if(value != ''){
      $.ajax({
          type: "GET",
          url: base_url + '/showUnsoldByOnlineEvent/'+StartDate+'/'+value,
          success: function(data){
            $('tbody').children('tr').empty()
            var dataTable=[];
            var counter=0;
            if(data!=null)
            {
              data.forEach(function(mst){
                var lotNo
                var StatusUnit

                if(typeof mst.MstUnit.LotNo == 'undefined'){
                  lotNo=""
                }
                else {
                  lotNo=mst.MstUnit.LotNo
                }

                if(typeof mst.MstUnit.StatusUnit == 'undefined'){
                  StatusUnit=""
                }
                else {
                  StatusUnit=mst.MstUnit.StatusUnit
                }

                dataTable[counter] = [
                  lotNo,
                  mst.MstUnit.NoKontrak,
                  mst.MstUnit.NoPolisi,
                  mst.MstUnit.MinimumPrice,
                  mst.MstOnlineEvent.EventName,
                  mst.MstOnlineEvent.StartDate,
                  StatusUnit]
                counter++
              })

              if ( $.fn.dataTable.isDataTable( '#tableUnsold' ) ) {
                  table = $('#tableUnsold').DataTable();
                  table.destroy()
              }
              else {
                table = $('#tableUnsold').DataTable( {
                    data: dataTable,
                    columns: [
                        { title: "LOT NO" },
                        { title: "NO KONTRAK" },
                        { title: "NO POLISI" },
                        { title: "MINIMUM PRICE" },
                        { title: "EVENT NAME" },
                        { title: "START DATE" },
                        { title: "STATUS UNIT" }
                    ]
                });
                $('#tableUnsold tbody').on( 'mouseenter', 'td', function () {
                    var colIdx = table.cell(this).index().column;

                    $( table.cells().nodes() ).removeClass( 'highlight' );
                    $( table.column( colIdx ).nodes() ).addClass( 'highlight' );
                } );
              }

            }
          }
      });
  }
  });
</script>

<script type="text/javascript">
$(function(){
  $('#search').datetimepicker({
        format: 'Y-MM-DD',
      }).on('dp.change',function(ev){
        console.log(ev)
      });
    })
</script>
@endsection
