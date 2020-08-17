@extends('layouts.backend.master')

@section('csspage')

@endsection

@section('content')

    <aton-admin-usuarios></aton-admin-usuarios>

@endsection
@section('page-scripts')
    <script>
        swal({
            title: "Olá!",
            text: "Espero que esteja pronto para esta plataforma!",
            type: "warning",
            confirmButtonText: "Estou",
            //            animation: false,
        });
    </script>
@endsection