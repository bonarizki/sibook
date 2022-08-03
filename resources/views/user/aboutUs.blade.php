@extends('master.user.master')

@section('title','Status')

@section('css')
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
@endsection

@section('content')
<section class="py-5 text-center container">
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light">WOTISH</h1>
            <h1 class="fw-light">COFFE & EATERY</h1>
            <p class="lead text-muted">@auth Hi, {{ Auth::user()->name }} @endauth this is your history order</p>
        </div>
    </div>
</section>


<div class="album py-2 bg-light">
    <div class="container">
        <div class="row">
            <div class="col">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="user/img/img-1.jpeg" class="d-block w-100" height="500px" width="100%" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="user/img/img-2.jpeg" class="d-block w-100" height="500px" width="100%" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="user/img/img-3.jpeg" class="d-block w-100" height="500px" width="100%" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="user/img/img-4.jpeg" class="d-block w-100" height="500px" width="100%" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15865.422169740188!2d106.7711639!3d-6.2167563!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xeb15445cf73fc8d3!2sWotish%20Cafe!5e0!3m2!1sid!2sid!4v1659550667489!5m2!1sid!2sid" width="100%" height="500px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col">
                <h2 class="text-center">About Us</h2>
                <span>
                    Sebelum terbentuknya Wotish Cafe berawal dari sang pemilik yang mempunyai sebuah kebiasaan yang biasa di lakukan oleh para kaula muda saat ini yakni senang berkunjung ke coffee shop yang sangat kekinian. Dan seiring berkembangnya Era modern saat ini, sering kali seseorang membutuhkan pelayanan yang semakin lama semakin komplek dan tidak ada habisnya dan dengan melihat hal itu pemilik kafe berfikir menjadikan hal tersebut dapat menjadi peluang usaha nya sendiri dengan penuh kretifitas seorang pemuda yang ingin terjun langsung dalam dunia kuliner yakni membangun sendiri bidang usaha yang saat ini seringkali di cari oleh pemuda yang berkembang di era digital saat ini. Dan di samping Usahanya yang kini kian di gandrungi banyaknya pelanggan, Sebuah niat positif dari  
                    pemilik Wotish Cafe juga memiliki sebuah ide Positif di masa pandemi yang mana pemilik kedai kopi wotish itu juga ingin menciptakan lapangan pekerjaan bagi para pengangguran yang kesulitan mencari kerja di masa pandemi yang terbilang baru saat itu. <br><br>
                    Wotish Cafe berdiri pada tanggal 20 Desember 2020, yang bertempatan di daerah Jl. Raya Pos Pengumben (Komplek Bulog) Blok I/4 Kebon Jeruk, RT.5/RW.6, Sukabumi, Selatan, Kota Jakarta Barat, DKI Jakarta , dengan penanggung jawab atas nama Muhammad Natsir Satria selaku pemilik Wotish Cafe. Bangunannya pun mempunyai design yang amat sederhana seperti rumah yang di penuhi oleh berbagai macam jenis tumbuhan yang dapat menciptakan suasana seperti di kebun rumah. Dan di bagian bar memiliki sebuah design tradisional berbahan kayu, selain itu di Wotish Cafe juga memberikan fasilitas wifi serta memberikan tempat untuk para pelanggan mengisi daya gadget. Jam buka operasional Wotish Cafe yaitu dari pukul 09.30 wib hingga pukul 01.00 wib.
                </span>
            </div>
        </div>
    </div>

</div>

@endsection

