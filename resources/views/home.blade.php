@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($message = session()->pull('success'))
                            <div id="login-alert" class="alert alert-success">
                                {{ $message }}
                            </div>
                            <script>
                                setTimeout(() => {
                                    const alert = document.getElementById('login-alert');
                                    if (alert) {
                                        alert.style.transition = "opacity 0.5s ease";
                                        alert.style.opacity = 0;
                                        setTimeout(() => alert.remove(), 500);
                                    }
                                }, 3000);
                            </script>
                        @endif


                        <hr>
                        <h5 class="mt-4">📝 Daftar Tugas:</h5>

                        @if($tasks->count())
                            <ul class="list-group mt-3">

                                @foreach($tasks as $task)
                                    @php
                                        $today = \Carbon\Carbon::now();
                                        $deadline = \Carbon\Carbon::parse($task->tanggal);
                                        $diff = $today->diffInDays($deadline, false);

                                        if ($task->is_completed) {
                                            $bgColor = 'bg-success text-white'; // Hijau jika sudah selesai
                                        } elseif ($diff < 0) {
                                            $bgColor = 'bg-danger text-white'; // Merah jika sudah lewat deadline
                                        } elseif ($diff <= 2) {
                                            $bgColor = 'bg-warning'; // Kuning jika mendekati deadline
                                        } else {
                                            $bgColor = ''; // Putih (default Bootstrap card)
                                        }
                                    @endphp

                                    <li class="list-group-item {{ $bgColor }}">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>{{ $task->title }}</strong><br>
                                                Deadline: {{ $deadline->format('d M Y') }}
                                            </div>

                                            <div class="d-flex gap-1">
                                                <!-- Tombol Edit -->
                                                <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $task->id }}">
                                                    Edit
                                                </button>

                                                <!-- Tombol Hapus -->
                                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-outline-primary"
                                                        onclick="return confirm('Yakin mau hapus tugas ini?')">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>

                                        </div>
                                    </li>

                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editModal{{ $task->id }}" tabindex="-1"
                                        aria-labelledby="editModalLabel{{ $task->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel{{ $task->id }}">Edit Tugas</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Tutup"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="title" class="form-label">Judul</label>
                                                            <input type="text" name="title" class="form-control"
                                                                value="{{ $task->title }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="tanggal" class="form-label">Deadline</label>
                                                            <input type="date" name="tanggal" class="form-control"
                                                                value="{{ $task->tanggal }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">Simpan</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </ul>
                        @else
                            <p class="mt-3 text-muted">Belum ada tugas.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection