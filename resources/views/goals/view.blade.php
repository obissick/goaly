@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">View Goal</div>
                <div class="panel-body">
                        <a href="{{ URL::previous() }}" class="btn btn-primary">Back</a>
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
    <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Comments</div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <tbody>
                                @foreach ($comments as $comment)
                                    <tr>
                                        <!-- Task Name -->
                                        <td>
                                            {{ $comment->content }}
                                            {{ $comment->email}}
                                            {{ $comment->created_at }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection