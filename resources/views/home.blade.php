@extends('layouts.default')

<script>
    $(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('auth_token')
        }
    });
});
</script>
