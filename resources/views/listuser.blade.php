@extends('layouts.app')

@section('content')
<script type="text/javascript">
    $(function() {
        getUser();

        $("#userform").on("submit", function(e) {
            e.preventDefault(); // prevent from submitting form

            if ($('#type').val() == 'edit') {
                var uri = '{{ URL::to('api/listuser') }}/' + $('#id').val();
                var type = 'put';
            } else {
                var uri = '{{ URL::to('api/listuser') }}/';
                var type = 'post';
            }
            
            $.ajax({
                url: uri,
                dataType: 'json',
                type: type,
                data: $(this).serialize(),
                success: function(response) {
                    console.log(response);
                    
                    location.reload();
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });
    });

    function add()
    {
        $('#form').modal('show');
        $('#type').val('add');
        $('#userform')[0].reset();
    }

    function edit(id)
    {
        $('#form').modal('show');
        $('#type').val('edit');

        $.ajax({
            url: '{{ URL::to('api/listuser') }}/' + id,
            dataType: 'json',
            type: 'get',
            success: function(response) {
                // console.log(response);
                $('#name').val(response['data'].name);
                $('#username').val(response['data'].username);
                $('#id').val(response['data'].id);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.textStatus);
            }
        });
        
    }

    function remove(id)
    {
        $.ajax({
            url: '{{ URL::to('api/listuser') }}/' + id,
            dataType: 'json',
            type: 'delete',
            success: function(response) {
                // console.log(response);
                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.textStatus);
            }
        });
    }

    function getUser()
    {
        $.ajax({
            url: '{{ URL::to('api/listuser') }}',
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
                        var username = response[i].username;
                        var name = response[i].name;
                        
                        var table = "<tr>" +
                            "<th scope='row'>" + (i+1) + "</th>" +
                            "<td>" + username + "</td>" +
                            "<td>" + name + "</td>" +
                            "<td>" +
                                "<button type='button' class='btn btn-outline-secondary' onclick='edit("+id+")'>Edit</button>&nbsp;" +
                                "<button type='button' class='btn btn-outline-danger' onclick='remove("+id+")'>Remove</button>" +
                            "</td>" +
                        "</tr>";

                        $('#listuser tbody').append(table);
                    }
                } else {
                    var table = "<tr>" +
                        "<td colspan='4'>No Data</td>" +
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
                <div class="card-header">{{ __('List User') }}</div>

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
                            <th scope="col">Username</th>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">1</th>
                            <td></td>
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

<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="exampleModalLabel">User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form id="userform" name="userform">
            @csrf
            <input type="hidden" id="type" name="type" value="">
            <input type="hidden" id="id" name="id" value="">

            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                <div class="col-md-6">
                    <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">

                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required minlength="8" autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required minlength="8" autocomplete="new-password">
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button id="commit" type="submit" class="btn btn-primary">
                        {{ __('Update') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
    </div>
    </div>
</div>
@endsection
