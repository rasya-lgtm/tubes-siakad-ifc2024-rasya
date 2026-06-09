@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold text-cyan-700">Dashboard SIAKAD UNSUR</h1>
    <p class="mt-2 text-gray-600">Selamat datang, {{ auth()->user()->name }}!</p>
@endsection