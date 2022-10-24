<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Timer;

class TimerController extends Controller
{
    public function timer()
    {
        return Timer::first();
    }   

    public function update(Request $request)
    {
        $timer = Timer::first()->update(['quiz_timer' => $request->timer]);

        return response()->json([
            'success' => true
        ], 200);
    }
}
