@extends('main')
@section('title', '| Edit Medication')
@section('content')
 
<div class="row">
    <h1 class="text-center">Edit Medication</h1><br>
  <div class="col-md-8 col-md-offset-2">
  
  <form method="post" action="{{ route('medications.update', $medication->id) }}">
    @method('PUT')
    @csrf
    <div class="form-group">
      <label>Name</label>
      <input type="text" name="name" class="form-control" dir="auto" value="{{$medication->name}}">
    </div>

    <div class="form-group">
      <label>Effective Material</label>
      <input type="text" name="effective_material" class="form-control" dir="auto" value="{{$medication->effective_material}}">
    </div>

    <div class="form-group">
        <label>Company Name</label>
        <input type="text" name="company_name" class="form-control" dir="auto" value="{{$medication->company_name}}">
      </div>

      <div class="form-group">
        <label>License Number</label>
        <input type="number" name="license_number" class="form-control" dir="auto" value="{{$medication->license_number}}">
      </div>

      <div class="form-group">
        <label>price</label>
        <input type="number" name="price" class="form-control" dir="auto" value="{{$medication->price}}">
      </div>

      <div class="form-group">
        <label>Order</label>
        <input type="number" name="order_id" class="form-control" dir="auto" value="{{$medication->order->id}}" disabled>
      </div>

  
    <div class="form-group">
      <label>Medication Status</label>
      <select class="form-control" name="medication_status_id">
          <option value="{{$medication->medicineStatus->id}}">{{$medication->medicineStatus->medication_status}}</option>
        @foreach($medicationStatus as $medic_status)
        <option value="{{$medic_status->id}}">{{$medic_status->medication_status}}</option>
        @endforeach
      </select>
    </div>
  

  
    <div class="form-group">
      <input type="submit" value="Edit Medication" class="form-control btn btn-success btn-block text">
    </div>
  
  </form>
  </div>
  </div>
@endsection