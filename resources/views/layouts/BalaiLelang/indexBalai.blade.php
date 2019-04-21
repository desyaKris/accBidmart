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

<div class="alert alert-info">
  <form class="" action="{{url('/api/searchBalaiLelang')}}" method="get">
    <label>Search</label>
    <input type="text" class="form-control1" name="search" placeholder="Type balai code or description"><br>
    <button type="submit" class="btn btn-primary" name="button">Search</button>
    <button type="button" name="button"></button>
  </form>
  <form class="" action="{{url('/viewBalaiLelang')}}" method="get">
      <button type="submit" href name="button">Reset </button>
   </form>
</div>

    <div class="panel panel-default">
                        <div class="panel-heading">
                            Balai Lelang
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
      <thead>
        <tr>
          <th>Balai code</th>
          <th>Description</th>
          <th>Address</th>
          <th>E-mail</th>
          <th>Contact </th>
          <th>Is Active</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
          <?php foreach ($response as $array) : ?>
            <tr>
              <td>{{$array['Code']}}</td>
              <td>{{$array['Description']}}</td>
              @if(empty($array['Address']))
                <td>-</td>
              @else
                <td>{{$array['Address']}}</td>
              @endif

              @if(empty($array['Email']))
              <td>-</td>
              @else
              <td>{{$array['Email']}}</td>
              @endif

              @if(empty($array['ContactName']) && empty($array['PhoneNumber']))
              <td>- / -</td>
              @elseif(empty($array['ContactName']))
                <td>- / {{$array['PhoneNumber']}} </td>
              @elseif(empty($array['PhoneNumber']))
                <td>{{$array['ContactName']}} / - </td>
              @else
                <td>{{$array['ContactName']}} / {{$array['PhoneNumber']}} </td>
              @endif

              @if(empty($array['IsActive']))
                <td>N</td>
              @else
                <td>Y</td>
              @endif


              <td> <a href="{{url("api/deleteBalaiLelang/$array[Id]")}}" onclick="return confirm('Yakin ingin menghapus?');">Delete</a> -  <a href="{{url("updateBalaiLelang/$array[Id]")}}">Edit</a></td>
              </tr>
          <?php endforeach; ?><br>
      </tbody>
    </table>
    {{$response->withPath('/viewBalaiLelang')->links()}}
  </div>
 </div>
</div>

@endsection
