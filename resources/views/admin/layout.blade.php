@extends('layouts.app')

@push('scripts')
    <script src="{{ asset('js/admin.js') }}"></script>
    <script defer src="{{ url('https://use.fontawesome.com/releases/v5.3.1/js/all.js') }}" integrity="sha384-kW+oWsYx3YpxvjtZjFXqazFpA7UP/MbiY4jvs+RWZo2+N94PFZ36T6TFkc9O3qoB" crossorigin="anonymous"></script>
@endpush

@push('styles')
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ url('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,800,800i,900,900i') }}}" rel="stylesheet">
@endpush

@section('body')
    @include('admin.components.notifications.success')
    @include('admin.components.notifications.error')

    <div class="container">
        <div class="row">
            <div class="col-md-3 sidebar">
                @include('admin.components.layout.sidebar')
            </div>
            <div class="col-md-9 content">
                @yield('content')
            </div>
        </div>
    </div>
@endsection