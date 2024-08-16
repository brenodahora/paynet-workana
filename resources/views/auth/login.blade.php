@extends('layouts.default')

<form name="register" method="POST">
    @csrf

    <label>Nome: </label>
    <input type="text" name="nome" id="nome" placeholder="Nome completo" required><br><br>

    <label>e-mail: </label>
    <input type="email" name="email" id="email" required><br><br>

    <label>Senha: </label>
    <input type="password" name="senha" id="senha" ><br><br>

    <label>Confirmar senha: </label>
    <input type="password" name="confirmacao_senha" id="confirmacao_senha" ><br><br>

    <label>CEP: </label>
    <input type="text" name="cep" id="cep" ><br><br>
    <label>Rua: </label>
    <input type="text" name="rua" id="rua" ><br><br>
    <label>Bairro: </label>
    <input type="text" name="bairro" id="bairro" ><br><br>
    <label>Número: </label>
    <input type="text" name="numero" id="numero" ><br><br>
    <label>Cidade: </label>
    <input type="text" name="cidade" id="cidade" ><br><br>
    <label>Estado: </label>
    <input type="text" name="estado" id="estado" ><br><br>

    <button type="submit">Cadastrar</button>
</form>

<script>
    $(function(){
        $('form[name=""]')
    });
</script>