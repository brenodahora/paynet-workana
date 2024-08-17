@extends('layouts.default')

@section('title', 'Recuperar senha - PayNet')

@section('content')
<div class="container m-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card p-4 shadow-lg">

                <h2 class="text-center">Recuperar Senha</h2>

                <form name="formResetPassword" method="POST" autocomplete="off" class="mt-4">
                    @csrf

                    <div class="alert alert-danger d-none alertResponse" role="alert"></div>

                    <div class="form-group mt-3">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        <button type="submit" class="btn btn-lg btn-primary btn-block center mt-3">Enviar Link</button>
                    </div>

                    <div class="text-center mt-2">
                        <a href="{{ route('login') }}" class="btn btn-link">Voltar para o Login</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('form[name="formResetPassword"]').submit(function(event) {
            event.preventDefault();

            $.ajax({
                url: "{{ route('password.email') }}",
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('.alertResponse').removeClass('d-none alert-danger').addClass('alert-success').html(response.message);
                        $('form[name="formResetPassword"]').trigger('reset');
                    } else {
                        $('.alertResponse').removeClass('d-none alert-success').addClass('alert-danger').html(response.message);
                    }
                },
                error: function(xhr) {
                    $('.alertResponse').removeClass('d-none alert-success').addClass('alert-danger').html('Ocorreu um erro ao enviar a solicitação. Verifique o e-mail informado.');
                }
            });
        });
    });
</script>
@endsection
