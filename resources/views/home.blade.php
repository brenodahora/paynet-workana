@extends('layouts.default')

@section('content')
    <div id="user-list">

    </div>

    <script>
        $(document).ready(function() {
            const token = localStorage.getItem('auth_token');

            if (token) {
                $.ajax({
                    url: "{{ route('api.user') }}",
                    type: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + token
                    },
                    success: function(userData) {
                        // O token é válido, agora requisitar a lista de usuários
                        $.ajax({
                            url: "{{ route('api.users') }}",
                            type: 'GET',
                            headers: {
                                'Authorization': 'Bearer ' + token
                            },
                            success: function(users) {
                                // Exibir a lista de usuários
                                const userListElement = $('#user-list');
                                userListElement.html(users.map(user =>
                                    `<p>${user.name}</p>`).join(''));
                            },
                            error: function(xhr) {
                                console.error('Erro ao buscar a lista de usuários:', xhr
                                    .responseText);
                                localStorage.removeItem('auth_token');
                                window.location.href = "{{ route('login') }}";
                            }
                        });
                    },
                    error: function(xhr) {
                        console.error('Erro ao validar o token:', xhr.responseText);
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
