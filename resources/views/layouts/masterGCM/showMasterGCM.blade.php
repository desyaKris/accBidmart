@extends('layouts.master')
@section('title','ACCBid - Master GCM')
@section('Dashboard','a')
@section('Master Management','active-menu')
@section('User Management','a')
@section('Auction Event','a')
@section('Auction Result','a')
@section('Bank Account','a')
@section('Deposit','a')
@section('ContentManagement','a')
@section('View History','a')
@section('content')
<div id="page-inner">
  <div class="row">
    <div class="col-md-12 page-head-line" style="display: flex; align-items:center">
      <div class="col-md-4">
        <h1 class="">Master GCM</h1>
      </div>
      <div class="col-md-8" align="right">
        <a href="/ShowCreateMasterGCM" class="btn btn-primary"><i class="fa fa-plus"></i> Create Master GCM</a>
        <a href="{{url('/ShowUploadMasterGCM')}}" class="btn btn-primary"><i class="fa fa-upload"></i> Upload Master GCM</a>
        <form action="{{url('/Excel')}}" method="post" style="display:inline-block" enctype="multipart/form-data">
          {!! csrf_field() !!}
          <?php foreach ($response3 as $dt2): ?>
            <?php if ($dt2 == null): ?>
              <?php else: ?>
                <input type="text" style="display:none" name="formName" value="MasterManagementMasterGCM">
                <input type="text" style="display:none" name="Condition2" value="{{$dt2['Condition']}}">
            <?php endif; ?>
            @break
          <?php endforeach; ?>
          <button class="btn btn-primary"><i class="fa fa-download"> </i>  Download Master GCM</button>
        </form>
      </div>
    </div>
  </div>
  <div class="row">
      <div class="col-md-12">
        <!-- alert -->
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
          <div class="alert alert-info">
            <form action="{{url('/MasterGCM')}}"  method="get" id="search">
              <div class="form-group row">
                <div class="col-sm-4">
                  <select id="Condition" class="form-control" name="Condition" >
                    @if(empty($response4))
                    <option>--Chosee Condition--</option>
                    <?php foreach ($response2 as $dt2): ?>
                        <option value = "{{$dt2['Condition']}}">{{$dt2['Condition']}}</option>
                    <?php endforeach; ?>
                    @else
                    <?php foreach ($response4 as $dt4): ?>
                      <option>{{$dt4}}</option>
                      <?php foreach ($response2 as $dt2): ?>
                          <option value = "{{$dt2['Condition']}}">{{$dt2['Condition']}}</option>
                      <?php endforeach; ?>
                    <?php endforeach; ?>
                    @endif
                  </select>
                </div>
                <div class="col-sm-4">
                  <input type="text" class="form-control1" name="keyword" placeholder="Type CharValue or CharDesc" />
                </div>
                <?php foreach ($response3 as $Condition): ?>
                  <?php if ($Condition == null): ?>
                    <?php else: ?>
                      <input type="text" style="display:none" name="Condition2" value="{{$Condition['Condition']}}">
                  <?php endif; ?>
                  <?php endforeach; ?>
                <div class="col-sm-3">
                  <button class="btn btn-primary" ><i class="fa fa-search "></i>Search</button>
                  <a href="/MasterGCM"><button class="btn btn-primary"><i class="fa fa-refresh "></i> Reset</button></a>
                </div>
              </div>
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
                    <th>VALUE 1</th>
                    <th>DESC 1</th>
                    <th>VALUE 2</th>
                    <th>DESC 2</th>
                    <th>VALUE 3</th>
                    <th>DESC 3</th>
                    <th>IS ACTIVE</th>
                    <th>ACTION</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($response3 as $key => $dt): ?>
                <tr>
                  <td>{{$dt['CharValue1']}}</td>
                  <td>{{$dt['CharDesc1']}}</td>
                  @if(empty($dt['CharValue2']))
                  <td></td>
                  @else
                  <td>{{$dt['CharValue2']}}</td>
                  @endif

                  @if(empty($dt['CharDesc2']))
                  <td></td>
                  @else
                  <td>{{$dt['CharDesc2']}}</td>
                  @endif

                  @if(empty($dt['CharValue3']))
                  <td></td>
                  @else
                  <td>{{$dt['CharValue3']}}</td>
                  @endif

                  @if(empty($dt['CharDesc3']))
                  <td></td>
                  @else
                  <td>{{$dt['CharDesc3']}}</td>
                  @endif


                  <td>{{$dt['IsActive']}}</td>
                  <td>
                    <form action="{{url('/ShowDataMasterGCM')}}" method="get">
                      <input style="display:none" name="id" value="{{$dt['Id']}}">

                      <!-- untuk membuat kondisi tampilan show atau edit -->
                      <input style="display:none" name="temp" value="Y">

                      <button  class="btn btn-info"><i class="fa fa-eye"></i></button>
                    </form>
                  </td>
                  <td>
                    <form action="{{url('/ShowEditMasterGCM')}}" method="get">
                      <input style="display:none" name="id" value="{{$dt['Id']}}">
                      <button class="btn btn-primary"><i class="fa fa-edit"></i></button>
                    </form>
                  </td>
                  <td>
                    <form action="{{url('/DeleteMasterGCM')}}" method="get">
                      <input style="display:none" name="id" value="{{$dt['Id']}}">
                      <input style="display:none" name="Condition" value="{{$dt['Condition']}}">
                      @if(empty($dt['Image1']))

                      @else
                        <input type="text" style="display:none" name="dataImage" value="{{$dt['Image1']}}">
                      @endif
                      <button  class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data?')"><i class="fa fa-trash"></i></button>
                    </form>
                  </td>

                </tr>
              <?php endforeach; ?>
            </tbody>
        </table>
        <div class="form-row">
          <div class="form-group col-md-6">
            @if($response3->total() < 10)
              <label>
                {{$response3->total()}} records
              </label>
            @else
              <label>
                {{$response3->firstItem()}} to
                {{$response3->lastItem()}} of
                {{$response3->total()}} records
              </label>
            @endif
          </div>
          <div class="form-group col-md-6" align="right">
            {{$response3->withPath('/MasterGCM')->links()}}
          </div>
        </div>
      </div>
    </div>
  </div>
<script>
 $('#Condition').on('change', function(){
     var value = $(this).val();
      var base_url = '{{ url("/") }}';

     if(value != ''){
         $.ajax({
             type: "GET",
             url: base_url + '/Search/'+value,
             success: function(data){

                     console.log(value);
                       document.getElementById("search").submit();
             }
         });
     } $('Condition').val(value).change();
 });
</script>
</div>
@endsection
