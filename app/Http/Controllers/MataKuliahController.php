<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMataKuliahRequest;
use App\Http\Requests\UpdateMataKuliahRequest;
use App\Models\MataKuliah;
use Illuminate\Support\Facades\Log;

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
        $mk = auth()->user()->mataKuliahs()->create($request->validated());
        Log::info('[Mata Kuliah] Ditambahkan', ['user' => auth()->user()->email, 'kode' => $mk->kode_mk, 'nama' => $mk->nama]);

        return redirect()->route('mata-kuliah.index')->with('success', 'Mata Kuliah berhasil ditambahkan!');
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
        Log::info('[Mata Kuliah] Diupdate', ['user' => auth()->user()->email, 'id' => $mataKuliah->id, 'nama' => $mataKuliah->nama]);

        return redirect()->route('mata-kuliah.index')->with('success', 'Mata Kuliah berhasil diupdate!');
    }

    public function destroy(MataKuliah $mataKuliah)
    {
        abort_if($mataKuliah->user_id !== auth()->id(), 403);
        Log::warning('[Mata Kuliah] Dihapus', ['user' => auth()->user()->email, 'id' => $mataKuliah->id, 'nama' => $mataKuliah->nama]);
        $mataKuliah->delete();

        return redirect()->route('mata-kuliah.index')->with('success', 'Mata Kuliah berhasil dihapus!');
    }
}
