@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">View Goal</div>
                <div class="panel-body">
                        <a href="{{URL::previous()}}" class="btn btn-primary">Back</a>
                    <br>
                    <div class="col-lg-offset-4 col-lg-4">
                        <h1>{{$goal->title}}</h1>
                        {{$goal->content}}
                        {{$goal->target_date}}
                        {{$goal->created_at}}
                        {{$goal->updated_at}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection