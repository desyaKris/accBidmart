@extends('layouts.master')
@section('title','OnlineEvent')
@section('content')
<div id="page-inner">
  <?php
  date_default_timezone_set('Asia/Bangkok');
  $script_tz = date_default_timezone_get();
  ?>
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
                    <form action="{{ url('/SearchOnlineEvent')}}"  method="get">
                    <input type="text" class="form-control1" name="data" placeholder="Type the Event Name, Area Lelang, Balai Lelang" />
                                  <button class="btn btn-primary" ><i class="fa fa-search "></i> Search</button>
                                  <a href="/OnlineEvent"><button class="btn btn-primary"><i class="fa fa-refresh "></i> Reset</button></a>
                    </form>
                  </div>
              </div>
          </div>
          <script>

          </script>
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

                                      <td>{{$dt['EventCode']}}</td>
                                      <td>{{$dt['CodeAreaLelang']}} <br> {{$dt['AreaLelang']}}</td>
                                      <td>{{$dt['CodeBalaiLelang']}} <br> {{$dt['BalaiLelang']}}</td>
                                      <td>{{$dt['EventName']}}</td>
                                      <td>{{$dt['StartDate']}} <br> to <br> {{$dt['EndDate']}}</td>
                                      <td>{{$dt['OpenHouseStartDate']}} <br> to <br> {{$dt['OpenHouseEndDate']}}</td>
                                      <td>{{$dt['AddDate']}}</td>
                                      @if ($dt['IsActive'] == 'Y' )

                                          <form action="{{url('/UpdateCondition')}}" method="get">
                                            <input style="display:none" name="id" value="{{$dt['Id']}}">
                                            <!-- <td><a href="{{url('/UpdateCondition/')}}"><img src="/images/123.png" width="30" height="30"></a> -->
                                            </td>
                                            <!-- <td><button class="btn" ><img src="/images/123.png" width="30" height="30"></button></td> -->
                                            <td><button class="btn"><img src="/images/123.png" width="30" height="30"></button></td>

                                          </form>

                                      @else
                                      <form action="{{url('/UpdateCondition')}}" method="get">
                                        <input style="display:none" name="id" value="{{$dt['Id']}}">

                                        <td><button class="btn"><img src="/images/1234.png" width="30" height="30"></button></td>
                                      </form>
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
                      {{$response->withPath('/OnlineEvent')->links()}}
                      <!-- <div id="app">
                        <button v-on:click="greet">Greet</button>
                        <h2>@{{ results }}</h2>
                      </div> -->
              </div>
            </div>
          </div>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.2/vue.js"></script>
            <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
          <script>
            new Vue({
              el: '#app',
              data: {
                results: []
              },
              methods:
              {
                 greet: function (event)
                 {
                   // `this` inside methods point to the Vue instance
                   alert('Hello ' + this.results + '!')
                 }
               }

              // mounted() {
              //   axios.get('https://desya.outsystemscloud.com/API_MasterGCM/rest/MasterGCMAPI/ShowMasterGCMCondition')
              //   .then(response => {this.results = response})
              // }
              http.request
              ({
                url: "https://desya.outsystemscloud.com/API_MasterGCM/rest/OnlineEventAPI/CreateOrUpdateOnlineEvent",
                method: "POST",
                headers: { "Content-Type": "application/json" },
                content: JSON.stringify
                ({
                  Id:"Id",
                  CodeAreaLelang:"CodeAreaLelang",
                  AreaLelang:"AreaLelang",
                  CodeBalaiLelang:"CodeBalaiLelang",
                  BalaiLelang:"BalaiLelang",
                  EventName:"EventName",
                  StartDate:"StartDate",
                  EndDate:"EndDate",
                  OpenHouseStartDate:"OpenHouseStartDate",
                  OpenHouseEndDate:"OpenHouseEndDate",
                  AddDate:"AddDate",
                  IsActive:"IsActive"
                })
              }).then(response =>
                {
                  var result = response.content.toJSON();
                },
                error =>
                {
                  console.error(error);
                });
            });
          </script>
</div>
@endsection
