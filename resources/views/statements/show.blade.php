
@extends('cpanel')
@section('title', __('strings.'))
@section('content')

<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="font-size: 30px"> {{__('strings.')}}                    
                        <a href="{{ url('admin-dashboard/events'.'/'.$event->id.'/edit') }}"> <i class="far fa-edit"></i> </a>
                    </div>
                    <div class="card-body">

                        <table  class='table table-striped'>
                        
                        
                            <tr>
                                <td style="font-weight:bold;">#</td>
                                <td>{{$event->id}}</td>
                            </tr>    

                            {{--  <tr>
                                <td style="font-weight:bold;">{{__('strings.')}}</td>
                                <td><b> من </b>{{$event->start_date}}<b> الي </b>{{$event->end_date}}</td>
                            </tr>   --}}

                            <tr>
                                <td style="font-weight:bold;">{{__('strings.')}}</td>
                                <td> <img src="{{ $event->image_full_path }}" alt="" width="300" height="300"></td>
                            </tr>

                            @if($event->description)
                                <tr>
                                    <td style="font-weight:bold;">{{__('strings.')}}</td>
                                    <td>{{$event->description}}</td>
                                </tr> 
                            @endif  
                        </table>
                    </div>
                    </div>
                    
                </div>
        </div>
    </div>
</div>
@endsection
