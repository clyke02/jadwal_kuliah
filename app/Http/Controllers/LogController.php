<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogController extends Controller
{
    protected string $logPath;

    public function __construct()
    {
        $this->logPath = storage_path('logs/laravel.log');
    }

    public function index()
    {
        return view('logs.index');
    }

    public function fetch(Request $request)
    {
        if (!file_exists($this->logPath)) {
            return response()->json(['entries' => [], 'size' => 0]);
        }

        clearstatcache(true, $this->logPath);
        $currentSize = filesize($this->logPath);
        $lastSize    = (int) $request->query('size', 0);

        if ($lastSize > $currentSize) {
            $lastSize = 0;
        }

        $entries = [];

        if ($lastSize === 0 && $currentSize > 0) {
            // Pertama load: ambil 200 entri terakhir
            $readSize = min($currentSize, 200 * 1024);
            $offset   = $currentSize - $readSize;
            $handle   = fopen($this->logPath, 'r');
            fseek($handle, $offset);
            $content = fread($handle, $readSize);
            fclose($handle);
            $entries = $this->parse($content);
            $entries = array_slice($entries, -200);
        } elseif ($currentSize > $lastSize) {
            $handle = fopen($this->logPath, 'r');
            fseek($handle, $lastSize);
            $content = fread($handle, $currentSize - $lastSize);
            fclose($handle);
            $entries = $this->parse($content);
        }

        return response()->json(['entries' => $entries, 'size' => $currentSize]);
    }

    protected function parse(string $content): array
    {
        $entries = [];
        $lines   = explode("\n", $content);
        $current = null;

        foreach ($lines as $line) {
            if (preg_match('/^\[(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\] (\w+)\.(\w+): (.*)/', $line, $m)) {
                if ($current !== null) {
                    $entries[] = $current;
                }
                $current = [
                    'timestamp' => $m[1],
                    'env'       => $m[2],
                    'level'     => strtoupper($m[3]),
                    'message'   => trim($m[4]),
                    'trace'     => '',
                ];
            } elseif ($current !== null) {
                $current['trace'] .= $line . "\n";
            }
        }

        if ($current !== null) {
            $current['trace'] = rtrim($current['trace']);
            $entries[] = $current;
        }

        return $entries;
    }

    public function clear()
    {
        if (file_exists($this->logPath)) {
            file_put_contents($this->logPath, '');
            clearstatcache(true, $this->logPath);
        }

        return response()->json(['ok' => true]);
    }
}
