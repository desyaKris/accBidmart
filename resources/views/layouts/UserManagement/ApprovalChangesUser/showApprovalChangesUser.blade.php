@extends('layouts.master')
@section('title','ACCBid - View Table')
@section('Dashboard','a')
@section('Master Management','a')
@section('User Management','Active-menu')
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
    <button class="tablinks" onclick="ApprovalChangesUser(event, 'UserCMSPending')" id="defaultOpen">User CMS Pending</button>
    <button class="tablinks" onclick="ApprovalChangesUser(event, 'UserCMSExpired')">User CMS Expired</button>
  </div>

  <div id="UserCMSPending" class="tabcontent">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info">
              <form action="{{ url('/searchApprovalChangesUserPending')}}"  method="get">
                <div class="form-group row">

                  <div class="col-sm-9">
                    <input type="text" class="form-control1" name="keyword" placeholder="Type the Name,Username,NIK, or NPWP" />
                  </div>

                  <div class="col-sm-3" align='left'>
                    <button class="btn btn-primary" ><i class="fa fa-search "></i> Search</button>
                    <a href="/showApprovalChangesUser"><button class="btn btn-primary"><i class="fa fa-refresh "></i> Reset</button></a>
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
                        <th>USERNAME</th>
                        <th>EMAIL</th>
                        <th>STATUS</th>
    										<th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                  @if($response != [])
                    <?php foreach ($response as $dt): ?>

                        <td>{{$dt['Name']}}</td>
                        <td>{{$dt['Username']}}</td>
                        <td>{{$dt['Email']}}</td>
                        <td>{{$dt['Status']}}</td>
                        <td>
                          <form action="{{url('/showByIdApprovalChangesUserPending')}}"  method="get">
                            <input style="display:none" name="id" id="id" value="{{$dt['Id']}}">
                            <button class="btn btn-primary"><i class="fa fa-edit "></i></button>
                          </form>
                        </td>
                        </tr>
                    <?php endforeach; ?>
                  @else
                    No User CMS Pending to show...
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
                {{$response->withPath('/showApprovalChangesUser')->links()}}
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>

  <div id="UserCMSExpired" class="tabcontent">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info">
              <form action="{{ url('/searchApprovalChangesUserExpired')}}"  method="get">
                <div class="form-group row">

                  <div class="col-sm-9">
                    <input type="text" class="form-control1" name="keyword" placeholder="Type the Name,Username,NIK, or NPWP" />
                  </div>

                  <div class="col-sm-3" align='left'>
                    <button class="btn btn-primary" ><i class="fa fa-search "></i> Search</button>
                    <a href="/showApprovalChangesUser"><button class="btn btn-primary"><i class="fa fa-refresh "></i> Reset</button></a>
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
                        <th>USERNAME</th>
                        <th>EMAIL</th>
                        <th>STATUS</th>
    										<th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                  @if($response2 != [])
                    <?php foreach ($response as $dt): ?>

                        <td>{{$dt['Name']}}</td>
                        <td>{{$dt['Username']}}</td>
                        <td>{{$dt['Email']}}</td>
                        <td>{{$dt['Status']}}</td>
                        <td>
                          <form action="{{url('/showByIdApprovalChangesUserExpired')}}"  method="get">
                            <input style="display:none" name="id" id="id" value="{{$dt['Id']}}">
                            <button class="btn btn-primary"><i class="fa fa-edit "></i></button>
                          </form>
                        </td>
                        </tr>
                    <?php endforeach; ?>
                  @else
                    No User CMS Expired to show...
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
                {{$response->withPath('/showApprovalChangesUser')->links()}}
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>

<script type="text/javascript">
function ApprovalChangesUser(evt, ApprovalChangesUserName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(ApprovalChangesUserName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
@endsection
