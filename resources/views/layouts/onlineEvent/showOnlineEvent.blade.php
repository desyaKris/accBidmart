@extends('layouts.master')
@section('title','OnlineEvent')
@section('content')
<div id="page-inner">
                <div class="row">
                    <div class="col-md-12" class="page-head-line">
						<div class="floating-box">
						<h1 class="page-head-line">Online Event </h1>
						</div>
						<a href="/CreateOnlineEvent"><button class="btn btn-primary"><i class="fa fa-plus">  </i>Create New Online Event  </button></a>
							<button class="btn btn-primary"><i class="fa fa-upload"> </i>  Apload Online Item</button>
              </div>
          </div>
          <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-info">
							<input type="text" class="form-control1" placeholder="Type the Event Name, Area Lelang, Balai Lelang" />
                            <button class="btn btn-primary"><i class="fa fa-search "></i> Search</button>
							<button class="btn btn-primary"><i class="fa fa-refresh "></i> Reset</button>
                        </div>
                    </div>
                </div>
<div class="row">
      <div class=" col-sm-4 col-md-12">
        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>EVENT CODE</th>
                                        <th>AREA LELANG</th>
                                        <th>BALAI LELANG</th>
                    										<th>EVENT NAME</th>
                    										<th>EVENT DATE</th>
                    										<th>OPEN HOUSE DATE</th>
                    										<th>ADDED DATE</th>
                    										<th>IS ACTIVE</th>
                    										<th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($response as $dt): ?>
                                    <tr>
                                      <td>{{$dt['EventCode']}}</td>
                                      <td>{{$dt['AreaLelang']}}</td>
                                      <td>{{$dt['BalaiLelang']}}</td>
                                      <td>{{$dt['EventName']}}</td>
                                      <td>{{$dt['StartDate']}} <br> to <br> {{$dt['EndDate']}}</td>
                                      <td>{{$dt['OpenHouseStartDate']}}</td>
                                      <td>{{$dt['AddDate']}}</td>
                                      @if ($dt['IsActive'] == 'Y' )
                                        <td><input type="checkbox" checked="true"/></td>
                                      @else
                                      <td><input type="checkbox"/></td>
                                      @endif
                                      <td>
                                        <button class="btn btn-primary"><i class="fa fa-edit "></i></button>
                                      </td>
                                    </tr>
                                  <?php endforeach; ?>
                                </tbody>
                            </table>
              </div>
</div>
</div>
            <!-- /. PAGE INNER  -->
        </div>

@endsection
