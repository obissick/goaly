@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">New Goal</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('goal.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label for="content" class="col-md-4 control-label">content</label>

                            <div class="col-md-6">
                                <textarea id="content" class="form-control" name="content" value="{{ old('content') }}" required></textarea>

                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                <label for="type" class="col-md-4 control-label">Type</label>
    
                                <div class="col-md-6">
                                    <select id="type" class="form-control" name="type" value="{{ old('type') }}" required>
                                        <option value="personal">Personal</option>
                                        <option value="work">Work</option>
                                    </select>
    
                                    @if ($errors->has('type'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        <div class="form-group{{ $errors->has('target-date') ? ' has-error' : '' }}">
                            <label for="target-date" class="col-md-4 control-label">Target Date</label>

                            <div class="col-md-6">
                                <input id="target-date" type="date" class="form-control" name="target-date" required>

                                @if ($errors->has('target-date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('target-date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('private') ? ' has-error' : '' }}">
                                <label for="private" class="col-md-4 control-label">Private</label>
    
                                <div class="col-md-1">
                                    <input id="private" type="checkbox" class="form-control" name="private">
    
                                    @if ($errors->has('private'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('private') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                    Save
                                </button>
                                <a href="{{route('goal.index')}}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection