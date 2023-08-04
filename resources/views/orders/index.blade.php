@extends('main')
@section('title', '| Orders')
@section('content')

<div class="row">
    <div class="col-md-9 table_title">
        <h1>الاراضي السكنيه</h1>
    </div>

    <div class="col-md-1 fix_button">
        <a href="{{ route('orders.create') }}" class="btn btn-sm  btn-primary  form-spacing-top">اضافة أرض</a>  
    </div>
    
     {{-- <div class="col-md-12">
            <hr>
    </div> --}}

</div>
<br>
<div class="row">
         <div class="col-md-12">
             <!-- <select id="status" name="status" class="form-control order_status">
                {{-- <option>اسم القرية</option> --}} 

                     @foreach ($orders_status as $item)
                        <a href="/orders?status={{$item->id}}"><option value="{{$item->id}}">{{$item->order_status}} </option></a>
                    @endforeach 
                     -->

             </select> 
         </div>
         <div class="btn-group col-md-1 normal_add" >
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
         تحديد اسم القرية <span class="caret"></span>
        </button>
          <ul class="dropdown-menu" role="menu">
            @foreach ($orders_status as $item)
            <li><a href="/orders?status={{$item->id}}">{{$item->order_status}}</a></li> 
             @endforeach
             

        </ul>
         
      </div>
    

        <div class="col-md-12">
            <hr>
        </div>

     </div>

<div class="row">
    <div class="col-md-12 table-responsive" >
        <table class="table table-striped" id="data-table-orders">
            <thead>
            <th>#</th>
            <th> الاسم</th>
            <th> رقم التلفون</th>
            <th> صورة الارنيك </th>
            <th> رقم القطعه</th>
            <th>يوجد كوركي </th>
            <th> صورة الكوركي</th>
            <th>الحالة</th>
            <th> تاريخ الاضافة</th>
            <th>اسم الموظف</th>
            <th></th>
            <th></th>
            </thead>
            <tbody>
                
            {{--  We will use datatable to display data  --}}
              @foreach ($orders as $order)
                <tr>

                    <th>{{$order->id}}</th>
                    <td>{{$order->pation_name}}</td>                    
                    <td>{{$order->phone}}</td>
                    <td><img class="img-fluid"  style="max-width:20%;" src="/images/{{$order->prescription_photo}}" alt=""></td>
                    <td>{{$order->medicine_name}}</td>
                    <td>{{$order->insurance}}</td>
                    
                    <td><img class="img_responsive" style="max-width:20%;" src="/images/{{$order->insurance_card_photo}}" alt=""></td>
                    <td>{{$order->orderStatus->order_status}}</td>
                    <td>{{$order->created_at->diffForHumans()}}</td>
                    <td>{{$order->employees->name}}</td>

                    <td><a href="{{ route('orders.show',$order->id) }}" class="btn btn-success btn-sm">طباعة شهادة سكن</a> <a href="{{ route('orders.edit',$order->id) }}" class="btn btn-warning btn-sm">تعديل الملف</a></td>


                </tr>
            @endforeach  
            </tbody>
        </table>
        <div class="text-center">
            {{--  {{ $orders->links()}}  --}}
        </div>
    </div>
</div>
@endsection
