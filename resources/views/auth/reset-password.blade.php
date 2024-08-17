@extends('layouts.default')

@section('title', 'Redefinir senha - PayNet')

@section('content')
    <div class="container m-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card p-4 shadow-lg">

                    <h2 class="text-center">Redefinição de senha</h2>

                    <form name="formResetPassword" autocomplete="off" class="mt-4">
                        @csrf

                        <div class="alert alert-danger d-none alertResponse" role="alert"></div>

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group mt-3">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mt-3 pb-2">
                                <div data-mdb-input-init class="form-outline">
                                    <label for="password">Nova senha</label>
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

                        <div class="d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-lg btn-primary btn-block center mt-3">Redefinir</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            $('form[name="formResetPassword"]').submit(function(event) {
                event.preventDefault();

                $.ajax({
                    url: "{{ route('password.update') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            window.location.href = "{{ route('login') }}";
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
