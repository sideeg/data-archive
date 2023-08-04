@extends('main')
@section('title', '| Medications')
@section('content')
<div class="row">
    <div class="col-md-9 table_title">
        <h1>Medications</h1>
    </div>
    
    <div class="btn-group col-md-1 normal_add" >
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
          Filter By <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu">
            @foreach ($medicationStatus as $medicationStatu)
            <li><a href="/medications?by={{$medicationStatu->medication_status}}">{{$medicationStatu->medication_status}}</a></li> 
             @endforeach
        </ul>
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
            <th>effective_material</th>
            <th>company name</th>
            <th>license number</th>
            <th>price</th>
            <th>order</th>
            <th>medicineStatus</th>
            <th>Added Before</th>
            <th></th>
            </thead>
            <tbody>
            @foreach ($medications as $medication)
                <tr>

                    <th>{{$medication->id}}</th>
                    <td>{{$medication->name}}</td>                    
                    <td>{{$medication->effective_material}}</td>
                    <td>{{$medication->company_name}}</td>
                    <td>{{$medication->license_number}}</td>
                    <td>{{$medication->price}}</td>
                    <td>{{$medication->order->id}}</td>
                    <td>
                       @if ($medication->medication_status_id)
                           {{($medication->medicineStatus->medication_status)}}
                       @endif

                    </td>
                    <td>{{$medication->created_at->diffForHumans()}}</td>

                    <td>
                        <a href="{{ route('medications.edit',$medication->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <span class="pull-right">
                              <form action="{{ route('medications.destroy', $medication->id)}}" method="POST">
                            {{method_field('DELETE')}}
                             {{ csrf_field() }}
                            <input type="submit" class="btn btn-danger  btn-sm" value="Delete"/>
                         </form>
                        </span>
                      
                    </td>


                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>
<script src="https://js.pusher.com/4.2/pusher.min.js"></script>
<!-- Alert whenever a new notification is pusher to our Pusher Channel -->

<script>
//Remember to replace key and cluster with your credentials.
var pusher = new Pusher('34cf47ca040d847b0d9c', {
  cluster: 'us2',
  encrypted: true
});

//Also remember to change channel and event name if your's are different.
var channel = pusher.subscribe('afia-orders');
channel.bind('afia-event', function(message) {
    console.log(message);
});

</script>
@endsection


