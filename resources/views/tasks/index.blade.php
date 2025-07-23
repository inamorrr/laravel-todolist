@extends('layouts.app')

@section('content')
    <h1 class="mb-4">My To-Do List</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($tasks->isEmpty())
        <p>No tasks found. <a href="{{ route('tasks.create') }}">Add one!</a></p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Scenario</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Assigned To</th>
                    <th>Role</th>
                    <th>Completed</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ ucfirst($task->scenario) }}</td>
                        <td>{{ $task->date ?? '-' }}</td>
                        <td>{{ $task->status ?? '-' }}</td>
                        <td>{{ $task->assigned_to ?? '-' }}</td>
                        <td>{{ $task->role ?? '-' }}</td>
                        <td>
                            @if($task->is_completed)
                                <span class="badge bg-success">Yes</span>
                            @else
                                <span class="badge bg-secondary">No</span>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-sm btn-warning" href="{{ route('tasks.edit', $task->id) }}">Edit</a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    @endif
@endsection