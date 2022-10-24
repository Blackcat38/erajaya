@extends('layouts.app')

@section('content')
<script type="text/javascript">
    $(function() {
        getData();

        $("#input").on("submit", function(e) {
            e.preventDefault(); // prevent from submitting form
            
            $.ajax({
                url: '{{ URL::to('api/timer/update') }}',
                dataType: 'json',
                type: 'put',
                data: $(this).serialize(),
                success: function(response) {
                    console.log(response);
                    alert('berhasil diupdate');
                    
                    // location.reload();
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });
    });

    function getData()
    {
        $.ajax({
            url: '{{ URL::to('api/timer') }}',
            dataType: 'json',
            type: 'get',
            success: function(response) {
                console.log(response);
                $('#timer').val(response.quiz_timer);

                // console.log(response.length);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.textStatus);
            }
        });
    }
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Timer') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form id="input" name="input" method="post" action="">
                    <input type="hidden" name="_method" value="put" />
                        @csrf
                        <div class="form-group">
                          <label for="exampleFormControlTextarea1">Timer</label>
                          <input class="form-control" type="number" name="timer" id="timer" placeholder="0" min="15" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
