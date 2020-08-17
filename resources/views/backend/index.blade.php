@extends('layouts.backend.master')

@section('csspage')
    <style>
        .toast {
            opacity: 0.9 !important;
        }
    </style>
@endsection

@section('content')


    <app-backend></app-backend>


@endsection

@section('page-scripts')
    <script>
        //        swal({
        //            title: "Olá!",
        //            text: "Espero que esteja pronto para esta plataforma!",
        //            type: "warning",
        //            confirmButtonText: "Estou",
        ////            animation: false,
        //        });


    </script>

@endsection