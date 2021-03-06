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
                    Followed Goals 
                </div>
                
                <div class="panel-body">
                    <table class="table table-hover table-striped task-table">

                        <!-- Table Headings -->
                        <thead>
                            <th>Title</th>
                            <th>Created Date</th>
                            <th>Target Date</th>
                            <th>User</th>
                            <th>Commands</th>
                        </thead>
                    
                        <!-- Table Body -->
                        <tbody>
                            @foreach ($goals as $goal)
                                <tr>
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
                                        {{ $goal->username }}
                                    </td>
                                       
                                    <td>
                                        <div class="btn-group" role="group" aria-label="...">
                                            {!! Form::open(['route' => ['unfollowgoal', $goal->id], 'method' => 'delete']) !!}
                                                <a href="{{route('goal.show', $goal->id)}}" class="btn btn-primary btn-sm">View</a>
                                                {!! Form::hidden('id', $goal->id) !!}
                                                {!! Form::submit('Unfollow', ['class' => 'btn btn-default btn-sm']) !!}
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