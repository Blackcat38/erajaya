@extends('layouts.app')

@section('content')
<script type="text/javascript">
    $(function() {
        getData();

    });

    function add()
    {
        window.location.replace("soal/create");
    }

    function edit(id)
    {
        window.location.replace("soal/"+ id +"/edit");
    }

    function remove(id)
    {
        $.ajax({
            url: '{{ URL::to('api/listsoal') }}/' + id,
            dataType: 'json',
            type: 'delete',
            success: function(response) {
                console.log(response);
                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.textStatus);
            }
        });
    }

    function getData()
    {
        $.ajax({
            url: '{{ URL::to('api/listsoal') }}',
            dataType: 'json',
            type: 'get',
            success: function(response) {
                var len = 0;
                $('#listuser tbody').empty();

                if (response != null) {
                    len = response.length;
                }

                if (len > 0) {
                    for (let i = 0; i < len; i++) {
                        var id = response[i].id;
                        var soal = response[i].soal;
                        
                        var table = "<tr>" +
                            "<th scope='row'>" + (i+1) + "</th>" +
                            "<td>" + soal + "</td>" +
                            "<td>" +
                                "<button type='button' class='btn btn-outline-secondary' onclick='edit("+id+")'>Edit</button>&nbsp;" +
                                "<button type='button' class='btn btn-outline-danger' onclick='remove("+id+")'>Remove</button>" +
                            "</td>" +
                        "</tr>";

                        $('#listuser tbody').append(table);
                    }
                } else {
                    var table = "<tr>" +
                        "<td colspan='3'>No Data</td>" +
                    "</tr>";

                    $('#listuser tbody').append(table);
                }

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
                <div class="card-header">{{ __('Soal') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <button type="button" class="btn btn-primary" onclick="add()">Add</button>
                    <p></p>
                    <table class="table table-sm table-hover" id="listuser" name="listuser">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Soal</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">1</th>
                            <td></td>
                            <td>
                                <button type="button" class="btn btn-outline-secondary">Edit</button>
                                <button type="button" class="btn btn-outline-danger">Remove</button>
                            </td>
                          </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
