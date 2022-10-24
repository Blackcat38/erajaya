<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Soal;
use App\Models\SoalPilihan;

class SoalController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('soal');
    }

    public function create()
    {
        return view('soal_add');
    }

    public function store(Request $request)
    {
        $soal = new Soal;
        $soal->soal = $request['soal'];
        $soal->save();
        $id = $soal->id;

        $jawaban_benar = '';
        for ($i=1; $i <= 4; $i++) { 
            $jawaban = new SoalPilihan;

            $jawaban->id_soal = $id;
            $jawaban->pilihan_jawaban = $request['jawaban_'.$i];
            $jawaban->save();

            if ($request['rdo_jawaban'] == ('jawaban_'.$i)) {
                $id_jawaban = $jawaban->id;
                $jawaban_benar = $id_jawaban;
            }
        }

        $soal->jawaban = $jawaban_benar;
        $soal->save();

        return redirect()->route('soal.index');
    }
    
    public function show($id)
    {

    }

    public function edit($id)
    {
        $data['soal'] = Soal::find($id);
        $data['jawaban'] = SoalPilihan::where('id_soal', $data['soal']->id)->get();

        return view('soal_edit', $data);
    }

    public function update(Request $request, $id)
    {
        $soal = Soal::find($id);
        $soal->soal = $request['soal'];
        $soal->save();

        $jawaban_benar = '';
        SoalPilihan::where('id_soal', $id)->delete();

        for ($i=1; $i <= 4; $i++) { 
            $jawaban = new SoalPilihan;

            $jawaban->id_soal = $id;
            $jawaban->pilihan_jawaban = $request['jawaban_'.$i];
            $jawaban->save();

            if ($request['rdo_jawaban'] == ('jawaban_'.$i)) {
                $id_jawaban = $jawaban->id;
                $jawaban_benar = $id_jawaban;
            }
        }

        $soal->jawaban = $jawaban_benar;
        $soal->save();

        return redirect()->route('soal.index');
    }

    public function destroy($id)
    {

    }
}
