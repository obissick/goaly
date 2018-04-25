@extends('layouts.app')
@section('title', 'My Goals')
@section('content')
    <div class="container container-fluid">
        <a href="{{route('goal.create')}}" class="btn btn-primary">New Goal</a>
        <br><br>
        @include('partials.flash')
        <!-- Current Tasks -->
        @if (count($goals) > 0)
            <div class="panel panel-default">
                <div class="panel-heading">
                    Goals 
                </div>
                
                <div class="panel-body">
                    <div class="card-deck-wrapper">
                    <div class="card-deck">
                    @foreach ($goals as $goal)
                    
                        <div class="card border-primary text-white" style="width: 20rem; text-align:center;display:inline-block;">
                            <div class="card-header"><a href="{{route('goal.show', $goal->id)}}">{{ $goal->title }}</a></div>
                            <div class="card-body">
                                <h6 class="card-subtitle mb-2 text-muted">{{ $goal->username }}</h6>
                                <p class="card-text"></p>
                                    @if($goal->user_id == $user)
                                        <div class="btn-group" role="group" aria-label="...">
                                            {!! Form::open(['route' => ['goal.destroy', $goal->id], 'method' => 'delete']) !!}
                                                <a href="{{route('goal.show', $goal->id)}}" class="btn btn-primary btn-xs">View</a>
                                                <a href="{{route('goal.edit', $goal->id)}}" class="btn btn-warning btn-xs">Edit</a>
                                                {!! Form::hidden('id', $goal->id) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    @else
                                        <div class="btn-group" role="group" aria-label="...">
                                            {!! Form::open(['route' => ['goal.like', $goal->id], 'method' => 'post']) !!}
                                                <a href="{{route('goal.show', $goal->id)}}" class="btn btn-primary btn-xs">View</a>
                                                {!! Form::hidden('id', $goal->id) !!}
                                                {!! Form::submit('Like', ['class' => 'btn btn-success btn-xs']) !!}
                                            {!! Form::close() !!}
                                            {!! Form::open(['route' => ['followgoal', $goal->id], 'method' => 'post']) !!}
                                                {!! Form::hidden('id', $goal->id) !!}
                                                {!! Form::submit('Follow', ['class' => 'btn btn-default btn-xs']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    @endif
                            </div>
                        </div>
                   
                        
                    @endforeach
                    </div>
                    </div>
                    {{ $goals->links() }}
                </div>
            </div>
        @endif
    </div>
@endsection