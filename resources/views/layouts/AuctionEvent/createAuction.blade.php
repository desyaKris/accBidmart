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
@section('content')
<div class="panel panel-default">
  <div class="panel-heading">                      Create New Auction </div>
     <div class="panel-body">
        <!-- Forrm pertama digunakan untuk mencari UNIT dan AUCTION EVENT yang sesuai dengan -->
        <form class="" action="{{url('/dataUnitAuction')}}" method="get">
          <div class="form-group">
          <label>Area Lelang: </label>
          <select class="form-control" name="AreaLelang">
            <option disabled selected value> -- select an option -- </option>
            <?php foreach ($response2 as $arr): ?>
              <option value="{{$arr['CharDesc1']}}" id="areaLelang" required>{{$arr['CharDesc1']}}</option>
            <?php endforeach; ?>
          </select>
          </div>

          <div class="form-group">
          <label>BalaiLelang: </label>
            <select class="form-control" name="BalaiLelang">
            <option disabled selected value> -- select an option -- </option>
            <?php foreach ($response as $array): ?>
              <option value="{{$array['Description']}}" id="balaiLelang" required >{{$array['Description']}}</option>
            <?php endforeach; ?>
          </select>
          </div>
          <button type="Submit" name="button" class="btn btn-primary">Search available Unit and Auction Event</button>
        </form>


<form class="" action="{{url('/viewBalaiLelang')}}" method="get">
  <button class="btn btn-primary" type="submit" href name="button">cancel</button>
</form>
<!--  -->
<!-- <div class="panel panel-default">
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


  </tbody>
</table>

  </div>
 </div>
</div>
<!- -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
      var uri='https://kevinantariksa.outsystemscloud.com/API/rest/AuctionAPI/GetAllAuction'
      console.log('http call: ' + uri )
      $.ajax({
          url: uri,
          type: "GET",
          success: function (data) {

              $(data).each(function (index, item) {
                  // console.log(item);
                  console.log(data[index]['AuctionEvent']['Sent']);
                  console.log(item);
                  $('#data tbody').append(
                       '<tr><td>' + 'abvc'   +
                       '</td><td>' + 'def' +
                      '</td><td>' + item.Amount +
                      '</td><td>' + item.Status +
                      '</td></tr>'
                  )
             });
          }
      });
</script>

@endsection
