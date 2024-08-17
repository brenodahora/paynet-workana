$(document).ready(function () {
    const token = localStorage.getItem('auth_token');

    if (token) {
        $('#nav-logout').removeClass('d-none');
        $('#nav-login').addClass('d-none');
        $('#nav-register').addClass('d-none');
    } else {
        $('#nav-login').removeClass('d-none');
        $('#nav-register').removeClass('d-none');
        $('#nav-logout').addClass('d-none');
    }
});