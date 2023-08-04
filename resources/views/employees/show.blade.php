@extends('main')
@section('title', '| Employee Profile')
@section('content')
 
<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">{{$employee->name}} Profile</h3>
        </div>
        <div class="panel-body">
          <div class="row">

            <div class=" col-md-9 col-lg-12 ">
              <table class="table table-user-information">
                <tbody class="text-dir">

                  <tr>
                    <td>Name</td>
                    <td>{{$employee->name}}</td>
                  </tr>

                  <tr>
                    <td>Phone</td>
                    <td>{{$employee->phone}}</td>
                  </tr>

                  <tr>
                    <td>ID</td>
                    <td>{{$employee->identification_number}}</td>
                  </tr>

                  <tr>
                    <td>Job</td>
                    <td>{{$employee->job->name}}</td>
                  </tr>

                </tbody>
              </table>

             <a href="{{Route('employees.index')}}" class="btn btn-default">All Employees</a>

            </div>
          </div>
        </div>
                <div class="panel-footer">
                    <a href="{{route('employees.edit', $employee->id)}}" type="button" class="btn btn-warning"><span>Edit</span></a>
                    <span class="pull-right">
                      <form action="{{ route('employees.destroy', $employee->id)}}" method="POST">
                         {{method_field('DELETE')}}
                          {{ csrf_field() }}
                         <input type="submit" class="btn btn-danger" value="Delete Employee"/>
                      </form>

                    </span>
                </div>
      </div>
    </div>
  </div>

@endsection