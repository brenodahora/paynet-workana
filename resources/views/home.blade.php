@extends('layouts.default')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Lista de Usuários Cadastrados</h2>
        <div class="table-responsive">
            <table class="table-striped table-bordered table">
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
        <div id="pagination" class="d-flex justify-content-center mt-4">
        </div>
    </div>

    <script>
        // Se o usuário possuir um token no local storage, então fazer tentativa de busca de usuários, se falhar, então logar
        $(document).ready(function() {
            const token = localStorage.getItem('auth_token');

            function loadUsers(page = 1) {
                $.ajax({
                    url: `{{ route('api.users') }}?page=${page}`,
                    type: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + token
                    },
                    success: function(response) {
                        const userTbody = $('#user-tbody');
                        const pagination = $('#pagination');

                        userTbody.empty();
                        pagination.empty();

                        response.data.forEach(user => {
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

                        if (response.prev_page_url) {
                            pagination.append(`
                            <button class="btn btn-primary me-2" id="prev-btn" data-page="${response.current_page - 1}">
                                Anterior
                            </button>
                        `);
                        }

                        if (response.next_page_url) {
                            pagination.append(`
                            <button class="btn btn-primary ml-2" id="next-btn" data-page="${response.current_page + 1}">
                                Próximo
                            </button>
                        `);
                        }
                    },
                    error: function(xhr) {
                        localStorage.removeItem('auth_token');
                        window.location.href = "{{ route('login') }}";
                    }
                });
            }

            loadUsers();

            $('#pagination').on('click', '#prev-btn', function() {
                const page = $(this).data('page');
                loadUsers(page);
            });

            $('#pagination').on('click', '#next-btn', function() {
                const page = $(this).data('page');
                loadUsers(page);
            });
        });
    </script>
@endsection
