@extends('layouts.master')
@section('title','OnlineEvent')
@section('content')
<div id="page-inner">
                <div class="row">
                    <div class="col-md-12" class="page-head-line">
						<div class="floating-box">
						<h1 class="page-head-line">Online Event </h1>
						</div>
						<a href="/ShowCreateOnlineEvent"><button class="btn btn-primary"><i class="fa fa-plus">  </i>Create New Online Event  </button></a>
							<button class="btn btn-primary"><i class="fa fa-upload"> </i>  Upload Online Item</button>
              </div>
          </div>
          <div class="row">

              <div class="col-md-12">
                  <div class="alert alert-info">
                    <form action="{{ url('/SearchOnlineEvent') }}"  method="get">
                    <input type="text" class="form-control1" name="data" placeholder="Type the Event Name, Area Lelang, Balai Lelang" />
                                  <button class="btn btn-primary" ><i class="fa fa-search "></i> Search</button>
                                  <a href="/OnlineEvent"><button class="btn btn-primary"><i class="fa fa-refresh "></i> Reset</button></a>
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
                                      <td>{{$dt['CodeAreaLelang']}}<br>{{$dt['AreaLelang']}}</td>
                                      <td>{{$dt['BalaiLelang']}}</td>
                                      <td>{{$dt['EventName']}}</td>
                                      <td>{{$dt['StartDate']}} <br> to <br> {{$dt['EndDate']}}</td>
                                      <td>{{$dt['OpenHouseStartDate']}} <br> to <br> {{$dt['OpenHouseEndDate']}}</td>
                                      <td>{{$dt['AddDate']}}</td>
                                      @if ($dt['IsActive'] == 'Y' )
                                          <td><input type="checkbox" checked="true"/></td>
                                      @else
                                      <td><input type="checkbox"/></td>
                                      @endif
                                      <td>
                                        <form action="{{url('/EditOnlineEvent')}}"  method="get">
                                          <input style="display:none" name="id" value="{{$dt['Id']}}">
                                          <button class="btn btn-primary"><i class="fa fa-edit "></i></button>
                                        </form>
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
