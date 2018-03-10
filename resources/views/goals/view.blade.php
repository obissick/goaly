@extends('layouts.app')

@section('content')
<div class="container container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">View Goal</div>
                <div class="panel-body">
                        <a href="{{ URL::previous() }}" class="btn btn-primary">Back</a>
                    <br>
                    <div class="col-lg-offset-4 col-lg-4">
                        <h1>{{$goal->title}}</h1>
                        <p>
                            {{$goal->content}}
                            {{$goal->target_date}}
                            {{$goal->created_at}}
                            {{$goal->updated_at}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Comment</div>
                <div class="panel-body">
                    <div class="col-md-6">
                        {!! Form::open(['route' => ['comment.store', $goal->id], 'method' => 'post']) !!}
                            {!! Form::hidden('goalid', $goal->id) !!}
                            <div class="form-group">
                                {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
                            </div>
                            {!! Form::submit('Submit', ['class' => 'btn btn-success btn-xs']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (count($comments) > 0)
        <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">Comments</div>
                        <div class="panel-body">
                            @foreach ($comments as $comment)
                                <div class="media">
                                    <div class="media-left">
                                      <a href="#">
                                        <img class="media-object" src="..." alt="...">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h5 class="media-heading">{{ $comment->username}} <small><i>{{ Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</i></small></h5>
                                        <p>
                                            {{ $comment->content }}
                                        </p>
                                    </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
</div>
@endsection