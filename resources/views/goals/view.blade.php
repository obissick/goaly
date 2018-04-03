@extends('layouts.app')

@section('content')
<div class="container container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">View Goal</div>
                <div class="panel-body">
                    <div class="btn-group" role="group" aria-label="...">
                        @if ($goal->user_id == Auth::user()->id)
                            @if ($goal->completed_date)
                                {!! Form::open(['route' => ['goal.reopen', $goal->id], 'method' => 'post']) !!}
                                    <a href="{{ URL::previous() }}" class="btn btn-primary">Back</a>
                                    {!! Form::hidden('id', $goal->id) !!}
                                    {!! Form::submit('Re-Open', ['class' => 'btn btn-success']) !!}
                                {!! Form::close() !!}
                            @else
                                {!! Form::open(['route' => ['goal.complete', $goal->id], 'method' => 'post']) !!}
                                    <a href="{{ URL::previous() }}" class="btn btn-primary">Back</a>
                                    {!! Form::hidden('id', $goal->id) !!}
                                    {!! Form::submit('Complete', ['class' => 'btn btn-success']) !!}
                                {!! Form::close() !!}
                            @endif
                        @else
                            <a href="{{ URL::previous() }}" class="btn btn-primary">Back</a>
                        @endif
                    </div>
                    <br>
                    <div class="">
                        <div>
                            <h1>{{$goal->title}}</h1>
                        </div>
                        <div>
                            <strong>User: </strong>{{$goal->username}}
                        </div>
                        <div>
                            <strong>Created: </strong>{{$goal->created_at}}
                        </div>
                        <div>
                            <strong>Target Date: </strong>{{$goal->target_date}}
                        </div>
                        <div>    
                            <strong>Updated: </strong>{{$goal->updated_at}}
                        </div>
                        <div>
                            {{$goal->content}}
                        </div>
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
                                        <!--<img class="media-object" src="..." alt="...">-->
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