@extends('main')
@section('title', '| Create Employee')
@section('content')
 
<div class="row">
    <h1 class="text-center">New Employee</h1><br>
  <div class="col-md-8 col-md-offset-2">
  
  <form method="post" action="{{ route('employees.store') }}">
    @csrf
    <div class="form-group">
      <label>Name</label>
      <input type="text" name="name" class="form-control" dir="auto" placeholder="Your Name" required>
    </div>

    <div class="form-group">
      <label>Email</label>
      <input type="email" name="email" class="form-control" dir="auto" placeholder="Your email" required>
    </div>

    <div class="form-group">
      <label>Password</label>
      <input type="password" name="password" class="form-control" dir="auto" placeholder="Your Password" required>
    </div>

    <div class="form-group">
      <label for="password-confirm">{{ __('Confirm Password') }}</label>
      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
  </div>

    <div class="form-group">
      <label>Phone</label>
      <input type="number" name="phone" class="form-control" dir="auto" placeholder="Your Phone Number" required>
    </div>

    <div class="form-group form-spacing-top">
      <label>ID</label>
      <input type="number" name="identification_number" class="form-control" dir="auto" placeholder="Your Identification Number" required>
    </div>
   
  
    <div class="form-group">
      <label>Job</label>
      <select class="form-control" name="job_id">
          <option>Select Job</option>
        @foreach($jobs as $job)
        <option value="{{$job->id}}">{{$job->name}}</option>
        @endforeach
      </select>
    </div>
  

  
    <div class="form-group">
      <input type="submit" value="Add Employee" class="form-control btn btn-success btn-block text">
    </div>
  
  </form>
  </div>
  </div>
@endsection