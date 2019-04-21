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
  <div class="panel-heading">   Create New Auction </div>
     <div class="panel-body">
        <!-- Forrm pertama digunakan untuk mencari UNIT dan AUCTION EVENT yang sesuai dengan -->
        <?php foreach ($response4 as $array): ?>
        <form class="" action="{{url('/api/createAuction')}}" method="post" enctype="multipart/form-data">
          <div class="form-group">
          <label>Area Lelang: </label>
          <input type="text" name="" value="{{$array['MstGCM']['CharDesc1']}}" readonly>
          </div>

          <div class="form-group">
          <label>BalaiLelang: </label>
            <input type="text" name="" value="{{$array['MstBalaiLelang']['Description']}}" readonly>
          </div>
        <?php endforeach; ?>

         <!-- Form untuk Unit yang availabel -->
         <div class="panel panel-default">
                        <div class="panel-heading">
                            Available unit
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>Lot No</th>
                                            <th>No Kontrak </th>
                                            <th>No Polisi</th>
                                            <th>Minimum Price</th>
                                            <th>Pool</th>
                                            <th>Area Lelang</th>
                                            <th>Balai Lelang</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php foreach ($response4 as $arr): ?>
                                        <tr>

                                            <td><input type="checkbox" onclick='handleClick(this);' name="Unit" id="UnitId" value="{{$arr['MstUnit']['Id']}}"></td>
                                            <td> - </td>
                                            <td>{{$arr['MstUnit']['NoKontrak']}}</td>
                                            <td>{{$arr['MstUnit']['NoPolisi']}} / {{$arr['MstUnit']['Brand']}} / {{$arr['MstUnit']['Type']}} / {{$arr['MstUnit']['Model']}} / {{$arr['MstUnit']['Tahun']}} </td>
                                            <td>{{$arr['MstUnit']['MinimumPrice']}}</td>
                                            <td>{{$arr['MstUnit']['Pool']}}</td>
                                            <td>{{$arr['MstGCM']['CharDesc1']}}</td>
                                            <td>{{$arr['MstBalaiLelang']['Description']}}</td>
                                        </tr>
                                      <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

        <div class="form-group">
        <label>AuctionEvent: </label>
          <select class="form-control" name="EventLelang" id="EventLelang">
          <option disabled selected value> -- select an option -- </option>
          <?php foreach ($response3 as $array): ?>
            <option value="{{$array['EventName']}}" id="EventLelang" required>{{$array['EventName']}}</option>
          <?php endforeach; ?>

        </select>
        </div>


         <div class="form-group">
           <label>Open House Date: </label>
           <input type="text" id="StartOpenHouse" name="StartOpenHouse" class="form-control" placeholder="Start Date" readonly><br>
           <input type="text" id="EndOpenHouse" name="EndOpenHouse" class="form-control" placeholder="End Date" readonly ><br>
         </div>

         <div class="form-group">
           <label>Event Date: </label>
           <input type="text" id="StartEventDate" name="StartEventDate" class="form-control" placeholder="Start Date" readonly><br>
           <input type="text" id="EndEventDate" name="EndEventDate" class="form-control" placeholder="End Date" readonly><br>
         </div>

         <!-- Data data yang dibutuhkan dalam pembuatan auction  -->
        <input type="text" id="UnitId" name="UnitId" >
        <input type="hidden" name="EventId" id="EventId" value="">
        <input type="text" id="UserAdded" value="186">
       <button class="btn btn-primary" type="submit" class="btn btn-default">Simpan</button>


</form>
<form class="" action="{{url('/viewBalaiLelang')}}" method="get">
  <button class="btn btn-primary" type="submit" href name="button">cancel</button>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
function handleClick(cb) {

if (cb.checked == true) {
  console.log("Clicked, new value = " + cb.checked);

  var values = $("input[name=Unit]:checked").map(
    function () {return this.value;}).get().join(",");
  // var values = $('#UnitId').val()
  console.log(values);

}

}
</script>
<script>
var base_url ='https://acc-dev1.outsystemsenterprise.com/BidMart/rest/Laravel_AuctionEvent/GetDataAuction?Desc='
$('#EventLelang').on('change', function(e){

     var value = $(this).find("option:selected").val();
     var urel = base_url+value;
     console.log(urel);
         $.ajax({
             type: "GET",
             url: base_url+value,
             success: function(data){
                var startOH = data['OpenHouseStartDate'].substring(0,10)
                var endOH = data['OpenHouseEndDate'].substring(0,10)
                var startED = data['StartDate'].substring(0,10)
                var endED = data['EndDate'].substring(0,10)
                var eventId = data['Id']

                $('#StartOpenHouse').val(startOH).change()
                $('#EndOpenHouse').val(endOH).change()
                $('#StartEventDate').val(startED).change()
                $('#EndEventDate').val(endED).change()
                $('#EventId').val(eventId).change()
             }
         });
     console.log(value);
 });

 </script>

@endsection
