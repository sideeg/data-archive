
<head>
    {{-- <meta charset="utf-8"> --}}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    {{-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Pharmacy @yield('title')</title><!-- change this title for each page -->
    {{--bootstrap--}}
     <link rel="stylesheet" href="{{ URL::asset('css/styles.css') }}">
    <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
   <!-- <link rel="stylesheet" href=" bootstrap-offline/css/bootstrap.css ">
	<script src="bootstrap-offline/js/jquery-3.6.0.js"></script>
    <script src="bootstrap-offline/js/bootstrap.js"></script> -->
    
    @yield('stylesheets')
</head>
