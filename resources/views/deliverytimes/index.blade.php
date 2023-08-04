@extends('main')
@section('title', '| Delivery Times')
@section('content')
<div class="row">
    <div class="col-md-9 table_title">
        <h1>Delivery Times</h1>
    </div>

      
  <form method="post" action="{{ route('deliverytimes.store') }}">
    @csrf
    <div class="form-group">
      <input type="text" name="delivery_time" class="form-control" dir="auto" placeholder="Add New Time" required>
    </div>

  
    <div class="form-group">
      <input type="submit" value="Add Delivery Time" class="form-control btn btn-success btn-block text">
    </div>
  
  </form>

    <div class="col-md-12">
        <hr>
    </div>
</div>
<div class="row">
    <div class="col-md-12 table-responsive">
        <table class="table table-striped">
            <thead>
            <th>#</th>
            <th>Delivery Time</th>
            <th>Added Before</th>
            <th></th>
            </thead>
            <tbody>
            @foreach ($delivery_times as $delivery_time)
                <tr>

                    <th>{{$delivery_time->id}}</th>
                    <td>{{$delivery_time->delivery_time}}</td>                    
                    <td>{{$delivery_time->created_at->diffForHumans()}}</td>

                    <td>
                        <span class="pull-right">
                            <form action="{{ route('deliverytimes.destroy', $delivery_time->id)}}" method="POST">
                          {{method_field('DELETE')}}
                           {{ csrf_field() }}
                          <input type="submit" class="btn btn-danger  btn-sm" value="Delete"/>
                       </form>
                      </span>

                        <a href="{{ route('deliverytimes.edit',$delivery_time->id) }}" class="btn btn-warning btn-sm">Edit</a></td>

                </tr>
            @endforeach

            </tbody>
        </table>

    </div>
</div>
@endsection