@extends('cpanel')
@section('title', __('strings.edit_label'))
@section('content')

        {!! Form::open(['url' => 'admin-dashboard/resources/'.$resource->id,'files' => true]) !!}
        <input type="hidden" name="_method" value="PUT">
        <div class="card">
            <form class="form-horizontal">
                <div class="card-body">
                    <h4 class="card-title">{{__('strings.edit_label')}}</h4>
                    
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" value="{{$resource->title}}" name="title" placeholder="{{__('strings.title')}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" value="{{$resource->title_en}}" name="title_en" placeholder="{{__('strings.title_en')}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="form-group input-group">
                            <img src="{{ $resource->image_full_path }}" alt="resource Img" width="300" height="300" >
                            {!! Form::file('image'); !!}
                       </div>
                    </div>

                    <div class="form-group row">
                        <div class="form-group input-group">
                            {!! Form::date('start_date', $resource->start_date , ['class' => 'form-control']) !!}   
                        </div>
                    </div>
                   
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <textarea class="form-control"  name="description" placeholder="{{__('strings.description')}}" > {{$resource->description}} </textarea>
                        </div>
                    </div>

                    
                    <div class="border-top">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary btn-block">{{__('strings.add_btn')}}</buuton>
                    </div>
                </div>
            </form>
        </div> 
        {!! Form::close() !!}
 
@endsection
