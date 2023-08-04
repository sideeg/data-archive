@extends('main')
@section('title', '| Edit Delivery')
@section('content')
 
<div class="row">
    <h1 class="text-center">Edit Time</h1><br>
  <div class="col-md-8 col-md-offset-2">
  
       
    <form  action="{{ route('deliverytimes.update', $deliverytime->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
        <input type="text" name="delivery_time" class="form-control" dir="auto" value="{{$deliverytime->delivery_time}}" required>
        </div>
    
      
        <div class="form-group">
          <input type="submit" value="Edit Delivery Time" class="form-control btn btn-success btn-block text">
        </div>
      
      </form>
  </div>
  </div>
@endsection