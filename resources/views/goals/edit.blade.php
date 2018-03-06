@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Goal</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('goal.update', $goal->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ $goal->title }}" autofocus>

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
                                <textarea id="content" class="form-control" name="content">{{ $goal->content }}</textarea>

                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('target-date') ? ' has-error' : '' }}">
                            <label for="target-date" class="col-md-4 control-label">Target Date</label>

                            <div class="col-md-6">
                                <input id="target-date" type="date" class="form-control" name="target-date" value="{{ $goal->target_date }}">

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
                                    <input id="private" type="checkbox" class="form-control" name="private" checked="{{ $goal->is_private }}">
    
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
                                    Update
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