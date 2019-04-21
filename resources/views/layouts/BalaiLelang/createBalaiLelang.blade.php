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
<div id="page-inner">

  <?php
  date_default_timezone_set('Asia/Bangkok');
  $script_tz = date_default_timezone_get();
  ?>
    <div class="row">
        <div class="col-md-12" class="page-head-line">
            <h1 class="page-head-line">Create Balai Lelang</h1>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
          <div class="alert alert-info">
            <form class="" action="{{url('/api/createBalaiLelang')}}" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label>Balai Code: </label>
                <input type="text" class="form-control" name="BALAI_CODE" maxlength="6" placeholder="Kode dari balai lelang" required><br>
              </div>
             <div class="form-group">
               <label>Description: </label>
               <input type="text-area" class="form-control" name="DESCRIPTION" placeholder="Deskripsi dari balai lelang" required><br>
             </div>

             <div class="form-group">
               <label>Contact Name: </label>
               <input type="text" name="NAME" class="form-control" placeholder="Nama" ><br>
             </div>

             <div class="form-group">
               <label>Address: </label>
               <input type="text" name="ADDRESS" class="form-control" placeholder="Alamat dari balai lelang" ><br>
             </div>

             <div class="form-group">
               <label>Mail Number: </label>
               <input type="number" name="MailNo" class="form-control" placeholder="Nomor Mail" ><br>
             </div>

             <div class="form-group">
               <label>E-MAIL: </label>
               <input type="email" name="EMAIL" class="form-control" placeholder="E-mail balai lelang" ><br>
             </div>

             <div class="form-group">
               <label>Phone Number: </label>
               <input type="tel" name="PHONE_NUM" class="form-control" maxlength="12" placeholder="Nomor telepon balai lelang" ><br>
             </div>

             <div class="form-group">
               <label>Faximile Number: </label>
               <input type="tel" name="FaxNo" class="form-control" placeholder="Nomor Faximile"><br>
             </div>

             <label>Is Active?</label>
             <div class="radio">
              <label>
                <input type="radio" name="IS_ACTIVE" id="optionsRadios1" value="true" checked />
                Yes
              </label>
             </div>
             <div class="radio">
              <label>
                <input type="radio" name="IS_ACTIVE" id="optionsRadios2" value="false" />
                No
              </label>
             </div>

           <!-- <div class="form-group">
             <label>Picture: </label>
             <input type="text" name="Pict" class="form-group" placeholder="Upload IMG" ><br>
          </div> -->
          <!-- INPUT -->
          <div class="form-group">
            <label for="exampleInputFile">Choose image from directory</label>
            <input type="file" id="exampleInputFile" name="Pict" />
          </div>
           <button class="btn btn-primary" type="submit" class="btn btn-default">Simpan</button>



  </form>
  <form class="" action="{{url('/viewBalaiLelang')}}" method="get">
      <button class="btn btn-primary" type="submit" href name="button">cancel</button>
   </form>
          </div>
      </div>
</div>
</div>

@endsection
