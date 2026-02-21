<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJadwalRequest;
use App\Http\Requests\UpdateJadwalRequest;
use App\Models\Jadwal;
use App\Services\ScheduleService;

class JadwalController extends Controller
{
    protected $scheduleService;

    public function __construct(ScheduleService $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }

    public function index()
    {
        $jadwals = auth()->user()->jadwals()
            ->with(['mataKuliah', 'dosen', 'ruangan'])
            ->latest()
            ->paginate(10);

        return view('jadwal.index', compact('jadwals'));
    }

    public function create()
    {
        $mataKuliahs = auth()->user()->mataKuliahs()->orderBy('nama')->get();
        $dosens = auth()->user()->dosens()->orderBy('name')->get();
        $ruangans = auth()->user()->ruangans()->orderBy('nama')->get();
        $hariOptions = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];

        return view('jadwal.create', compact('mataKuliahs', 'dosens', 'ruangans', 'hariOptions'));
    }

    public function store(StoreJadwalRequest $request)
    {
        try {
            $this->scheduleService->createSchedule(
                array_merge($request->validated(), ['user_id' => auth()->id()])
            );

            return redirect()
                ->route('jadwal.index')
                ->with('success', 'Jadwal berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show(Jadwal $jadwal)
    {
        abort_if($jadwal->user_id !== auth()->id(), 403);

        $jadwal->load(['mataKuliah', 'dosen', 'ruangan']);

        return view('jadwal.show', compact('jadwal'));
    }

    public function edit(Jadwal $jadwal)
    {
        abort_if($jadwal->user_id !== auth()->id(), 403);

        $mataKuliahs = auth()->user()->mataKuliahs()->orderBy('nama')->get();
        $dosens = auth()->user()->dosens()->orderBy('name')->get();
        $ruangans = auth()->user()->ruangans()->orderBy('nama')->get();
        $hariOptions = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];

        return view('jadwal.edit', compact('jadwal', 'mataKuliahs', 'dosens', 'ruangans', 'hariOptions'));
    }

    public function update(UpdateJadwalRequest $request, Jadwal $jadwal)
    {
        abort_if($jadwal->user_id !== auth()->id(), 403);

        try {
            $this->scheduleService->updateSchedule($jadwal, $request->validated());

            return redirect()
                ->route('jadwal.index')
                ->with('success', 'Jadwal berhasil diupdate!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Jadwal $jadwal)
    {
        abort_if($jadwal->user_id !== auth()->id(), 403);

        $jadwal->delete();

        return redirect()
            ->route('jadwal.index')
            ->with('success', 'Jadwal berhasil dihapus!');
    }
}
