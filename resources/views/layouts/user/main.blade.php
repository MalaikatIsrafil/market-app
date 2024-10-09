<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
    <!-- mobile specific meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/templates/user/img/fav.png') }}">

    <!-- author meta -->
    <meta name="author" content="CodePixar">

    <!-- meta deskripsi -->
    <meta name="description" content="">

    <!-- meta keyword -->
    <meta name="keywords" content="">

    <!-- meta character set -->
    <meta charset="UTF-8">

    <!--site title -->
    <title>Merch Store</title>

    @include('layouts.user.style')
    
</head>
<body>
    @include('sweetalert::alert')
    
    @include('layouts.user.navbar')

    @yield('content')

    @include('layouts.user.footer')

    @include('layouts.user.script')
</body>
</html>