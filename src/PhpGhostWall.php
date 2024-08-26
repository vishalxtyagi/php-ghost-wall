<?php

namespace Vishalxtyagi\PhpGhostWall;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;

class PhpGhostWall
{
    public function checkIntegrity()
    {
        $phoneHomeFilePath = config('ghostwall.monitored_file_path');
        $expectedHash = config('ghostwall.expected_hash');

        if (hash_file('sha256', $phoneHomeFilePath) !== $expectedHash) {
            $this->alertTampering();
            return false;
        }

        return true;
    }

    public function alertTampering()
    {
        Http::withoutVerifying()->post(config('ghostwall.alert_endpoint'), [
            'message' => 'Tampering detected in monitored file',
            'domain' => request()->getHost(),
        ]);
    }

    public function sendServerInfo()
    {
        $process = Process::fromShellCommandline('git rev-parse HEAD');
        $currentCommitHash = $process->run()->output();

        $serverInfo = [
            'domain' => request()->getHost(),
            'ip' => request()->ip(),
            'server_software' => $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown',
            'php_version' => phpversion(),
            'laravel_version' => app()->version(),
            'commit_hash' => $currentCommitHash,
        ];

        try {
            Http::withoutVerifying()->post(config('ghostwall.monitor_endpoint'), $serverInfo);
        } catch (\Exception $e) {
            Log::error('Failed to send monitoring data: ' . $e->getMessage());
        }
    }
}