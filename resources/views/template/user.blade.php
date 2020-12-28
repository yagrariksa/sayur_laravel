<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    @yield('css')

    <style>
        #bodykeranjang {
            position: fixed;
            right: 100px;
            top: 50px;
            bottom: 50px;
            overflow-y: scroll;
            border-radius: 10px;
            border: solid 5px white;
        }

        #btntutupkeranjang {
            display: none;
        }

        .barangsatuan {
            border-bottom: 1px solid black;
            max-height: 150px;
        }

        .gambarsatuan {
            max-height: 130px;
        }

        @media only screen and (max-width: 800px) {
            #bodykeranjang {
                right: 0;
            }

            #btntutupkeranjang {
                display: block;
                position: fixed;
                top: 10px;
                right: 10px;
            }
        }

    </style>
</head>

<body>
    <!-- navbar  -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">

            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <button class="btn btn-danger my-2 my-sm-0" id="btnkeranjang" type="button">Keranjang</button>
                </form>
            </div>
        </div>

    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <!-- container -->
                @yield('content')
            </div>

            <!-- keranjang -->
            {{-- @livewire('cart') --}}
            <div class="col-lg-5 col-md-6 col-sm-9 py-3" id="bodykeranjang"
                style="background-color: rgb(216, 216, 216);">

                <span id="btntutupkeranjang" class="btn btn-danger">X</span>
                <!-- title keranjang -->
                <div class="row mb-3">
                    <div class="col text-center">
                        <p class="h3"><strong>Keranjang Belanja</strong></p>
                    </div>
                </div>

                @if ($cart == null)
                    <div class="row mb-3">
                        <div class="col text-center">
                            <p class="h1"><strong>EMPTY</strong></p>
                        </div>
                    </div>
                @else

                    <!-- barang satuan -->
                    <?php $count = 0;
                    // dd($cart->items);
                    ?>

                    @foreach ($cart->items as $item)
                        <div class="row mb-3 barangsatuan">
                            <div class="col-4">
                                <img src="https://source.unsplash.com/random/600x600" alt="..."
                                    class="img-thumbnail gambarsatuan img-fluid">
                            </div>
                            <div class="col pt-3">
                                <p><strong>{{ $item->nama_barang }}</strong></p>
                                <p>Rp {{ $item->harga_barang }} x {{ $item->jumlah_beli }}</p>
                                <p><strong>Rp {{ $item->subtotal }}</strong></p>
                            </div>
                            <div class="col pt-3">

                                <form action="/removefromcart/{{ $count }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                        <?php $count++; ?>

                    @endforeach

                    <!-- total harga -->
                    <div class="row my-3">
                        <div class="col text-right">
                            <p class="h3">Total Pembelian {{ $cart->qty }} item<br><strong>Rp
                                    {{ $cart->total }}</strong>
                            </p>
                        </div>
                    </div>

                    <!-- tombol checkout -->
                    <div class="row justify-content-end">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-success mr-4 " data-toggle="modal"
                            data-target="#staticBackdrop">
                            Checkout
                        </button>
                    </div>



                @endif

            </div>

        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="checkout" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="inputname">Nama Pembeli</label>
                            <input name="name" type="text" class="form-control" id="inputname">
                        </div>
                        <div class="form-group">
                            <label for="inputalamat">Alamat Pembeli</label>
                            <textarea name="address" class="form-control" id="inputalamat" rows="3"></textarea>
                        </div>

                        <!-- pilih metode pembayaran -->
                        <div class="form-group">
                            <label for="inputpembayaran">Metode Pembayaran</label>
                            <select name="payment" class="form-control" id="inputpembayaran">
                                <option value="OVO">OVO</option>
                                <option value="GOPAY">Go-Pay</option>
                            </select>
                        </div>

                        <!-- pilih metode pembayaran -->
                        <div class="form-group">
                            <label for="inputpembayaran">Dalam Kota Surabaya</label>
                            <select name="city" class="form-control" id="inputpembayaran">
                                <option value="true">Dalam Kota</option>
                                <option value="false">Luar Kota</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Checkout</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    @yield('js')
    <script>
        const bodyKeranjang = document.querySelector('#bodykeranjang');
        const btnkeranjang = document.querySelector('#btnkeranjang');
        const btntutupkeranjang = document.querySelector('#btntutupkeranjang');
        var statuskeranjang = "";

        hidekeranjang(true);

        btntutupkeranjang.addEventListener('click', () => {
            hidekeranjang(true);
        })
        btnkeranjang.addEventListener('click', () => {
            if (statuskeranjang == "sembunyi") {
                hidekeranjang(false)
            } else {
                hidekeranjang(true)
            }
        })

        function hidekeranjang(boolean) {
            if (boolean) {
                bodyKeranjang.style.display = 'none';
                statuskeranjang = "sembunyi";
                btnkeranjang.innerHTML = "Tampilkan Keranjang";
                btnkeranjang.classList.toggle("btn-success");
                btnkeranjang.classList.toggle("btn-danger");
            } else {
                bodyKeranjang.style.display = 'block';
                statuskeranjang = "tampil";
                btnkeranjang.innerHTML = "Sembunyikan Keranjang";
                btnkeranjang.classList.toggle("btn-success");
                btnkeranjang.classList.toggle("btn-danger");
            }
        }

    </script>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>


</body>

</html>