@extends('layouts/master')
@section('title','ACCBid - Auction Event')
@section('Dashboard','a')
@section('Master Management','a')
@section('User Management','a')
@section('Auction Event','active-menu')
@section('Auction Result','a')
@section('Bank Account','a')
@section('Deposit','a')
@section('View History','a')
@section('sectionhead')
 <h1 class="page-head-line">Auction Event</h1>
 <form class="" action="{{url('/buatAuction')}}" method="get">
     <button class="btn btn-primary" type="submit" href name="button"><i class="fa fa-edit ">Create New Auction</i> </button>
  </form>
@endsection

@section('content')
<div class="alert alert-info">
  <form class="" action="{{url('/api/searchAuction')}}" method="get">
    <label>Search</label>
    <input type="text" class="form-control1" name="search" placeholder="Type event name, lot no, No Kontrak, Unit, Area, or Balai Lelang"><br>
    <button type="submit" class="btn btn-primary" name="button">Search</button>
    <button type="button" name="button"></button>
  </form>
  <form class="" action="{{url('/viewAuction')}}" method="get">
      <button type="submit" href name="button">Reset </button>
   </form>
</div>

<div class="panel panel-default">
                    <div class="panel-heading">
                        Auction Event
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
  <thead>
    <tr>
      <th>EVENT NAME</th>
      <th>LOT NO</th>
      <th>NO KONTRAK</th>
      <th>NO POLISI</th>
      <th>MINIMUM PRICE</th>
      <th>AREA</th>
      <th>BALAI LELANG</th>
      <th>OPEN HOUSE DATE</th>
      <th>EVENT</th>
    </tr>
  </thead>
  <tbody>
      <?php foreach ($response as $array) : ?>
        <tr>
          <td>{{$array['MstOnlineEvent']['EventName']}}</td>

          <td>-</td>
          <td>{{$array['MstUnit']['NoKontrak']}}</td>
          <td><h4>{{$array['MstUnit']['NoPolisi']}}</h4>
            <h6>{{$array['MstUnit']['Brand']}} / {{$array['MstUnit']['Type']}} / {{$array['MstUnit']['Model']}} / {{$array['MstUnit']['Tahun']}}</h6>
          </td>
          <td>Rp {{$array['MstUnit']['MinimumPrice']}} </td>
          <td> {{$array['MstGCM']['CharDesc1']}} </td>
          <td><h4>{{$array['MstBalaiLelang']['Description']}}</h4> {{$array['MstBalaiLelang']['Email']}} </td>
          <td><?php echo date('d-M-Y H:i:s', strtotime($array['MstOnlineEvent']['OpenHouseStartDate'])) ?> <br> to <br> <?php echo date('d-M-Y H:i:s', strtotime($array['MstOnlineEvent']['OpenHouseEndDate'])) ?></td>
          <td><?php echo date('d-M-Y H:i:s', strtotime($array['MstOnlineEvent']['StartDate'])) ?> <br> to <br> <?php echo date('d-M-Y H:i:s', strtotime($array['MstOnlineEvent']['EndDate'])) ?></td>

          </tr>
      <?php endforeach; ?><br>
  </tbody>
</table>
{{$response->withPath('/viewBalaiLelang')->links()}}
  </div>
 </div>
</div>

@endsection
