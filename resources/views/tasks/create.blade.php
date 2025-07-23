@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Add New Task</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Skenario</label>
            <select name="scenario" id="scenario" class="form-select" required onchange="toggleFields()">
                <option value="biasa">Biasa</option>
                <option value="advance">Advance</option>
            </select>
        </div>

        <!-- Jika Skenario Biasa -->
        <div id="biasa-fields">
            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="Penting">Penting</option>
                    <option value="Kurang Penting">Kurang Penting</option>
                    <option value="Tidak Penting">Tidak Penting</option>
                </select>
            </div>
        </div>

        <!-- Jika Skenario Advance -->
        <div id="advance-fields" style="display:none;">
            <div class="mb-3">
                <label class="form-label">Role</label>
                <input type="text" name="role" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Diberikan kepada</label>
                <input type="text" name="assigned_to" class="form-control">
            </div>
        </div>

        <button type="submit" class="btn btn-success">Save Task</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
    </form>

    <script>
        function toggleFields() {
            const skenario = document.getElementById("scenario").value;
            document.getElementById("biasa-fields").style.display = skenario === "biasa" ? "block" : "none";
            document.getElementById("advance-fields").style.display = skenario === "advance" ? "block" : "none";
        }

        // Trigger default on page load
        document.addEventListener("DOMContentLoaded", toggleFields);
    </script>

@endsection