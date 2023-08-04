@extends('cpanel')
@section('title', __('strings.add_title'))
@section('content')

        {!! Form::open(['url' => 'admin-dashboard/statements','files' => true]) !!}
            <div class="card">
                <form class="form-horizontal">
                    <div class="card-body">
                        <h4 class="card-title">{{__('strings.add_title')}}</h4>
                        
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="title" placeholder="{{__('strings.title')}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="form-group input-group">
                                {!! Form::file('image', ['class' => 'fileUploader', 'required' => 'required']); !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="form-group input-group">    
                                {!! Form::date('start_date', null, ['class' => 'form-control']) !!}    
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <textarea class="form-control" name="description" placeholder="{{__('strings.description')}}" ></textarea>
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
