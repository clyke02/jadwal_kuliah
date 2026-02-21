<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDosenRequest;
use App\Http\Requests\UpdateDosenRequest;
use App\Models\Dosen;

class DosenController extends Controller
{
    public function index()
    {
        $dosens = auth()->user()->dosens()->latest()->paginate(10);

        return view('dosen.index', compact('dosens'));
    }

    public function create()
    {
        return view('dosen.create');
    }

    public function store(StoreDosenRequest $request)
    {
        auth()->user()->dosens()->create($request->validated());

        return redirect()
            ->route('dosen.index')
            ->with('success', 'Dosen berhasil ditambahkan!');
    }

    public function show(Dosen $dosen)
    {
        abort_if($dosen->user_id !== auth()->id(), 403);

        return view('dosen.show', compact('dosen'));
    }

    public function edit(Dosen $dosen)
    {
        abort_if($dosen->user_id !== auth()->id(), 403);

        return view('dosen.edit', compact('dosen'));
    }

    public function update(UpdateDosenRequest $request, Dosen $dosen)
    {
        abort_if($dosen->user_id !== auth()->id(), 403);

        $dosen->update($request->validated());

        return redirect()
            ->route('dosen.index')
            ->with('success', 'Dosen berhasil diupdate!');
    }

    public function destroy(Dosen $dosen)
    {
        abort_if($dosen->user_id !== auth()->id(), 403);

        $dosen->delete();

        return redirect()
            ->route('dosen.index')
            ->with('success', 'Dosen berhasil dihapus!');
    }
}
