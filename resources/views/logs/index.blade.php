<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Log & Debug</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Toolbar --}}
            <div class="bg-white rounded-xl shadow-sm p-4 mb-4">
                <div class="flex flex-wrap gap-3 items-center">

                    <div class="relative flex-1" style="min-width: 200px;">
                        <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 105 11a6 6 0 0012 0z"/>
                            </svg>
                        </span>
                        <input id="search-input" type="text" placeholder="Cari teks di log..."
                            oninput="applyFilter()"
                            class="w-full pl-9 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <select id="level-select" onchange="applyFilter()"
                        class="text-sm border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                        <option value="">-- Semua Level --</option>
                        <option value="ERROR">ERROR</option>
                        <option value="CRITICAL">CRITICAL</option>
                        <option value="WARNING">WARNING</option>
                        <option value="INFO">INFO</option>
                        <option value="DEBUG">DEBUG</option>
                    </select>

                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <span id="status-dot" style="display:inline-block;width:10px;height:10px;border-radius:50%;background:#22c55e;"></span>
                        <span id="entry-count">0 entri</span>
                    </div>

                    <button id="btn-pause" onclick="togglePause()"
                        style="display:flex;align-items:center;gap:6px;padding:7px 14px;font-size:13px;font-weight:500;border-radius:8px;background:#fefce8;color:#a16207;border:1px solid #fde68a;cursor:pointer;">
                        ⏸ Jeda
                    </button>

                    <button onclick="clearLogs()"
                        style="display:flex;align-items:center;gap:6px;padding:7px 14px;font-size:13px;font-weight:500;border-radius:8px;background:#fef2f2;color:#dc2626;border:1px solid #fecaca;cursor:pointer;">
                        🗑 Hapus Log
                    </button>

                </div>
            </div>

            {{-- Terminal --}}
            <div style="background:#0d1117;border-radius:12px;overflow:hidden;border:1px solid #30363d;box-shadow:0 4px 24px rgba(0,0,0,0.4);">

                {{-- Titlebar --}}
                <div style="background:#161b22;padding:10px 16px;border-bottom:1px solid #30363d;display:flex;align-items:center;gap:8px;">
                    <span style="font-family:monospace;font-size:12px;color:#8b949e;margin-left:8px;">storage/logs/laravel.log</span>
                    <span id="filtered-count" style="margin-left:auto;font-size:11px;color:#6e7681;"></span>
                </div>

                {{-- Log output --}}
                <div id="log-output"
                    style="height:560px;overflow-y:auto;font-family:monospace;font-size:12px;color:#c9d1d9;padding:8px 0;">
                    <div style="padding:12px 16px;color:#6e7681;font-style:italic;">Menunggu log masuk...</div>
                </div>

            </div>

        </div>
    </div>

    <script>
        let allEntries   = [];
        let currentSize  = 0;
        let paused       = false;
        let autoScroll   = true;

        const levelColor = {
            ERROR:    { border:'#f85149', badge:'background:#b91c1c;color:#fef2f2;',  text:'#fca5a5' },
            CRITICAL: { border:'#ff7b72', badge:'background:#7f1d1d;color:#fecaca;',  text:'#fca5a5' },
            WARNING:  { border:'#e3b341', badge:'background:#92400e;color:#fef3c7;',  text:'#fde68a' },
            INFO:     { border:'#58a6ff', badge:'background:#1d4ed8;color:#dbeafe;',  text:'#93c5fd' },
            DEBUG:    { border:'#6e7681', badge:'background:#374151;color:#d1d5db;',  text:'#9ca3af' },
        };

        function esc(s) {
            return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
        }

        function highlight(text, kw) {
            if (!kw) return esc(text);
            const re = new RegExp(kw.replace(/[.*+?^${}()|[\]\\]/g,'\\$&'), 'gi');
            return esc(text).replace(re, m => `<mark style="background:#f59e0b55;border-radius:2px;">${m}</mark>`);
        }

        function buildHtml(entry, idx, kw) {
            const lvl   = entry.level || 'DEBUG';
            const c     = levelColor[lvl] || levelColor.DEBUG;
            const tid   = 'tr' + idx;
            const trace = entry.trace && entry.trace.trim();

            return `<div data-level="${lvl}" style="border-left:3px solid ${c.border};padding:10px 16px;border-bottom:1px solid rgba(255,255,255,0.04);">
                <div style="display:flex;align-items:flex-start;gap:8px;flex-wrap:wrap;">
                    <span style="color:#6e7681;white-space:nowrap;font-size:11px;">${esc(entry.timestamp)}</span>
                    <span style="${c.badge}padding:2px 7px;border-radius:4px;font-size:11px;font-weight:700;">${lvl}</span>
                    <span style="color:${c.text};flex:1;word-break:break-all;">${highlight(entry.message, kw)}</span>
                    ${trace ? `<button onclick="toggleTrace('${tid}',this)" style="font-size:11px;color:#8b949e;background:none;border:1px solid #30363d;border-radius:4px;padding:2px 8px;cursor:pointer;">▼ trace</button>` : ''}
                </div>
                ${trace ? `<div id="${tid}" style="display:none;margin-top:8px;padding:8px;border-top:1px solid #21262d;white-space:pre-wrap;word-break:break-all;color:#8b949e;font-size:11px;line-height:1.6;">${highlight(entry.trace, kw)}</div>` : ''}
            </div>`;
        }

        function toggleTrace(id, btn) {
            const el = document.getElementById(id);
            const show = el.style.display === 'none';
            el.style.display = show ? 'block' : 'none';
            btn.textContent = show ? '▲ trace' : '▼ trace';
        }

        function applyFilter() {
            const kw    = document.getElementById('search-input').value.trim().toLowerCase();
            const lvl   = document.getElementById('level-select').value;
            const out   = document.getElementById('log-output');

            const filtered = allEntries.filter(e => {
                const okLvl  = !lvl || e.level === lvl;
                const okText = !kw || e.message.toLowerCase().includes(kw) || (e.trace||'').toLowerCase().includes(kw);
                return okLvl && okText;
            });

            document.getElementById('filtered-count').textContent =
                filtered.length + ' / ' + allEntries.length + ' entri';

            if (filtered.length === 0) {
                out.innerHTML = '<div style="padding:12px 16px;color:#6e7681;font-style:italic;">Tidak ada log yang cocok...</div>';
                return;
            }

            out.innerHTML = filtered.map((e, i) => buildHtml(e, i, kw)).join('');

            if (autoScroll) out.scrollTop = out.scrollHeight;
        }

        function fetchLogs() {
            if (paused) return;
            fetch(`/logs/fetch?size=${currentSize}`)
                .then(r => r.json())
                .then(data => {
                    currentSize = data.size;
                    if (data.entries && data.entries.length > 0) {
                        allEntries = allEntries.concat(data.entries);
                        if (allEntries.length > 500) allEntries = allEntries.slice(-500);
                        document.getElementById('entry-count').textContent = allEntries.length + ' entri';
                        applyFilter();
                    }
                }).catch(() => {
                    document.getElementById('status-dot').style.background = '#ef4444';
                });
        }

        function togglePause() {
            paused = !paused;
            const btn = document.getElementById('btn-pause');
            const dot = document.getElementById('status-dot');
            if (paused) {
                btn.textContent = '▶ Lanjutkan';
                btn.style.cssText = 'display:flex;align-items:center;gap:6px;padding:7px 14px;font-size:13px;font-weight:500;border-radius:8px;background:#f0fdf4;color:#16a34a;border:1px solid #bbf7d0;cursor:pointer;';
                dot.style.background = '#eab308';
            } else {
                btn.textContent = '⏸ Jeda';
                btn.style.cssText = 'display:flex;align-items:center;gap:6px;padding:7px 14px;font-size:13px;font-weight:500;border-radius:8px;background:#fefce8;color:#a16207;border:1px solid #fde68a;cursor:pointer;';
                dot.style.background = '#22c55e';
                fetchLogs();
            }
        }

        function clearLogs() {
            if (!confirm('Yakin ingin menghapus semua log?')) return;
            fetch('/logs/clear', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                }
            }).then(() => {
                allEntries  = [];
                currentSize = 0;
                document.getElementById('entry-count').textContent = '0 entri';
                document.getElementById('filtered-count').textContent = '';
                document.getElementById('log-output').innerHTML =
                    '<div style="padding:12px 16px;color:#6e7681;font-style:italic;">Log dikosongkan.</div>';
            });
        }

        document.getElementById('log-output').addEventListener('scroll', function () {
            autoScroll = this.scrollTop + this.clientHeight >= this.scrollHeight - 60;
        });

        fetchLogs();
        setInterval(fetchLogs, 2000);
    </script>

@php
    $btcItems = [
        [
            'badge' => 'PHP',
            'title' => 'LogController::fetch()',
            'route' => 'GET /logs/fetch?size={lastSize}',
            'desc'  => 'Polling setiap 2 detik dari JavaScript. Parameter <code>size</code> adalah byte terakhir yang sudah dibaca. Server hanya mengirim konten baru (incremental read) sehingga hemat bandwidth.',
            'file'  => 'app/Http/Controllers/LogController.php',
            'code'  => <<<'CODE'
public function fetch(Request $request)
{
    clearstatcache(true, $this->logPath);
    $currentSize = filesize($this->logPath);
    $lastSize    = (int) $request->query('size', 0);

    if ($lastSize > $currentSize) $lastSize = 0;

    if ($lastSize === 0 && $currentSize > 0) {
        $handle  = fopen($this->logPath, 'r');
        fseek($handle, $currentSize - min($currentSize, 200 * 1024));
        $content = fread($handle, min($currentSize, 200 * 1024));
        fclose($handle);
    } elseif ($currentSize > $lastSize) {
        $handle  = fopen($this->logPath, 'r');
        fseek($handle, $lastSize);
        $content = fread($handle, $currentSize - $lastSize);
        fclose($handle);
    }

    return response()->json([
        'entries' => $this->parse($content ?? ''),
        'size'    => $currentSize,
    ]);
}
CODE,
        'kompetensi' => ['J.620100.025.02','J.620100.044.01','J.620100.045.01'],
        ],
        [
            'badge' => 'PHP',
            'title' => 'LogController::parse() — Log Parsing',
            'route' => '',
            'desc'  => 'Setiap baris log Laravel dimulai dengan format <code>[tanggal] env.LEVEL: pesan</code>. Regex mendeteksi baris baru, baris setelahnya dikumpulkan sebagai stack trace.',
            'file'  => 'app/Http/Controllers/LogController.php',
            'code'  => <<<'CODE'
protected function parse(string $content): array
{
    $entries = [];
    $lines   = explode("\n", $content);
    $current = null;

    foreach ($lines as $line) {
        if (preg_match(
            '/^\[(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\] (\w+)\.(\w+): (.*)/',
            $line, $m
        )) {
            if ($current) $entries[] = $current;
            $current = [
                'timestamp' => $m[1],
                'level'     => strtoupper($m[3]),
                'message'   => trim($m[4]),
                'trace'     => '',
            ];
        } elseif ($current) {
            $current['trace'] .= $line . "\n";
        }
    }
    if ($current) $entries[] = $current;
    return $entries;
}
CODE,
        ],
        [
            'badge' => 'Laravel',
            'title' => 'Log Facade — cara menulis log',
            'route' => '',
            'desc'  => 'Laravel menyediakan facade <code>Log</code> untuk menulis ke file log. Ada 8 level sesuai standar PSR-3: debug, info, notice, warning, error, critical, alert, emergency.',
            'file'  => 'app/Http/Controllers/DosenController.php',
            'code'  => <<<'CODE'
use Illuminate\Support\Facades\Log;

// Info
Log::info('[Dosen] Ditambahkan', [
    'user' => auth()->user()->email,
    'nama' => $dosen->name,
]);

// Warning
Log::warning('[Dosen] Dihapus', ['id' => $dosen->id]);

// Error
Log::error('[Jadwal] Konflik', [
    'error' => $e->getMessage(),
]);
CODE,
        'kompetensi' => ['J.620100.025.02','J.620100.044.01'],
        ],
    [
        'badge' => 'SQL',
        'title' => 'Tidak ada query DB — log dari file sistem',
        'route' => '',
        'desc'  => 'Log viewer TIDAK menggunakan database. Laravel menyimpan log ke file <code>storage/logs/laravel.log</code>. Controller membaca file langsung dengan <code>fread()</code> — lebih cepat dari query DB untuk log real-time.',
        'file'  => '-- storage/logs/laravel.log (format)',
        'code'  => <<<'CODE'
-- Format setiap baris log:
[2026-02-21 10:30:00] local.INFO: [Dosen] Ditambahkan
{"user":"test@gmail.com","nip":"1099288388199","nama":"Sutanto"}

[2026-02-21 10:31:15] local.WARNING: [Dosen] Dihapus
{"id":1,"nama":"Sutanto"}

-- Disimpan otomatis oleh Laravel ke:
-- storage/logs/laravel.log

-- Bukan query SQL, tapi bisa dicek di MySQL dengan:
-- SELECT * FROM sessions WHERE user_id = 1;
-- (jika menggunakan database session driver)
CODE,
        'kompetensi' => ['J.620100.025.02','J.620100.045.01'],
    ],
    ];
    @endphp
    <div class="py-4 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-behind-the-code :items="$btcItems" page-title="Log Viewer" />
        </div>
    </div>
</x-app-layout>
