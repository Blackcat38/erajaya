@extends('layouts.app')

@section('content')
<script type="text/javascript">
    $(function() {
        
    });
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Edit Soal') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form id="input" name="input" method="post" action="{{ route('soal.update', ['soal' => $soal->id]) }}">
                    <input type="hidden" name="_method" value="put" />
                        @csrf
                        <div class="form-group">
                          <label for="exampleFormControlTextarea1">Soal</label>
                          <textarea class="form-control" id="soal" name="soal" required rows="3">{{ $soal->soal }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Jawaban</label>                           
                                
                            <div class="col-auto">
                                <label class="sr-only" for="inlineFormInputGroup">a</label>
                                <div class="input-group mb-2">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text">a</div>
                                  </div>
                                  <input type="hidden" id="hdn_id_1" name="hdn_id_1" value="{{ $jawaban[0]->id }}">
                                  <input type="text" class="form-control" id="jawaban_1" name="jawaban_1" required placeholder="a" value="{{ $jawaban[0]->pilihan_jawaban }}">
                                  <input class="form-check-input" type="radio" name="rdo_jawaban" id="rdo_jawaban_1" value="jawaban_1" @if ($soal->jawaban == $jawaban[0]->id) checked @endif>
                                </div>
                            </div>

                            <div class="col-auto">
                                <label class="sr-only" for="inlineFormInputGroup">b</label>
                                <div class="input-group mb-2">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text">b</div>
                                  </div>
                                  <input type="hidden" id="hdn_id_2" name="hdn_id_2" value="{{ $jawaban[1]->id }}">
                                  <input type="text" class="form-control" id="jawaban_2" name="jawaban_2" required placeholder="b" value="{{ $jawaban[1]->pilihan_jawaban }}">
                                  <input class="form-check-input" type="radio" name="rdo_jawaban" id="rdo_jawaban_2" value="jawaban_2" @if ($soal->jawaban == $jawaban[1]->id) checked @endif>
                                </div>
                            </div>
                            <div class="col-auto">
                                <label class="sr-only" for="inlineFormInputGroup">c</label>
                                <div class="input-group mb-2">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text">c</div>
                                  </div>
                                  <input type="hidden" id="hdn_id_3" name="hdn_id_3" value="{{ $jawaban[2]->id }}">
                                  <input type="text" class="form-control" id="jawaban_3" name="jawaban_3" required placeholder="c" value="{{ $jawaban[2]->pilihan_jawaban }}">
                                  <input class="form-check-input" type="radio" name="rdo_jawaban" id="rdo_jawaban_3" value="jawaban_3" @if ($soal->jawaban == $jawaban[2]->id) checked @endif>
                                </div>
                            </div>
                            <div class="col-auto">
                                <label class="sr-only" for="inlineFormInputGroup">d</label>
                                <div class="input-group mb-2">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text">d</div>
                                  </div>
                                  <input type="hidden" id="hdn_id_4" name="hdn_id_4" value="{{ $jawaban[3]->id }}">
                                  <input type="text" class="form-control" id="jawaban_4" name="jawaban_4" required placeholder="d" value="{{ $jawaban[3]->pilihan_jawaban }}">
                                  <input class="form-check-input" type="radio" name="rdo_jawaban" id="rdo_jawaban_4" value="jawaban_4" @if ($soal->jawaban == $jawaban[3]->id) checked @endif>
                                </div>
                            </div>
                          </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a class="btn btn-danger" onclick="window.location.href='{{ route('soal.index') }}'">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
