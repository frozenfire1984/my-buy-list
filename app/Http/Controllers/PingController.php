<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PingController extends Controller
{
    public function ping() {
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function health() {
        return response()->json([
            'db' => 'ok',
            'cache' => 'ok!!!',
        ]);
    }

    public function version() {
        return response()->json([
            'version' => config('app.version'),
        ]);
    }
}
