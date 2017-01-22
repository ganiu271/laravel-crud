@extends('layouts.master')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Edit Task</div>
        <div class="panel-body">

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{--{!! Form::model($task, ['method' => 'PATCH','route' => ['tasks.update', $task->id]]) !!}--}}
                <form method="post" action="/update_tasks/{!! $task->id !!}">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{  $task->name }}">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" rows="3">{{  $task->description }}</textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Save Changes" class="btn btn-info">
                <a href="{{ route('tasks.index')  }}" class="btn btn-default">Cancel</a>
            </div>
                </form>
            {{--{!! Form::close() !!}--}}
        </div>
    </div>

@endsection