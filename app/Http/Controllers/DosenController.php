<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDosenRequest;
use App\Http\Requests\UpdateDosenRequest;
use App\Models\Dosen;
use Illuminate\Support\Facades\Log;

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
        $dosen = auth()->user()->dosens()->create($request->validated());
        Log::info('[Dosen] Ditambahkan', ['user' => auth()->user()->email, 'nip' => $dosen->nip, 'nama' => $dosen->name]);

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil ditambahkan!');
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
        Log::info('[Dosen] Diupdate', ['user' => auth()->user()->email, 'id' => $dosen->id, 'nama' => $dosen->name]);

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil diupdate!');
    }

    public function destroy(Dosen $dosen)
    {
        abort_if($dosen->user_id !== auth()->id(), 403);
        Log::warning('[Dosen] Dihapus', ['user' => auth()->user()->email, 'id' => $dosen->id, 'nama' => $dosen->name]);
        $dosen->delete();

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil dihapus!');
    }
}
