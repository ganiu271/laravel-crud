@extends('layouts.master')

@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="panel panel-default">
        <div class="panel-heading">
            Task List
        </div>
        <div class="panel-body">
            <div class="form-group">
                <div class="pull-right">
                    <a href="/tasks/create" class="btn btn-default">Add New Task</a>
                </div>
            </div>

            <table class="table table-bordered table-stripped">
                <tr>
                    <th width="20">No</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th width="300">Action</th>
                </tr>
                @if (count($tasks) > 0)
                    @foreach ($tasks as $key => $task)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $task->name }}</td>
                            <td>{{ $task->description }}</td>
                            <td>
                                <a class="btn btn-success" href="{{ route('tasks.show',$task->id) }}">Show</a>
                                <a class="btn btn-primary" href="{{ route('tasks.edit',$task->id) }}">Edit</a>
                                {{--{{ Form::open(['method' => 'DELETE','route' => ['tasks.destroy', $task->id],'style'=>'display:inline']) }}--}}
                                <form method="post" action="/tasks_delete/{!! $task->id !!}" style="display:inline">
                                    <button class="btt btn-danger">Delete</button>
                                {{--{{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}--}}
                                {{--{{ Form::close() }}--}}
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4">Tasks not found!</td>
                    </tr>
                @endif
            </table>

            {{--{{ $tasks->render() }}--}}

            {{--<div class="container">--}}
                {{--@foreach ($tasks as $task)--}}
                    {{--{{ $task->name }}--}}
                {{--@endforeach--}}
            {{--</div>--}}

            {{ $tasks->links() }}

        </div>
    </div>

@endsection