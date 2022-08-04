@extends('master.admin.master')

@section('title','Dashboard')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="user/img/img-6.jpeg" class="d-block w-100" height="500px" width="100%" alt="...">
            </div>
            <div class="carousel-item">
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
    </section>
@endsection

@section('script')
    <script>
        $('#dashboard').removeClass('collapsed');
    </script>
@endsection