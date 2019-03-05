@extends('layouts.master')
@section('title','MasterGCM')
@section('Bank Account','a')
@section('Master Management','active-menu')
@section('content')
<div id="page-inner">
          <div class="row">
              <div class="col-md-12" class="page-head-line">
    						<div class="floating-box">
    						<h1 class="page-head-line">Master GCM</h1>
    						</div>

    						<a href="/ShowCreateMasterGCM"><button class="btn btn-primary"><i class="fa fa-plus">  </i>Create Master GCM  </button></a>
                <a href="{{url('/ShowUploadMasterGCM')}}"><button class="btn btn-primary"><i class="fa fa-upload"> </i> Upload Master GCM</button></a>

                <form action="{{url('/Excel')}}" method="post" enctype="multipart/form-data">
                  {!! csrf_field() !!}
                  <?php foreach ($response3 as $dt2): ?>
                    <?php if ($dt2 == null): ?>
                      <input type="text" style="display:none" name="Condition2" value=";qwe">
                      <?php else: ?>
                        <input type="text" style="display:none" name="Condition2" value="{{$dt2['Condition']}}">
                    <?php endif; ?>
                    @break
                  <?php endforeach; ?>
                  <button class="btn btn-primary"><i class="fa fa-download"> </i>  Download Master GCM</button>
                </form>
              </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                  <div class="alert alert-info">
                    <form action="{{url('/MasterGCM')}}"  method="get" id="search">
                    <input type="text" class="form-control1" name="ValueDesc" placeholder="Type CharValue or CharDesc" />

                    <select id="Condition" name="Condition" >
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

                    <button class="btn btn-primary" ><i class="fa fa-search "></i>Search</button>
                    <a href="/MasterGCM"><button class="btn btn-primary"><i class="fa fa-refresh "></i> Reset</button></a>
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
