@include('parts.unauth-header')

@if (session()->has('message'))
    {{ session('message') }}
@endif

@yield('content')

@include('parts.footer')
