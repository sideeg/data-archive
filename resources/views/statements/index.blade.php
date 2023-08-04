
@extends('cpanel')

@section('title', __('strings.statements'))

@section('content')

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title m-b-0"> {{__('strings.statements')}}</h5>

                    <br>
                    <a class="btn btn-info btn-block" href="{{ route('statements.create') }}">{{__('strings.create_label')}}</a>
                    <br>
               
                </div>
                <table class="table table-striped" id="data-table-statements">
                    <thead class="thead-dark">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">{{__('strings.name')}}</th>
                          <th scope="col">{{__('strings.edit')}}</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                </table>
            </div>
                          
@endsection
