@extends('adminlte::page')

@section('title', config('app.name'))

@section('content_header')
    @yield('header')
@endsection

@section('navbar')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('profile.edit') }}">
            <i class="fas fa-user-circle fa-lg"></i>
        </a>
    </li>
@endsection

@section('css')
    @parent
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body, h1, h2, h3, h4, h5, h6, p, a, span, td, th, label, input, button, select, textarea {
            font-family: 'Poppins', sans-serif !important;
        }
    .btn-outline-dark:hover {
        background-color: #001f3f !important;
        border-color: #001f3f !important;
        color: white !important;
}
    </style>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('error') }}
        </div>
    @endif
@endsection

@push('js')
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<script>
    $(document).ready(function() {
        $('.logout-link').on('click', function(e) {
            e.preventDefault();
            $('#logout-form').submit();
        });
    });
</script>
@endpush