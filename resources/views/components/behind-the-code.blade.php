@props(['items' => [], 'pageTitle' => ''])

@php
$kompMap = [
    'J.620100.001.01' => 'Analisis Tools',
    'J.620100.002.01' => 'Skalabilitas PL',
    'J.620100.003.01' => 'Identifikasi Framework',
    'J.620100.006.01' => 'Rancang UX',
    'J.620100.017.02' => 'Pemrograman Terstruktur',
    'J.620100.018.02' => 'Pemrograman OOP',
    'J.620100.020.02' => 'Menggunakan SQL',
    'J.620100.021.02' => 'Akses Basis Data',
    'J.620100.022.02' => 'Algoritma Pemrograman',
    'J.620100.024.02' => 'Migrasi Teknologi',
    'J.620100.025.02' => 'Debugging',
    'J.620100.030.02' => 'Pemrograman Multimedia',
    'J.620100.032.01' => 'Code Review',
    'J.620100.036.02' => 'Pengujian Statis',
    'J.620100.044.01' => 'Alert Notifikasi',
    'J.620100.045.01' => 'Pemantauan Resource',
    'J.620100.047.01' => 'Pembaruan PL',
];
@endphp

<div style="margin-top:40px;border-top:2px solid #e5e7eb;padding-top:32px;" x-data="{}">

    {{-- Header bar --}}
    <div style="background:#161b22;border-radius:10px 10px 0 0;padding:10px 20px;display:flex;align-items:center;gap:8px;border:1px solid #30363d;border-bottom:none;">
        <svg style="width:15px;height:15px;flex-shrink:0;" fill="none" stroke="#58a6ff" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
        </svg>
        <span style="font-size:12px;font-weight:700;color:#e6edf3;letter-spacing:0.06em;">BEHIND THE CODE</span>
        @if($pageTitle)
        <span style="font-size:11px;color:#8b949e;background:#21262d;padding:1px 8px;border-radius:99px;border:1px solid #30363d;">{{ $pageTitle }}</span>
        @endif
    </div>

    {{-- Accordion items --}}
    <div style="border:1px solid #e5e7eb;border-radius:0 0 10px 10px;overflow:hidden;">
        @foreach($items as $idx => $item)
        @php
            $badgeColors = [
                'PHP'      => ['bg'=>'#dbeafe','text'=>'#1d4ed8'],
                'Laravel'  => ['bg'=>'#fee2e2','text'=>'#b91c1c'],
                'Eloquent' => ['bg'=>'#d1fae5','text'=>'#065f46'],
                'Service'  => ['bg'=>'#ede9fe','text'=>'#6d28d9'],
                'Blade'    => ['bg'=>'#ffedd5','text'=>'#c2410c'],
                'Request'  => ['bg'=>'#fef3c7','text'=>'#b45309'],
                'Auth'     => ['bg'=>'#dbeafe','text'=>'#1e3a5f'],
                'Route'    => ['bg'=>'#f3f4f6','text'=>'#374151'],
                'SQL'      => ['bg'=>'#ecfdf5','text'=>'#065f46'],
            ];
            $bc = $badgeColors[$item['badge'] ?? 'PHP'] ?? ['bg'=>'#dbeafe','text'=>'#1d4ed8'];
            $komps = $item['kompetensi'] ?? [];
        @endphp

        <div x-data="{ open: {{ $idx === 0 ? 'true' : 'false' }} }"
            style="{{ $idx > 0 ? 'border-top:1px solid #e5e7eb;' : '' }}background:#fff;">

            {{-- Row header --}}
            <button @click="open = !open"
                style="width:100%;text-align:left;padding:11px 18px;background:none;border:none;cursor:pointer;display:flex;align-items:center;gap:8px;flex-wrap:wrap;"
                onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='transparent'">

                <span style="font-size:10px;font-weight:700;padding:2px 8px;border-radius:4px;background:{{ $bc['bg'] }};color:{{ $bc['text'] }};white-space:nowrap;flex-shrink:0;">
                    {{ $item['badge'] ?? 'PHP' }}
                </span>

                <span style="font-size:12px;font-weight:600;color:#111827;font-family:monospace;flex:1;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;min-width:0;">
                    {{ $item['title'] }}
                </span>

                {{-- Competency badges --}}
                @foreach($komps as $kode)
                <span title="{{ $kompMap[$kode] ?? $kode }}"
                    style="font-size:9.5px;font-weight:600;padding:2px 6px;border-radius:4px;background:#eef2ff;color:#4338ca;border:1px solid #c7d2fe;white-space:nowrap;flex-shrink:0;cursor:help;letter-spacing:0.02em;">
                    {{ $kode }}
                </span>
                @endforeach

                @if(!empty($item['route']))
                <span style="font-size:10px;color:#3b82f6;background:#eff6ff;padding:1px 7px;border-radius:4px;border:1px solid #bfdbfe;white-space:nowrap;flex-shrink:0;font-family:monospace;">
                    {{ $item['route'] }}
                </span>
                @endif

                <svg style="width:13px;height:13px;flex-shrink:0;transition:transform 0.2s;"
                    :class="open ? 'rotate-180' : ''"
                    fill="none" stroke="#9ca3af" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            {{-- Expandable body --}}
            <div x-show="open" x-transition style="padding:0 18px 16px 18px;background:#fafafa;border-top:1px solid #f3f4f6;">
                {{-- Competency detail (shown inside expanded body too) --}}
                @if(!empty($komps))
                <div style="display:flex;flex-wrap:wrap;gap:5px;margin:10px 0 8px 0;">
                    @foreach($komps as $kode)
                    <span style="font-size:10px;padding:3px 8px;border-radius:4px;background:#eef2ff;color:#4338ca;border:1px solid #c7d2fe;display:inline-flex;align-items:center;gap:4px;">
                        <svg style="width:10px;height:10px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                        <strong>{{ $kode }}</strong> — {{ $kompMap[$kode] ?? '' }}
                    </span>
                    @endforeach
                </div>
                @endif

                @if(!empty($item['desc']))
                <p style="font-size:12px;color:#6b7280;line-height:1.65;margin:10px 0 12px 0;padding:9px 12px;background:#fff;border-radius:6px;border-left:3px solid #e5e7eb;">
                    💡 {!! $item['desc'] !!}
                </p>
                @endif
                <div style="border-radius:8px;overflow:hidden;border:1px solid #30363d;">
                    <div style="background:#161b22;padding:5px 14px;font-size:10px;color:#6e7681;font-family:monospace;border-bottom:1px solid #21262d;">
                        {{ $item['file'] ?? '' }}
                    </div>
                    <pre style="margin:0;padding:12px 14px;font-family:'Courier New',monospace;font-size:11.5px;color:#e6edf3;line-height:1.7;overflow-x:auto;white-space:pre;background:#0d1117;"><code>{{ $item['code'] ?? '' }}</code></pre>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
