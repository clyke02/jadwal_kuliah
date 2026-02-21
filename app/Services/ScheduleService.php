<?php

namespace App\Services;

use App\Models\Jadwal;
use Illuminate\Support\Facades\DB;

class ScheduleService
{
    public function checkConflict(array $data, ?int $excludeId = null): array
    {
        $conflicts = [];
        $userId = $data['user_id'];

        $roomConflict = $this->checkRoomConflict(
            $userId,
            $data['ruangan_id'],
            $data['hari'],
            $data['jam_mulai'],
            $data['jam_selesai'],
            $excludeId
        );

        if ($roomConflict) {
            $conflicts[] = "Konflik ruangan: {$roomConflict->ruangan->nama} sudah digunakan pada {$data['hari']} jam {$roomConflict->jam_mulai}-{$roomConflict->jam_selesai}";
        }

        $dosenConflict = $this->checkDosenConflict(
            $userId,
            $data['dosen_id'],
            $data['hari'],
            $data['jam_mulai'],
            $data['jam_selesai'],
            $excludeId
        );

        if ($dosenConflict) {
            $conflicts[] = "Konflik dosen: {$dosenConflict->dosen->name} sudah mengajar pada {$data['hari']} jam {$dosenConflict->jam_mulai}-{$dosenConflict->jam_selesai}";
        }

        return $conflicts;
    }

    public function checkRoomConflict(
        int $userId,
        int $ruanganId,
        string $hari,
        string $jamMulai,
        string $jamSelesai,
        ?int $excludeId = null
    ): ?Jadwal {
        $query = Jadwal::with('ruangan')
            ->where('user_id', $userId)
            ->where('ruangan_id', $ruanganId)
            ->where('hari', $hari)
            ->where(function ($q) use ($jamMulai, $jamSelesai) {
                $q->where(function ($query) use ($jamMulai, $jamSelesai) {
                    $query->where('jam_mulai', '<', $jamSelesai)
                          ->where('jam_selesai', '>', $jamMulai);
                });
            });

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->first();
    }

    public function checkDosenConflict(
        int $userId,
        int $dosenId,
        string $hari,
        string $jamMulai,
        string $jamSelesai,
        ?int $excludeId = null
    ): ?Jadwal {
        $query = Jadwal::with('dosen')
            ->where('user_id', $userId)
            ->where('dosen_id', $dosenId)
            ->where('hari', $hari)
            ->where(function ($q) use ($jamMulai, $jamSelesai) {
                $q->where(function ($query) use ($jamMulai, $jamSelesai) {
                    $query->where('jam_mulai', '<', $jamSelesai)
                          ->where('jam_selesai', '>', $jamMulai);
                });
            });

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->first();
    }

    public function createSchedule(array $data): Jadwal
    {
        return DB::transaction(function () use ($data) {
            $conflicts = $this->checkConflict($data);

            if (!empty($conflicts)) {
                throw new \Exception(implode(' | ', $conflicts));
            }

            return Jadwal::create($data);
        });
    }

    public function updateSchedule(Jadwal $jadwal, array $data): Jadwal
    {
        return DB::transaction(function () use ($jadwal, $data) {
            $dataWithUser = array_merge($data, ['user_id' => $jadwal->user_id]);
            $conflicts = $this->checkConflict($dataWithUser, $jadwal->id);

            if (!empty($conflicts)) {
                throw new \Exception(implode(' | ', $conflicts));
            }

            $jadwal->update($data);
            return $jadwal->fresh();
        });
    }
}
