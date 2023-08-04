@extends('main')
@section('title', '| Employees')
@section('content')
<div class="row">
    <div class="col-md-9 table_title">
        <h1>Employees</h1>
    </div>

    <div class="col-md-1 fix_button">
        <a href="{{ route('employees.create') }}" class="btn btn-sm  btn-primary  form-spacing-top">Add Employee</a>  
    </div>
     

    <div class="col-md-12">
        <hr>
    </div>
</div>
<div class="row">
    <div class="col-md-12 table-responsive">
        <table class="table table-striped">
            <thead>
            <th>#</th>
            <th>Name</th>
            <th>email</th>
            <th>Phone</th>
            <th>ID</th>
            <th>Job</th>
            <th>Added Before</th>
            <th></th>
            </thead>
            <tbody>
            @foreach ($employees as $employee)
                <tr>

                    <th>{{$employee->id}}</th>
                    <td>{{$employee->name}}</td>                    
                    <td>{{$employee->email}}</td>
                    <td>{{$employee->phone}}</td>
                    <td>{{$employee->identification_number}}</td>
                    <td>
                        @if ($employee->job_id)
                            {{$employee->job->name}}
                        @endif
                    </td>
                    <td>{{$employee->created_at->diffForHumans()}}</td>

                    <td><a href="{{ route('employees.show',$employee->id) }}" class="btn btn-success btn-sm">View</a> <a href="{{ route('employees.edit',$employee->id) }}" class="btn btn-warning btn-sm">Edit</a></td>


                </tr>
            @endforeach

            </tbody>
        </table>
        <div class="text-center">
            {{ $employees->links()}}
        </div>
    </div>
</div>
@endsection