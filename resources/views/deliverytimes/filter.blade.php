@extends('main')
@section('title', '| Delivery')
@section('content')

<div class="row">
  <div class="col-md-9 table_title">
    <h1>Delivery</h1>
</div>

<div class="col-md-12">
  <hr>
</div>
</div>
<div class="row">

    <div class="btn-group col-md-10 normal_add">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
          Filter By Time <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu">
            @foreach ($delivery_times as $delivery_time)
            <li><a href="/deliverytimes/filter?byDeliverytime={{$delivery_time->id}}">{{$delivery_time->delivery_time}}</a></li> 
             @endforeach
        </ul>
      </div>

      <div class="btn-group col-md-2 normal_add">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
            Filter By Status <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu">
            @foreach ($order_statuses as $order_status)
            <li><a href="/deliverytimes/filter?byOrderstatus={{$order_status->order_status}}">{{$order_status->order_status}}</a></li> 
             @endforeach
        </ul>
      </div>

      

    <div class="col-md-12">
        <hr>
    </div>
</div>
<div class="row">
    <div class="col-md-12 table-responsive" >
        <table class="table table-striped">
            <thead>
            <th>#</th>
            <th>Pation Name</th>
            <th>Pation Phone</th>
            <th>Prescription Photo</th>
            <th>Medicine Name</th>
            <th>Insurance</th>
            <th>Insurance Card</th>
            <th>Status</th>
            <th>Delivery Time</th>
            <th>Added Before</th>
            <th></th>
            </thead>
            <tbody>
             {{-- We will use datatable to display data  --}}
             @foreach ($orders as $order)
                <tr>
                    <th>{{$order->id}}</th>
                    <td>{{$order->pation_name}}</td>                    
                    <td>{{$order->phone}}</td>
                    <td><img src="/images/{{$order->prescription_photo}}" alt="" style="width: 50px;"></td>
                    <td>{{$order->medicine_name}}</td>
                    <td>{{$order->insurance}}</td>
                    <td><img src="/images/{{$order->insurance_card_photo}}" alt="" style="width: 50px;"></td>
                    
                    <td>
                        @if ($order->order_status_id)
                        {{$order->orderStatus->order_status}}
                        @endif
                    </td>
                
                    <td>
                        @if ($order->delivery_time_id)
                        {{$order->DeliveryTime->delivery_time}}
                        @endif
                    </td>
                      
                    <td>{{$order->created_at->diffForHumans()}}</td>

                    <td><a href="{{ route('orders.show',$order->id) }}" class="btn btn-success btn-sm">View</a> <a href="{{ route('orders.edit',$order->id) }}" class="btn btn-warning btn-sm">Edit</a></td>

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