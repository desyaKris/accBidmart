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
          <div class="row">
              <div class="col-md-12" >
    						<div class="page-head-line">
    						<h1>Auction Result </h1>
                <form action="{{url('/DownloadAuctionResultBatalLelang')}}"  method="get">
                  <input type="text" style="display:none" name="formName" value="AuctionResultBatalLelang">
                  <input type="text" style="display:none" name="firstPage" value="{{$response->firstItem()}}">
                  <input type="text" style="display:none" name="lastPage" value="{{$response->lastItem()}}">
                  <a href="#"><button class="btn btn-primary"><i class="fa fa-download">  </i>Download Auction Result  </button></a>
                </form>

    						</div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                  <div class="alert alert-info">
                    <form action="{{ url('/SearchBatalLelang')}}"  method="get">
                    <input type="text" class="form-control1" name="keyword" placeholder="Type the Lot No, No Kontrak, No Polisi" />
                        <button class="btn btn-primary" ><i class="fa fa-search "></i> Search</button>
                        <a href="/AuctionResultBatalLelang"><button class="btn btn-primary"><i class="fa fa-refresh "></i> Reset</button></a>
                    </form>
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
                              <th>MINIMUM PRICE (RP.)</th>
          										<th>POOL</th>
          										<th>AREA LELANG</th>
          										<th>BALAI LELANG</th>
          										<th>STATUS UNIT</th>
          										<th>STATUS PAYMENT</th>
          										<th>SYNC ERROR</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($response as $dt): ?>

                            <td>{{$dt['MstUnit']['LotNo']}}</td>
                            <td>{{$dt['MstUnit']['NoKontrak']}}</td>
                            <td>{{$dt['MstUnit']['NoPolisi']}}<br><font size="2" color="grey">{{$dt['MstUnit']['Brand']}}/{{$dt['MstUnit']['Type']}}/{{$dt['MstUnit']['Model']}}/{{$dt['MstUnit']['Tahun']}}</font></td>
                            <td><?php echo number_format($dt['MstUnit']['MinimumPrice'])."<br>"; ?></td>

                            @if(!empty($dt['MstUnit']['Pool']))
                              <td>{{$dt['MstUnit']['Pool']}}</td>
                            @else
                              <td>-</td>
                            @endif

                            <td>{{$dt['MstGCM']['CharDesc1']}}</td>
                            <td>{{$dt['MstBalaiLelang']['Description']}}</td>
                            @if(!empty($dt['MstStatus']['Label']))
                              <td>{{$dt['MstStatus']['Label']}}</td>
                            @else
                              <td>-</td>
                            @endif

                            @if(!empty($dt['MstAuctionEvent']['StatusPayment']))
                              <td>{{$dt['MstAuctionEvent']['StatusPayment']}}</td>
                            @else
                              <td>-</td>
                            @endif

                            @if(empty($dt['MstAuctionEvent']['IsSyncError']))
                            <td>-</td>
                            @else
                              @if($dt['MstAuctionEvent']['IsSyncError'] = true)
                                <td>!</td>
                              @else
                                <td>-</td>
                              @endif
                            @endif
                            </tr>
                        <?php endforeach; ?>
                      </tbody>
                  </table>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      @if($response->total() < 10)
                        <label>
                          {{$response->total()}} records
                        </label>
                      @else
                        <label>
                          {{$response->firstItem()}} to
                          {{$response->lastItem()}} of
                          {{$response->total()}} records
                        </label>
                      @endif
                    </div>
                    <div class="form-group col-md-6" align="right">
                      {{$response->withPath('/AuctionResultBatalLelang')->links()}}
                    </div>
                  </div>
              </div>
            </div>
          </div>
</div>
@endsection
