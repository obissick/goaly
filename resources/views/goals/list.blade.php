@extends('layouts.app')
@section('title', 'My Goals')
@section('content')
    <div class="container container-fluid">
        <a href="{{route('goal.create')}}" class="btn btn-primary">New Goal</a>
        <br><br>
        <!-- Current Tasks -->
        @if (count($goals) > 0)
            <div class="panel panel-default">
                <div class="panel-heading">
                    Goals 
                </div>
                
                <div class="panel-body">
                    <table class="table table-striped task-table">

                        <!-- Table Headings -->
                        <thead>
                            <th>Title</th>
                            <th>Created</th>
                            <th>Target Date</th>
                            <th>Commands</th>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                            @foreach ($goals as $goal)
                                @if ($goal->completed_date)
                                    <tr class="table-success">
                                @else
                                    <tr>
                                @endif
                                    <!-- Task Name -->
                                    <td class="table-text">
                                        <div><a href="{{route('goal.show', $goal->id)}}">{{ $goal->title }}</a></div>
                                    </td>

                                    <td>
                                        {{ $goal->created_at }}
                                    </td>
                                        
                                    <td>
                                        {{ $goal->target_date }}
                                    </td>

                                    <td>
                                        <div class="btn-group" role="group" aria-label="...">
                                            {!! Form::open(['route' => ['goal.destroy', $goal->id], 'method' => 'delete']) !!}
                                                <a href="{{route('goal.show', $goal->id)}}" class="btn btn-primary btn-sm">View</a>
                                                <a href="{{route('goal.edit', $goal->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                                {!! Form::hidden('id', $goal->id) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $goals->links() }}
                </div>
            </div>
        @endif
    </div>
@endsection