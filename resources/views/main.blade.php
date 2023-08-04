<!DOCTYPE html>

@include('layouts._head')
<body>

@include('layouts._nav')

<div id="app" class="container">
    @include('layouts._messages')
    @yield('content')
    @include('layouts._footer')
</div>
@include('layouts._javascript')
{{--  <script src="/js/app.js"></script>  --}}
@yield('scripts')
</body>
</html>
