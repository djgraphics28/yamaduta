<head>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    @extends('yamaduta.frontend');
    @section('content')
        <center>
            <h3 class="title" style="padding-top: 80px">ABOUT US</h3>
        </center>
       @livewire('about-us')


    </body>
@endsection
