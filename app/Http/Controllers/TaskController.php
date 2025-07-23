<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'is_completed' => $request->has('is_completed'),
            'tanggal' => $request->tanggal,
            'status' => $request->status,
            'assigned_to' => $request->assigned_to,
            'role' => $request->role,
            'user_id' => Auth::id(), // <- ini WAJIB
        ]);

        return redirect()->route('home')
            ->with('success', 'Tugas Berhasil di tambahkan...');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::find($id);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $task = Task::find($id);
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'is_completed' => $request->has('is_completed'),
            'tanggal' => $request->tanggal,
            'status' => $request->status,
            'assigned_to' => $request->assigned_to,
            'role' => $request->role,
        ]);

        return redirect()->route('tasks.index')
            ->with('success', 'Tugas Berhasil di update...');

    }

    public function complete($id)
    {
        $task = Task::findOrFail($id);
        $task->update([
            'is_completed' => true,
        ]);
        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect()->route('home')
            ->with('success', 'Tugas Berhasil di hapus...');
    }
}
