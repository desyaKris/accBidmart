@extends('layouts.master')
@section('title','MasterGCM')
@section('content')
<div id="page-inner">
          <div class="row">
              <div class="col-md-12" class="page-head-line">
    						<div class="floating-box">
    						<h1 class="page-head-line">Master GCM</h1>
    						</div>
    						<a href="/ShowCreateMasterGCM"><button class="btn btn-primary"><i class="fa fa-plus">  </i>Create Master GCM  </button></a>
  							<button class="btn btn-primary"><i class="fa fa-upload"> </i>  Upload Master GCM</button>
                <button class="btn btn-primary"><i class="fa fa-download"> </i>  Download Master GCM</button>

              </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                  <div class="alert alert-info">
                    <form action="{{ url('/MasterGCM') }}"  method="get">
                    <input type="text" class="form-control1" name="ValueDesc" placeholder="Type CharValue or CharDesc" />
                    <select name="Condition">
                      <option>--Chosee Condition--</option>
                      <?php foreach ($response2 as $dt2): ?>
                          <option>{{$dt2['Condition']}}</option>
                      <?php endforeach; ?>
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
                      <?php foreach ($response3 as $dt): ?>
                        <tr>
                          <td>{{$dt['CharValue1']}}</td>
                          <td>{{$dt['CharDesc1']}}</td>
                          <td>{{$dt['CharDesc2']}}</td>
                          <td>{{$dt['CharValue2']}}</td>
                          <td>{{$dt['CharDesc3']}}</td>
                          <td>{{$dt['CharValue3']}}</td>
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
                              <button  class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data?')"><i class="fa fa-trash"></i></button>
                            </form>
                          </td>

                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                </table>
              </div>
            </div>
          </div>
</div>
@endsection
