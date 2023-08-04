@extends('main')
@section('title', '| Edit Employee')
@section('content')
 
<div class="row">
    <h1 class="text-center">Edit {{$employee->name}}</h1><br>
  <div class="col-md-8 col-md-offset-2">
  
  <form method="post" action="{{ route('employees.update', $employee->id) }}">
    @method('PUT')
    @csrf
    <div class="form-group">
      <label>Name</label>
      <input type="text" name="name" class="form-control" dir="auto" value="{{$employee->name}}" required>
    </div>

    <div class="form-group">
      <label>Email</label>
      <input type="email" name="email" class="form-control" dir="auto" value="{{$employee->email}}" required>
    </div>

    <div class="form-group">
      <label>Password</label>
      <input type="password" name="password" class="form-control" dir="auto" placeholder="Your New Password" required>
    </div>

    <div class="form-group">
      <label>Confirme Password</label>
      <input type="password" name="password_confirmation" class="form-control" dir="auto" placeholder="confirme your password" required>
    </div>

    <div class="form-group">
      <label>Phone</label>
      <input type="number" name="phone" class="form-control" dir="auto" value="{{$employee->phone}}" required>
    </div>

    <div class="form-group">
      <label>ID</label>
      <input type="number" name="identification_number" class="form-control" dir="auto" value="{{$employee->identification_number}}" required>
    </div>
   
  
    <div class="form-group">
      <label>Job</label>
      <select class="form-control" name="job_id">
          <option value="{{$employee->job->id}}">{{$employee->job->name}}</option>
        @foreach($jobs as $job)
        <option value="{{$job->id}}">{{$job->name}}</option>
        @endforeach
      </select>
    </div>
  

  
    <div class="form-group">
      <input type="submit" value="Edit Employee" class="form-control btn btn-success btn-block text">
    </div>
  
  </form>
  </div>
  </div>
@endsection