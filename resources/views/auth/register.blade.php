@extends('layouts.default')

@section('title', 'Cadastro - PayNet')

@section('content')
    <form name="formRegister" autocomplete="off">
        @csrf

        <div class="alert alert-danger d-none alertResponse" role="alert"></div>

        <label>Nome: </label>
        <input type="text" name="name" id="name" placeholder="Nome completo" required><br><br>

        <label>e-mail: </label>
        <input type="email" name="email" id="email" required><br><br>

        <label>Senha: </label>
        <input type="password" name="password" id="password" required><br><br>

        <label>Confirmar senha: </label>
        <input type="password" name="password_confirm" id="password_confirm" required><br><br>

        <label>CEP: </label>
        <input type="text" name="zipcode" id="zipcode" required><br><br>
        <label>Rua: </label>
        <input type="text" name="street" id="street" required><br><br>
        <label>Bairro: </label>
        <input type="text" name="neighborhood" id="neighborhood" required><br><br>
        <label>Número: </label>
        <input type="text" name="number" id="number" required><br><br>
        <label>Cidade: </label>
        <input type="text" name="city" id="city" required><br><br>
        <label>Estado: </label>
        <input type="text" name="state" id="state" required><br><br>

        <button type="submit" class="btn btn-lg btn-primary btn-block">Cadastrar</button>
    </form>

    <script>
        $(function() {
            $('form[name="formRegister"]').submit(function(event) {
                event.preventDefault();

                $.ajax({
                    url: "{{ route('api.register') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.success == true) {
                            windows.location.href = "{{ route('home') }}"
                        } else {
                            $('.alertResponse').removeClass('d-none').html(response.message);
                        }
                    }
                });
            });
        });
    </script>
@endsection
