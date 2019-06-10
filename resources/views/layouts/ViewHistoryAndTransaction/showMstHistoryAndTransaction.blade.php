@extends('layouts.master')
@section('title','ACCBid - User CMS Approval')
@section('Dashboard','a')
@section('Master Management','a')
@section('User Management','active-menu')
@section('Auction Event','a')
@section('Auction Result','a')
@section('Bank Account','a')
@section('Deposit','a')
@section('ContentManagement','a')
@section('View History','a')
@section('content')
<div id="page-inner">
  <!-- untuk setdefault timezone Indonesia -->
  <?php
  date_default_timezone_set('Asia/Bangkok');
  $script_tz = date_default_timezone_get();
  ?>

          <div class="tab">
            <button class="tablinks" onclick="ViewHistory(event, 'MstHistoryDeposit')" id="defaultOpen">MstHistoryDeposit</button>
            <button class="tablinks" onclick="ViewHistory(event, 'MstTransaction')">MstTransaction</button>
            <button class="tablinks" onclick="ViewHistory(event, 'MstHistoryGenerateCode')">MstHistoryGenerateCode</button>
            <button class="tablinks" onclick="ViewHistory(event, 'MstVersionNumber')">MstVersionNumber</button>
          </div>

          <div id="MstHistoryDeposit" class="tabcontent">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info">
                      <form action="{{ url('/searchMstHistoryDeposit')}}"  method="get">
                        <div class="form-group row">
                          <div class="col-sm-9">
                            <input type="text" class="form-control1" name="keyword" id='search' />
                          </div>
                          <div class="col-sm-3" align='center'>
                            <button class="btn btn-primary" ><i class="fa fa-search "></i> Search</button>
                            <a href="/showViewHistoryAndTransaction"><button class="btn btn-primary"><i class="fa fa-refresh "></i> Reset</button></a>
                          </div>
                        </div>
                      </form>
                      <form action="{{url('/downloadMstHistoryDeposit')}}"  method="get">
                        <input type="text" style="display:none" name="formName" value="MstHistoryDeposit">
                        <input type="text" style="display:none" name="firstPage" value="{{$response->firstItem()}}">
                        <input type="text" style="display:none" name="lastPage" value="{{$response->lastItem()}}">
                        <a href="#"><button class="btn btn-primary"><i class="fa fa-download">  </i>Download Auction Result  </button></a>
                      </form>
                    </div>
                </div>
            </div>

            @if (Session::get('alert')  == "success")
            <div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>{{ Session::get('message') }}</strong>
            </div>

            @elseif(Session::get('alert')  == "error")
            <div class="alert alert-danger alert-dismissible">
               <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                 <strong>{{ Session::get('message') }}</strong>
             </div>
            @endif

            <div class="row">
              <div class=" col-sm-4 col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover text-center" id="tableUnsold" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>TRANSACTION ID</th>
                                <th>NOMINAL</th>
                                <th>TOTAL SALDO</th>
                                <th>USERNAME</th>
                                <th>BA BALANG</th>
                                <th>BA CUSTOMER</th>
                                <th>STATUS ID</th>
                                <th>TYPE</th>
                                <th>ADDED DATE</th>
                                <th>UPDATED DATE</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                          @if($response != [])
                          <?php foreach ($response as $dt): ?>
                            <td>{{$dt['Id']}}</td>
                            <td>{{$dt['TransactionId']}}</td>
                            <td>{{$dt['Nominal']}}</td>
                            <td>{{$dt['TotalSaldo']}}</td>
                            <td>{{$dt['UserId']}}</td>
                            <td>{{$dt['MstBABalang']}}</td>
                            <td>{{$dt['MstBACustomer']}}</td>
                            <td>{{$dt['Status']}}</td>
                            <td>{{$dt['Type']}}</td>
                            <td>{{$dt['AddedDate']}}</td>
                            <td>{{$dt['UpdatedDate']}}</td>

                            <td>
                              <form action="{{url('/deleteMstHistoryDeposit')}}"  method="get">
                                <input style="display:none" name="id" value="{{$dt['Id']}}">
                                <button class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data?')"><i class="fa fa-trash "></i></button>
                              </form>
                            </td>
                            </tr>
                          <?php endforeach; ?>
                          @else
                            No mst deposit to show...
                          @endif
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
                        {{$response->withPath('/showViewHistoryAndTransaction')->links()}}
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>

          <div id="MstTransaction" class="tabcontent">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info">
                      <form action="{{ url('/searchMstTransaction')}}"  method="get">
                        <div class="form-group row">
                          <div class="col-sm-9">
                            <input type="text" class="form-control1" name="keyword" id='search' placeholder="Type the Lot No, No Kontrak, No Polisi" />
                          </div>
                          <div class="col-sm-3" align='center'>
                            <button class="btn btn-primary" ><i class="fa fa-search "></i> Search</button>
                            <a href="/showViewHistoryAndTransaction"><button class="btn btn-primary"><i class="fa fa-refresh "></i> Reset</button></a>
                          </div>
                        </div>

                      <div class="form-group row">
                        <div class="col-sm-3">
                          <input type="text" id="StartDate" name="StartDate" value="<?php echo date('Y-m-d');?>" class="form-control">
                        </div>
                        <div class="col-sm-5">
                          <select class="form-control" name="OnlineEvent" id="OnlineEvent">
                              <option>--All Online Event--</option>
                              <?php foreach ($response3 as $dt): ?>
                                <option value="{{$dt['MstOnlineEvent']['EventName']}}">{{$dt['MstOnlineEvent']['EventName']}}</option>
                              <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                      </form>
                      <form action="{{url('/downloadMstTransaction')}}"  method="get">
                        <input type="text" style="display:none" name="formName" value="MstTransaction">
                        <input type="text" style="display:none" name="firstPage" value="{{$response2->firstItem()}}">
                        <input type="text" style="display:none" name="lastPage" value="{{$response2->lastItem()}}">
                        <a href="#"><button class="btn btn-primary"><i class="fa fa-download">  </i>Download Auction Result  </button></a>
                      </form>
                    </div>
                </div>
            </div>
            @if (Session::get('alert2')  == "succes2s")
            <div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>{{ Session::get('message2') }}</strong>
            </div>

            @elseif(Session::get('alert2')  == "error2")
            <div class="alert alert-danger alert-dismissible">
               <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                 <strong>{{ Session::get('message2') }}</strong>
             </div>
            @endif
            <div class="row">
              <div class=" col-sm-4 col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover text-center" id="tableUnsold" style="width:100%">
                        <thead>
                            <tr>
                                <th>USERNAME</th>
                                <th>UNIT</th>
                                <th>OFFER PRICE</th>
                                <th>MIN PRICE</th>
                                <th>PRICE</th>
                                <th>TRANS DATE</th>
                                <th>STATUSUNIT</th>
                                <th>PAYMENT TYPE</th>
                                <th>NOTIFENDEVENT</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                          @if($response2 != [])
                          <?php foreach ($response2 as $dt2): ?>
                            <td>{{$dt2['UserId']}}</td>
                            <td>{{$dt2['UnitId']}}</td>
                            <td>{{$dt2['OfferPrice']}}</td>
                            <td>{{$dt2['MinPrice']}}</td>
                            <td>{{$dt2['OfferPrice']}}</td>
                            <td><?php echo date('d-M-Y H:i:s', strtotime($dt2['TransactionDate'])) ?></td>
                            <td>{{$dt2['StatusUnit']}}</td>
                            <td>{{$dt2['PaymentType']}}</td>
                            <?php if ($dt2['NotifEndType'] = true): ?>
                              <td>True</td>
                              <?php else: ?>
                                <td>False</td>
                            <?php endif; ?>


                            <td>
                              <form action="{{url('/deleteMstTransaction')}}"  method="get">
                                <input style="display:none" name="id" value="{{$dt2['Id']}}">
                                <button class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data?')"><i class="fa fa-trash "></i></button>
                              </form>
                            </td>
                            </tr>
                          <?php endforeach; ?>
                          @else
                            No mst transaction to show...
                          @endif
                        </tbody>
                    </table>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        @if($response2->total() < 10)
                          <label>
                            {{$response2->total()}} records
                          </label>
                        @else
                          <label>
                            {{$response2->firstItem()}} to
                            {{$response2->lastItem()}} of
                            {{$response2->total()}} records
                          </label>
                        @endif
                      </div>
                      <div class="form-group col-md-6" align="right">
                        {{$response->withPath('/showViewHistoryAndTransaction')->links()}}
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>

<script type="text/javascript">
$(function(){
  $('#StartDate').datetimepicker({
        format: 'Y-MM-DD',
      }).on('dp.change',function(ev){
        console.log(ev)
      });
    })
</script>

<script>
function ViewHistory(evt, ViewHistoryName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(ViewHistoryName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
@endsection
