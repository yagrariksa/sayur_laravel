<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <style>
        #bg-valid {
            background-image: url(https://source.unsplash.com/1600x900/?vegetables);
            background-position: center;
            background-repeat: no-repeat;
            /* background-attachment: fixed; */
            background-size: 100%;
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: -1;
            filter: opacity(60%);
            /*     display: none; */
        }

        .detail.identitas {
            border-bottom: 1px solid rgb(184, 184, 184);
        }
    </style>
     @yield('css')
     @livewireStyles
</head>

<body>

    <div id="bg-valid"> </div>

    
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Admin</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item {{ ($page == 'transaksi') ? 'active' : ''}}">
                        <a class="nav-link" href="/admin/transaksi/list">Transaksi<span class= "sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item {{ ($page == 'pembayaran') ? 'active' : ''}}">
                        <a class="nav-link" href="/admin/pembayaran/list">Pembayaran</a>
                    </li>
                    <li class="nav-item {{ ($page == 'barang') ? 'active' : ''}}">
                        <a class="nav-link" href="/admin/sayur/list">Sayuran</a>
                    </li>
                    <li class="nav-item {{ ($page == 'pengiriman') ? 'active' : ''}}">
                        <a class="nav-link" href="/admin/pengiriman/list">Pengiriman</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <a href="/logout">
                        <button class="btn btn-danger my-2 my-sm-0" type="button">logout</button>
                    </a>
                </form>
            </div>
        </div>
    </nav>

    <!-- container -->
    @yield('content')
    
    @yield('js')
    @livewireScripts
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
</body>

</html>