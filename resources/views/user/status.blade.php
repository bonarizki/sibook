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
        @forelse ($orders as $order)
        <div class="row">
            <div class="card shadow mb-5">
                <div class="card-header">
                    Booking Code - {{ $order->booking_code }}
                </div>
                <div class="card-body">
                    <h5 class="card-title">Booking Detail</h5>
                    <p class="card-text">Table No : <i>{{ $order->Table->table_name }} - {{ $order->Table->table_code }}</i></p>
                    <p class="card-text">Seats : <i>{{ $order->seats }}</i></p>
                    <p class="card-text">Status Order : <i>{{ $order->status }} </i>
                        @if ($order->status == 'booking')
                            <button class="btn btn-primary btn-sm" onclick="upload('{{ $order->id }}')"> Upload Payment </button>
                        @endif
                    </p>
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#detail-menu-{{ $order->id }}" aria-expanded="false"
                                    aria-controls="detail-menu-{{ $order->id }}">
                                    Show Detail Menu
                                </button>
                            </h2>
                            <div id="detail-menu-{{ $order->id }}" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <h3>Menu</h3>
                                    <table class="table table-striped table-hover table-bordered">
                                        <thead>
                                            <tr class="table-primary">
                                                <td>Menu</td>
                                                <td>Qty</td>
                                                <td>Price</td>
                                                <td>SubTotal</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total = 0
                                            @endphp
                                            @foreach ($order->Detail as $menu)
                                            @php
                                                $total = ($menu->Menu->price * $menu->qty) + $total;
                                            @endphp
                                            <tr>
                                                <td>{{ $menu->Menu->menu_name}}</td>
                                                <td>{{ $menu->qty}}</td>
                                                <td>Rp. {{number_format($menu->Menu->price,2,",",'.')}}</td>
                                                <td>Rp. {{number_format($menu->Menu->price * $menu->qty,2,",",'.')}}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <h3><i>Total : <b id="total">Rp. {{number_format($total,2,",",'.')}}</b></i></h3>
                                    <h3><i>Total DP : <b id="total_dp">Rp. {{number_format(($total / 2),2,",",'.')}}</b></i></h3>
                                </div>
                                <div class="row">
                                    <div class="span text-danger">
                                        Estimasi Waktu Pembayaran Reservasi Selama 5-10 Menit. Jika, Lebih Dari Waktu Yang Ditentukan Maka Akan Hangus
                                    </div>
                                    <div class="span text-danger">
                                        Silahkan Transfer Ke Rekening BCA 7550370977 A.N Muhammad Natsir Satria Wibowo
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <h1 class="d-flex justify-content-center">You don't have history</h1>
        @endforelse
    </div>

    <div class="modal" id="modal" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="file">Upload File</label>
                                    <input class="my-pond" placeholder="Upload File"
                                        id="file" name="file">
                                </div>
                                <div class="invalid-feedback" id="file_alert"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btn-save">Upload</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<!-- include FilePond library -->
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>

<!-- include FilePond plugins -->
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>

<!-- include FilePond jQuery adapter -->
<script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>
<script src="{{ asset('user/enchant/dist/enchanter.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>


<script>
    $.fn.filepond.registerPlugin(FilePondPluginImagePreview);

    $('#home').addClass('active')

    let session = "{{ session('order') }}"
        if (session) {
            sweetSuccess('success','Booking Success')
        }

    const cekAuthUser = (id) => {
        let user = "{{ Auth::user() }}"
        if (user == '') {
            sweetError('Please Login');
        }else{
            showFormBook(id);
        }
    }

    const upload = (id) => {
        $('.my-pond').filepond();
        $('#btn-save').attr('onclick',`uploadProcess('${id}')`)
        $('#modal').modal('show');
    }

    const uploadProcess = (id) => {
        let file = $(`.my-pond`).filepond('getFiles');
            let formData = new FormData($('#form').get(0));
            if (file.length != 0) {
                formData.append('file', file[0].file, file[0].file.name);
                formData.append('id', id);

                $.ajax({
                    type: "POST",
                    url: "{{ url('upload-transfer') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    enctype: 'multipart/form-data',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (res) => {
                        Swal.fire(
                            'Good job!',
                            res.message,
                            res.status
                        ).then(function() {
                            window.location.reload();
                        });
                        $('#modal').modal('hide');
                    },
                    error: (res) => {
                        errorHandle(res)
                    },
                })
            }else{
                sweetError('Please Upload File')
            }
    }
        
    
</script>
@endsection