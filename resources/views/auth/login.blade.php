@extends('layouts.default')

@section('title', 'Cadastro - PayNet')

@section('content')
    <div class="container m-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card p-4 shadow-lg">

                    <h2 class="text-center">Login</h2>

                    <form name="formLogin" autocomplete="off" class="mt-4">
                        @csrf

                        <div class="alert alert-danger d-none alertResponse" role="alert"></div>

                        <div class="form-group mt-3">
                            <label for="email">e-mail</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>

                        <div class="form-group mt-3">
                                <label for="password">Senha</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-lg btn-primary btn-block center mt-3">Entrar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            $('form[name="formLogin"]').submit(function(event) {
                event.preventDefault();

                $.ajax({
                    url: "{{ route('api.login') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
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
