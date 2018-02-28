@extends('layouts.app')

@section('content')
    <div class="container container-fluid">
        <a href="{{route('newgoal')}}" class="btn btn-primary">New Goal</a>
        <!-- Current Tasks -->
        @if (count($goals) > 0)
            <div class="panel panel-default">
                <div class="panel-heading">
                    Current Goals
                </div>

                <div class="panel-body">
                    <table class="table table-striped task-table">

                        <!-- Table Headings -->
                        <thead>
                            <th>Goal</th>
                            <th>Â </th>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                            @foreach ($goals as $goal)
                                <tr>
                                    <!-- Task Name -->
                                    <td class="table-text">
                                        <div>{{ $goal->name }}</div>
                                    </td>

                                    <td>
                                        <!-- TODO: Delete Button -->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection