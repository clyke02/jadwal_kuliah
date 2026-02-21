<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRuanganRequest;
use App\Http\Requests\UpdateRuanganRequest;
use App\Models\Ruangan;

class RuanganController extends Controller
{
    public function index()
    {
        $ruangans = auth()->user()->ruangans()->latest()->paginate(10);

        return view('ruangan.index', compact('ruangans'));
    }

    public function create()
    {
        return view('ruangan.create');
    }

    public function store(StoreRuanganRequest $request)
    {
        auth()->user()->ruangans()->create($request->validated());

        return redirect()
            ->route('ruangan.index')
            ->with('success', 'Ruangan berhasil ditambahkan!');
    }

    public function show(Ruangan $ruangan)
    {
        abort_if($ruangan->user_id !== auth()->id(), 403);

        return view('ruangan.show', compact('ruangan'));
    }

    public function edit(Ruangan $ruangan)
    {
        abort_if($ruangan->user_id !== auth()->id(), 403);

        return view('ruangan.edit', compact('ruangan'));
    }

    public function update(UpdateRuanganRequest $request, Ruangan $ruangan)
    {
        abort_if($ruangan->user_id !== auth()->id(), 403);

        $ruangan->update($request->validated());

        return redirect()
            ->route('ruangan.index')
            ->with('success', 'Ruangan berhasil diupdate!');
    }

    public function destroy(Ruangan $ruangan)
    {
        abort_if($ruangan->user_id !== auth()->id(), 403);

        $ruangan->delete();

        return redirect()
            ->route('ruangan.index')
            ->with('success', 'Ruangan berhasil dihapus!');
    }
}
