<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Soal;
use App\Models\SoalPilihan;

class SoalController extends Controller
{
    public function listsoal()
    {
        return Soal::all();
    }

    public function randomsoal()
    {
        $data = Soal::select('id', 'soal', 'jawaban')->inRandomOrder()->get();

        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

    public function jawaban(Request $request)
    {
        $data = SoalPilihan::select('id', 'pilihan_jawaban')->where('id_soal', $request['id'])->get();

        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        $soal = Soal::create([
            'soal' => $request->soal,
        ]);

        $soal->id;

        return response()->json([
            'success' => true
        ], 200);
    }

    public function show(Request $request)
    {
        $soal = Soal::find($request->id);
        $soal->get();

        return response()->json([
            'success' => true,
            'data' => $soal
        ], 200);
    }

    public function update(Request $request)
    {
        $soal = Soal::find($request->id);
        $soal->update([
            'soal' => $request->soal,
        ]);

        return response()->json([
            'success' => true
        ], 200);
    }

    public function destroy($id)
    {
        Soal::destroy($id);

        return response()->json([
            'success' => true
        ], 200);
    }
}
