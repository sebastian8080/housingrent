@extends('adminlte::page')

@section('css')
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<link href="{{ asset('css/admintle-custom.css')}}" rel="stylesheet">
<style>
    body {
        background: url('{{ asset('img/fondo-dashboard.jpg') }}') no-repeat center center fixed;
        background-size: cover;
    }
</style>
@stop


@section('js')
@stop