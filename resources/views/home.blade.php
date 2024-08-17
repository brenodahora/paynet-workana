@extends('layouts.default')

@section('content')

<div class="container mt-5">
    <h2 class="text-center mb-4">Lista de Usuários</h2>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>CEP</th>
                    <th>Rua</th>
                    <th>Bairro</th>
                    <th>Número</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody id="user-tbody">
            </tbody>
        </table>
    </div>
</div>

    <script>
        $(document).ready(function() {
            const token = localStorage.getItem('auth_token');

            if (token) {
                $.ajax({
                    url: "{{ route('api.users') }}",
                    type: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + token
                    },
                    success: function(users) {
                        const userTbody = $('#user-tbody');
                        userTbody.empty(); // Limpa qualquer dado existente

                        // Adiciona uma linha para cada usuário
                        users.forEach(user => {
                            userTbody.append(`
                                <tr>
                                    <td>${user.name}</td>
                                    <td>${user.email}</td>
                                    <td>${user.zipcode}</td>
                                    <td>${user.street}</td>
                                    <td>${user.neighborhood}</td>
                                    <td>${user.number}</td>
                                    <td>${user.city}</td>
                                    <td>${user.state}</td>
                                </tr>
                            `);
                        });
                    },
                    error: function(xhr) {
                        console.error('Erro ao buscar a lista de usuários:', xhr.responseText);
                        localStorage.removeItem('auth_token');
                        window.location.href = "{{ route('login') }}";
                    }
                });
            } else {
                window.location.href = "{{ route('login') }}";
            }
        });
    </script>
@endsection
