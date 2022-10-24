@extends('layouts.app')

@section('content')
<script type="text/javascript">
    var counter = 0;
    const soal = [];
    const jawaban = [];
    const client_jawab = [];

    $(function() {
        $('.badge').hide();

        $("#start").click(function(){
            startTimer();
            getSoal();
        }); 
    });

    function startTimer()
    {
        $.ajax({
            url: '{{ URL::to('api/timer') }}',
            dataType: 'json',
            type: 'get',
            success: function(response) {
                var times = response.quiz_timer * 60;
                var timer = times, minutes, seconds;
                setInterval(function () {
                    minutes = parseInt(timer / 60, 10);
                    seconds = parseInt(timer % 60, 10);

                    minutes = minutes < 10 ? "0" + minutes : minutes;
                    seconds = seconds < 10 ? "0" + seconds : seconds;

                    $('.badge').html(minutes + ":" + seconds);

                    if (--timer < 0) {
                        // timer = times;
                        clearInterval();
                        done();
                    }
                    // console.log(timer);
                }, 1000);
            },
            error: function(response) {
                console.log(response);
            }
        });

        $('.badge').show();
    }

    function getSoal()
    {
        $.ajax({
            async: false,
            url: '{{ URL::to('api/randomsoal') }}',
            dataType: 'json',
            type: 'get',
            success: function(response) {
                // console.log(response);
                for (let i = 0; i < response.data.length; i++) {
                    soal.push(response.data[i]);

                    var id = response.data[i].id;
                    // Get jawaban
                    $.ajax({
                        async: false,
                        url: '{{ URL::to('api/jawaban') }}',
                        dataType: 'json',
                        type: 'get',
                        data: { id:id },
                        success: function(responses) {
                            jawaban.push(responses.data);
                            
                            // console.log(responses.data);
                        },
                        error: function(responses) {
                            console.log(responses);
                        }
                    });
                }
            },
            error: function(response) {
                console.log(response);
            }
        });

        createHTML();
    }

    function createHTML()
    {
        var html = '';

        html += '<div id="" name""><div class="alert alert-info" role="alert">'
                + soal[counter].soal + '</div>';
        
        for (let i = 0; i < jawaban[counter].length; i++) {
            html += '<div class="form-check">'
             + '<input checked class="form-check-input" type="radio" name="rdo_jawaban" id="rdo_jawaban_' + i + '" value="' + jawaban[counter][i].id + '">'
             + '<label class="form-check-label" for="rdo_jawaban">'
             + jawaban[counter][i].pilihan_jawaban + '</label></div>';
            
        }

        html += '<div class="col-md-12 text-center">';

        if ((counter+1) == soal.length) {
            html += '<button type="button" class="btn btn-primary" onclick="done()">Selesai</button>';
        } else {
            html += '<button type="button" class="btn btn-primary" onclick="next()">Selanjutnya</button>';
        }

        html += '</div>';

        $('#loadcontent').html(html);
    }

    function next()
    {
        saveClientAnswer();
        counter++;
        createHTML();
    }

    function done()
    {
        saveClientAnswer();
        calculateScore();
    }

    function scorepage(value)
    {
        $('.badge').hide();
        var html = '';

        html += '<div class="jumbotron jumbotron-fluid"><div class="container">'
             + '<h1 class="display-4">' + value + '</h1>'
             + '<p class="lead">Berikut adalah score anda.</p>'
             + '</div></div>';

        $('#loadcontent').html(html);
    }

    function saveClientAnswer()
    {
        client_jawab.push($("input[name='rdo_jawaban']:checked").val());
    }

    function calculateScore()
    {
        var total_soal = soal.length;
        var nilai_per_soal = (parseInt(100) / parseInt(total_soal));
        var nilai_client = parseFloat(0);

        for (let i = 0; i < soal.length; i++) {
            if (soal[i].jawaban == client_jawab[i]) {
                nilai_client += parseFloat(nilai_per_soal);
            }
        }

        if (nilai_client > 100)
            nilai_client = parseFloat(nilai_client).toFixed(2);

        return scorepage(parseFloat(nilai_client).toFixed(2));
    }
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Home') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    
                    <div id="timer" class="text-right"><h2><span class="badge badge-secondary"></span></h2></div>
                    <div id="loadcontent" name="lodacontent">
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Well done!</h4>
                            <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                            <hr>
                            <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
                        </div>

                        <button id="start" name="start" type="button" class="btn btn-primary btn-lg btn-block">Mulai</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
