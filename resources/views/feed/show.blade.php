@extends('layouts.app')
@section('title', 'My Goals')
@section('content')
    <div class="container container-fluid">
        <a href="{{route('goal.create')}}" class="btn btn-primary">New Goal</a>
        <hr>
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
                                        <div><a href="">{{ $goal->title }}</a></div>
                                    </td>

                                    <td>
                                        {{ $goal->created_at }}
                                    </td>

                                    <td>
                                        {{ $goal->target_date }}
                                    </td>

                                    <td>
                                        {{ $goal->email }}
                                    </td>

                                    <td>
                                        @if($goal->user_id == $user)
                                            <a href="{{route('goal.show', $goal->id)}}" class="btn btn-primary">View</a>
                                            <a href="{{route('goal.edit', $goal->id)}}" class="btn btn-warning">Edit</a>
                                            <a href="{{route('goal.destroy', $goal->id)}}" class="btn btn-danger">Delete</a>
                                        @else
                                            <a href="{{route('goal.show', $goal->id)}}" class="btn btn-primary">View</a>
                                            <a href="{{route('goal.show', $goal->id)}}" class="btn btn-default">Follow</a>
                                        @endif
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