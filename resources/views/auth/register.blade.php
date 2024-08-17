@extends('layouts.default')

@section('title', 'Cadastro - PayNet')

@section('content')
    <div class="container m-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card p-4 shadow-lg">

                    <h2 class="text-center">Cadastro de Usuário</h2>

                    <form name="formRegister" autocomplete="off" class="mt-4">
                        @csrf

                        <div class="alert alert-danger d-none alertResponse" role="alert"></div>

                        <div class="form-group mt-3">
                            <label for="name">Nome</label>
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="Nome completo" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mt-3 pb-2">
                                <div data-mdb-input-init class="form-outline">
                                    <label for="password">Senha</label>
                                    <input type="password" name="password" id="password" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6 mt-3 pb-2">
                                <div data-mdb-input-init class="form-outline">
                                    <label for="password_confirmation">Confirmar senha</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mt-3">
                                    <label for="zipcode">CEP</label>
                                    <input type="text" name="zipcode" id="zipcode" class="form-control" placeholder="00000-000" required>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group mt-3">
                                    <label for="number">Número</label>
                                    <input type="text" name="number" id="number" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <label for="street">Rua</label>
                            <input type="text" name="street" id="street" class="form-control" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="neighborhood">Bairro</label>
                            <input type="text" name="neighborhood" id="neighborhood" class="form-control" required>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mt-3">
                                    <label for="city">Cidade</label>
                                    <input type="text" name="city" id="city" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mt-3">
                                    <label for="state">Estado</label>
                                    <input type="text" name="state" id="state" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-lg btn-primary btn-block center mt-3">Cadastrar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            $('#zipcode').mask('00000-000');

            $('#zipcode').on('keyup', function() {
                var cleanedZipcode = $(this).cleanVal();

                if (cleanedZipcode.length === 8) {
                    $.ajax({
                        url: "{{ route('api.viacep') }}",
                        type: 'POST',
                        data: {
                            zipcode: cleanedZipcode
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                $('#street').val(response.address.street);
                                $('#neighborhood').val(response.address.neighborhood);
                                $('#city').val(response.address.city);
                                $('#state').val(response.address.state);
                            } else {
                                $('.alertResponse').removeClass('d-none').html(response
                                    .message);
                            }
                        },
                        error: function(response) {
                            $('.alertResponse').removeClass('d-none').html(response.responseJSON
                                .message);
                        },
                    });
                }
            });

            $('form[name="formRegister"]').submit(function(event) {
                event.preventDefault();

                $.ajax({
                    url: "{{ route('api.register') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            localStorage.setItem('auth_token', response.token);
                            window.location.href = "{{ route('home') }}";
                        } else {
                            $('.alertResponse').removeClass('d-none').html(response.message);
                        }
                    },
                    error: function(response) {
                        $('.alertResponse').removeClass('d-none').html(response.responseJSON
                            .message);
                    },
                });
            });
        });
    </script>
@endsection
