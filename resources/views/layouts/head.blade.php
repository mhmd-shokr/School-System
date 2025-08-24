<!-- Title -->
<title>@yield("title")</title>

<!-- Favicon -->
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon-16x16.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="48x48" href="{{ asset('assets/images/favicon-48x48.png') }}">
<link rel="icon" type="image/png" sizes="64x64" href="{{ asset('assets/images/favicon-64x64.png') }}">
<link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

<!-- Font -->
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">
@yield('css')
<!--- Style css -->
<link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet">

<!--- Style css -->
@if (App::getLocale() == 'en')
    <link href="{{ URL::asset('assets/css/ltr.css') }}" rel="stylesheet">
@else
    <link href="{{ URL::asset('assets/css/rtl.css') }}" rel="stylesheet">
@endif
