<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRuanganRequest;
use App\Http\Requests\UpdateRuanganRequest;
use App\Models\Ruangan;
use Illuminate\Support\Facades\Log;

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
        $ruangan = auth()->user()->ruangans()->create($request->validated());
        Log::info('[Ruangan] Ditambahkan', ['user' => auth()->user()->email, 'nama' => $ruangan->nama, 'kapasitas' => $ruangan->kapasitas]);

        return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil ditambahkan!');
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
        Log::info('[Ruangan] Diupdate', ['user' => auth()->user()->email, 'id' => $ruangan->id, 'nama' => $ruangan->nama]);

        return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil diupdate!');
    }

    public function destroy(Ruangan $ruangan)
    {
        abort_if($ruangan->user_id !== auth()->id(), 403);
        Log::warning('[Ruangan] Dihapus', ['user' => auth()->user()->email, 'id' => $ruangan->id, 'nama' => $ruangan->nama]);
        $ruangan->delete();

        return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil dihapus!');
    }
}
