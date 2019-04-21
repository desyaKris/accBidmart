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
    						<h1>Promo</h1>
                <form action="{{url('/showCreateContentManagementPromo')}}"  method="get">
                  <a href="#"><button class="btn btn-primary"><i class="fa fa-plus">  </i>Create new Promo  </button></a>
                </form>

    						</div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                  <div class="alert alert-info">
                    <form action="{{ url('/showContentManagementPromo')}}"  method="get">
                      <div class="form-group row">

                        <div class="col-sm-9">
                          <input type="text" class="form-control1" name="keyword" placeholder="Type the Name,Description" />
                        </div>

                        <div class="col-sm-3" align='left'>
                          <button class="btn btn-primary" ><i class="fa fa-search "></i> Search</button>
                          <a href="/showContentManagementPromo"><button class="btn btn-primary"><i class="fa fa-refresh "></i> Reset</button></a>
                        </div>
                      </div>
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
                  <table class="table table-striped table-bordered table-hover text-center">
                      <thead>
                          <tr>
                              <th>NAME</th>
                              <th>DESCRIPTION</th>
                              <th>START DATE</th>
                              <th>END DATE</th>
          										<th>ISACTIVE</th>
          										<th>ACTION</th>
                              <th> </th>
                          </tr>
                      </thead>
                      <tbody>
                        @if($response != [])
                          <?php foreach ($response as $dt): ?>

                              <td>{{$dt['Name']}}</td>
                              <td>{{$dt['Description']}}</td>
                              <td><?php echo date('d-M-Y H:i:s', strtotime($dt['StartDate'])) ?></td>
                              <td><?php echo date('d-M-Y H:i:s', strtotime($dt['EndDate'])) ?></td>
                              @if(!empty($dt['IsActive']))
                                <form action="{{url('/UpdateCondition')}}" method="get">
                                  <input style="display:none" name="id" value="{{$dt['Id']}}">
                                  </td>
                                  <td><button class="btn"><img src="/images/123.png" width="30" height="30"></button></td>
                                </form>

                              @else
                                <form action="{{url('/UpdateCondition')}}" method="get">
                                  <input style="display:none" name="id" value="{{$dt['Id']}}">

                                  <td><button class="btn"><img src="/images/1234.png" width="30" height="30"></button></td>
                                </form>

                              @endif
                              <td>
                                <form action="{{url('/showByIdContentManagementPromo')}}"  method="get">
                                  <input style="display:none" name="id" value="{{$dt['Id']}}">
                                  <button class="btn btn-primary"><i class="fa fa-edit "></i></button>
                                </form>
                              </td>

                              <td>
                                <form action="{{url('/deleteContentManagementPromo')}}"  method="get">
                                  <input style="display:none" name="id" value="{{$dt['Id']}}">
                                  <button class="btn btn-danger"><i class="fa fa-trash "></i></button>
                                </form>
                              </td>
                              </tr>
                          <?php endforeach; ?>
                        @else
                          No mst contents to show...
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
                      {{$response->withPath('/showContentManagementPromo')->links()}}
                    </div>
                  </div>
              </div>
            </div>
          </div>
</div>
@endsection
