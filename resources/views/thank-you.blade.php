@extends('layout/layout-common')

@section('space-work')
    
    <div class="container">
        <div class="text-center">
            <h2 class="mt-3">Terimakasih sudah submit ujian, {{ Auth::user()->name }} </h2>
            <p>bla bla bla</p>
            <a href="/dashboard" class="btn btn-info">Kembali</a>
        </div>
    </div>
@endsection