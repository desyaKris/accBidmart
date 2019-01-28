@extends('layouts.master')
@section('title','OnlineEvent')
@section('content')
<div id="page-inner">
                <div class="row">
                    <div class="col-md-12" class="page-head-line">
						<div class="floating-box">
						<h1 class="page-head-line">Online Event </h1>
						</div>
						<button class="btn btn-primary"><i class="fa fa-plus">  </i>  Create New Online Event</button>
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
            <div class=" col-md-3 col-sm-3">
                <div class="style-box-one Style-one-clr-one">
                            <a href="#">
                                <span class="glyphicon glyphicon-headphones"></span>
                                 <h5>Some Sample Text</h5>
                            </a>
                        </div>
                        </div>
              <div class=" col-md-3 col-sm-3">
                <div class="style-box-one Style-one-clr-two">
                            <a href="#">
                                <span class="glyphicon glyphicon-repeat"></span>
                                 <h5>Some Sample Text</h5>
                            </a>
                        </div>
                        </div>
             <div class=" col-md-3 col-sm-3">
                <div class="style-box-one Style-one-clr-three">
                            <a href="#">
                                <span class="glyphicon glyphicon-camera"></span>
                                 <h5>Some Sample Text</h5>
                            </a>
                        </div>
                        </div>
              <div class=" col-md-3 col-sm-3">
                <div class="style-box-one Style-one-clr-four">
                            <a href="#">
                                <span class="glyphicon glyphicon-cog"></span>
                                <h5>Some Sample Text</h5>
                            </a>
                        </div>
                        </div>
            </div>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            This is a free admin dashboard temple for personal and commercial use. Use this template for your projecs and save you money and time. Hope you will like it.
                        </div>
                    </div>
                </div>
                <div class="row">
            <div class=" col-md-4 col-sm-4">
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

                                </tbody>
                            </table>
                        </div>
                <div class="alert  alert-info">
                    <div class="current-notices">

                            <h3>Current Notices :</h3>
                    <hr />
                    <ul>
                        <li>
Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        </li>
                        <li>
Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        </li>
                        <li>
Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        </li>
                        <li>
Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        </li>
                    </ul>
                        </div>
                        </div>

                        </div>


              <div class=" col-md-8 col-sm-8">
                  <div class="list-group">
                            <a href="#" class="list-group-item active">
                                <h4 class="list-group-item-heading">List Group Heading</h4>
                                <p class="list-group-item-text" style="line-height: 30px;">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                </p>
                            </a>
                        </div>
                  <br />
                <h2> Bootstrap Media Objects</h2>
                    <br />

                    <div class="media">
      <a class="media-left" href="#">
          <img src="assets/img/1.jpg" alt="" class="img-rounded" />
      </a>
      <div class="media-body">
        <h4 class="media-heading">Media heading </h4>
          Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
      </div>
    </div>
    <div class="media">
      <a class="media-left" href="#">
          <img src="assets/img/2.jpg" alt="" class="img-rounded" />
      </a>
      <div class="media-body">
        <h4 class="media-heading">Media heading</h4>
       Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
        <div class="media">
          <a class="media-left" href="#">
              <img src="assets/img/1.jpg" alt="" class="img-rounded" />
          </a>
          <div class="media-body">
            <h4 class="media-heading">Nested media heading</h4>
           Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
          </div>
        </div>
      </div>
    </div>


            </div>
            </div>
            <!-- /. PAGE INNER  -->
        </div>

@endsection
