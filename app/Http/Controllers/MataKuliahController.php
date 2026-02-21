<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMataKuliahRequest;
use App\Http\Requests\UpdateMataKuliahRequest;
use App\Models\MataKuliah;

class MataKuliahController extends Controller
{
    public function index()
    {
        $mataKuliahs = auth()->user()->mataKuliahs()->latest()->paginate(10);

        return view('mata-kuliah.index', compact('mataKuliahs'));
    }

    public function create()
    {
        return view('mata-kuliah.create');
    }

    public function store(StoreMataKuliahRequest $request)
    {
        auth()->user()->mataKuliahs()->create($request->validated());

        return redirect()
            ->route('mata-kuliah.index')
            ->with('success', 'Mata Kuliah berhasil ditambahkan!');
    }

    public function show(MataKuliah $mataKuliah)
    {
        abort_if($mataKuliah->user_id !== auth()->id(), 403);

        return view('mata-kuliah.show', compact('mataKuliah'));
    }

    public function edit(MataKuliah $mataKuliah)
    {
        abort_if($mataKuliah->user_id !== auth()->id(), 403);

        return view('mata-kuliah.edit', compact('mataKuliah'));
    }

    public function update(UpdateMataKuliahRequest $request, MataKuliah $mataKuliah)
    {
        abort_if($mataKuliah->user_id !== auth()->id(), 403);

        $mataKuliah->update($request->validated());

        return redirect()
            ->route('mata-kuliah.index')
            ->with('success', 'Mata Kuliah berhasil diupdate!');
    }

    public function destroy(MataKuliah $mataKuliah)
    {
        abort_if($mataKuliah->user_id !== auth()->id(), 403);

        $mataKuliah->delete();

        return redirect()
            ->route('mata-kuliah.index')
            ->with('success', 'Mata Kuliah berhasil dihapus!');
    }
}
