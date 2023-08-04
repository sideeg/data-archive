@extends('main')
@section('title', '| Create Order')
@section('content')
 
<div class="row">
    <h1 class="text-center"> أرض جديدة</h1><br>
  <div class="col-md-8 col-md-offset-2">
  
  <form method="post" action="{{ route('orders.store') }}" enctype="multipart/form-data">
    @csrf
    
    <div class="form-group">
      <label> اسم مالك القطعة</label>
      <input type="text" name="pation_name" class="form-control" dir="auto" placeholder="Pation Name" required>
    </div>

    <div class="form-group">
      <label> رقم هاتف المالك</label>
      <input type="number" name="phone" class="form-control" dir="auto" placeholder="Pation Phone" required>
    </div>

    <div class="form-group">
      <label> رقم هاتف احتياطي</label>
      <input type="number" name="another_phone" class="form-control" dir="auto" placeholder="Another Phone" required>
    </div>

    <div class="form-group">
      <label> وصف الموقع</label>
      <input type="text" name="location_description" class="form-control" dir="auto" placeholder="location description" required>
    </div>

    

    <div class="form-group">
      <label> صورة الاورنيك</label>
      <input type="file" name="prescription_photo" class="form-control" dir="auto" placeholder="Your Phone Number">
    </div>
    <div class="form-group input_fields_wrap">
        <label> معلومات الجار</label>
        <input type="text" name="medicine_names[]" class="form-control" dir="auto" placeholder=" اسم الجار " required>
        <input type="text" name="materials[]" class="form-control" dir="auto" placeholder=" الجهة التي يحدها الجار" required>
        <input type="text" name="companies[]" class="form-control" dir="auto" placeholder="اي معلومات اضافيه عن الجار يمكن ان تفيد" required>

      </div>
    <div class="form-group">
       <button class="form-control btn btn-warning  btn-block add_field_button">اضافة جار جديد</button>
    </div>
   
      <div class="form-group">
        <label>الكوركي</label>
        <select class="form-control insurance_status" name="insurance" >
            <option value="0"> لايوجد كوركي</option>
            <option value="1">يوجد كوركي</option>
        </select>
      </div>

      <div class="form-group insurance_input" style="display:none;">
          <label> صورة الكوركي</label>
          <input type="file" name="insurance_card_photo" class="form-control" dir="auto" >
      </div>

      <div class="form-group">
        <label> اسم القرية</label>
        <select class="form-control" name="order_status_id" required>
            @foreach ($orders_status as $status)
              <option value="{{$status->id}}">{{$status->order_status}}</option>
            @endforeach
        </select>
      </div>

  
    <div class="form-group">
      <input type="submit" value="Add Order" class="form-control btn btn-success btn-block text">
    </div>
  
  </form>
  </div>
  </div>
@endsection