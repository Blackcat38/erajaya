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
                <div class="card-header">{{ __('Tambah Baru Soal') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form id="input" name="input" method="POST" action="{{ route('soal.store') }}">
                        @csrf
                        <div class="form-group">
                          <label for="exampleFormControlTextarea1">Soal</label>
                          <textarea class="form-control" id="soal" name="soal" required rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Jawaban</label>
                            <div class="col-auto">
                                <label class="sr-only" for="inlineFormInputGroup">a</label>
                                <div class="input-group mb-2">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text">a</div>
                                  </div>
                                  <input type="text" class="form-control" id="jawaban_1" name="jawaban_1" required placeholder="a">
                                  <input class="form-check-input" type="radio" name="rdo_jawaban" id="rdo_jawaban_1" value="jawaban_1">
                                </div>
                            </div>
                            <div class="col-auto">
                                <label class="sr-only" for="inlineFormInputGroup">b</label>
                                <div class="input-group mb-2">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text">b</div>
                                  </div>
                                  <input type="text" class="form-control" id="jawaban_2" name="jawaban_2" required placeholder="b">
                                  <input class="form-check-input" type="radio" name="rdo_jawaban" id="rdo_jawaban_2" value="jawaban_2" checked>
                                </div>
                            </div>
                            <div class="col-auto">
                                <label class="sr-only" for="inlineFormInputGroup">c</label>
                                <div class="input-group mb-2">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text">c</div>
                                  </div>
                                  <input type="text" class="form-control" id="jawaban_3" name="jawaban_3" required placeholder="c">
                                  <input class="form-check-input" type="radio" name="rdo_jawaban" id="rdo_jawaban_3" value="jawaban_3">
                                </div>
                            </div>
                            <div class="col-auto">
                                <label class="sr-only" for="inlineFormInputGroup">d</label>
                                <div class="input-group mb-2">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text">d</div>
                                  </div>
                                  <input type="text" class="form-control" id="jawaban_4" name="jawaban_4" required placeholder="d">
                                  <input class="form-check-input" type="radio" name="rdo_jawaban" id="rdo_jawaban_4" value="jawaban_4">
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
