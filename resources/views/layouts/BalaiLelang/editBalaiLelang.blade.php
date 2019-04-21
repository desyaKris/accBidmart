@extends('layouts.master')
@section('title','ACCBid - Balai Lelang')
@section('Dashboard','a')
@section('Master Management','active-menu')
@section('User Management','a')
@section('Auction Event','a')
@section('Auction Result','a')
@section('Bank Account','a')
@section('Deposit','a')
@section('View History','a')
@section('content')

<div class="panel panel-default">
  <div class="panel-heading">Edit Balai Lelang</div>
     <div class="panel-body">
       <form class="" action="{{url('/api/updateBalaiLelang')}}" method="post" enctype="multipart/form-data">
         <input type="hidden" name="Id" value="{{$response['Id']}}" required>
        <div class="form-group">
        <label>Balai Code: </label>
        <input type="text" name="BALAI_CODE" class="form-control" maxlength="6" value="{{$response['Code']}}" required><br>
        </div>

        <div class="form-group">
        <label>Description: </label>
        <input type="text-area" name="DESCRIPTION" class="form-control" value="{{$response['Description']}}" required><br>
        </div>

        <div class="form-group">
        <label>Address: </label>
        <input type="text" name="ADDRESS" class="form-control" value="{{$response['Address']}}" ><br>
        </div>

        <div class="form-group">
        <label>Mail Number: </label>
        <input type="number" name="MailNo" class="form-control" value="{{$response['MailNo']}}" ><br>
        </div>

        <div class="form-group">
        <label>E-MAIL: </label>
        <input type="email" name="EMAIL" class="form-control" value="{{$response['Email']}}" ><br>
        </div>

        <div class="form-group">
        <label>Nomor Telepom: </label>
        <input type="tel" name="PHONE_NUM" class="form-control" maxlength="12" value="{{$response['PhoneNumber']}}" ><br>
        </div>

        <div class="form-group">
        <label>Faximile Number: </label>
        <input type="tel" name="FaxNo" class="form-control" value="{{$response['FaxNo']}}"><br>
        </div>

        <div class="form-group">
        <label>Nama: </label>
        <input type="text" name="NAME" class="form-control" value="{{$response['ContactName']}}" ><br>
        </div>

        <label>Is Active?</label>

          @if(empty($response['IsActive']))
          <div class="radio">
                  <label><input type="radio" name="IS_ACTIVE" id="optionsRadios1" value="true"  />Y</label><br>
                  <label> <input type="radio" name="IS_ACTIVE" id="optionsRadios2" value="false" checked />N </label>
          </div>
          @else
          <div class="radio">
              <label><input type="radio" name="IS_ACTIVE" id="optionsRadios1" value="true" checked />Y</label><br>
                <label> <input type="radio" name="IS_ACTIVE" id="optionsRadios2" value="false"  />N </label>
          </div>
          @endif
      <br>


        <div class="form-group">
        <!-- <label>Picture: </label>
        <img src="/images/{{$response['PICTURE']}}" alt=""> -->

        <input type="number"  name="Pict"  value="{{$response['PicturesId']}}"  /><br>
        </div>



        <button class="btn btn-primary" type="submit" name="btn-submit">Simpan</button>

    </form>
    <form class="" action="{{url('/viewBalaiLelang')}}" method="get">
        <button class="btn btn-primary" type="submit" href name="button">Cancel </button>
     </form>
@endsection
