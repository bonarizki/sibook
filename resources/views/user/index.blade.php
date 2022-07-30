@extends('master.user.master')

@section('title','HOME')

@section('content')
<section class="py-5 text-center container">
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light">WOTISH</h1>
            <h1 class="fw-light">COFFE & EATERY</h1>
            <p class="lead text-muted">@auth Hi, {{ Auth::user()->name }} @endauth you can order your food and table now</p>
        </div>
    </div>
</section>

<div class="album py-2 bg-light">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach ($tables as $table)
            <div class="col">
                <div class="card shadow-sm">
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                        xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 1"
                        preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>{{ $table->table_code }}</title>
                        <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef"
                            dy=".3em">{{ $table->table_name }}</text>
                    </svg>
                    <div class="card-body">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="cekAuthUser('{{ $table->id }}')">Book</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="form-booking" action="{{ url('booking') }}" method='post'>\
                @csrf
                <div class="modal-header" >
                    <h5 class="modal-title" id="exampleModalLabel">Booking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <nav>
                        <div class="nav nav-pills nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-link active" id="step1-tab" data-toggle="tab" href="#step1">Book Tabel</a>
                            <a class="nav-link" id="step2-tab" data-toggle="tab" href="#step2">Menu</a>
                            <a class="nav-link" id="step3-tab" data-toggle="tab" href="#step3">List Order</a>
                        </div>
                    </nav>
                    <div class="tab-content py-4" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="step1">
                            <h4>Table</h4>
                            <div class="mb-3">
                                <label for="table_code">Table Code</label>
                                <input type="text" class="form-control" id="table_code" required disabled>
                            </div>
                            <div class="mb-3">
                                <label for="table_name">Table Name</label>
                                <input type="text" class="form-control" id="table_name" required disabled>
                            </div>
                            <div class="mb-3">
                                <label for="seat">Seats</label>
                                <input type="text" class="form-control" id="seat" name="seats" required>
                            </div>
                            <div class="mb-3">
                                <label for="hours">Hours</label>
                                <input type="time" class="form-control" id="hours" name="hours" required>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="step2">
                            <h4 class="mb-2">Menu</h4>
                            @foreach ($categories as $category)
                                <div class="row">
                                    <h4 class="mb-1">{{ $category->category_name }}</h4>
                                    <div class="card-group">
                                        @foreach ($category->menu as $menu)
                                            <div class="card p-3 mr-3 ml-3 mt-3 mb-3 mr-3" style="width: 18rem;" >
                                                <img src="file_upload/menu/{{ $menu->menu_file_name }}" class="card-img-top" alt="..." width="150px" height="250px">
                                                <div class="card-body">
                                                    <h5 class="card-title" id="menu-name-{{ $menu->id }}">{{ $menu->menu_name }}</h5>
                                                    <p class="card-text" id="menu-price-{{ $menu->id }}">Rp. {{number_format($menu->price,2,",",'.')}}</p>
                                                    <a href="#" class="btn btn-primary" onclick="addOrder('{{ $menu->id }}')">Order</a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    
                                </div>
                            @endforeach
                            
                        </div>
                        <div class="tab-pane fade" id="step3">
                            <h4>Your Order</h4>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr class="table-primary">
                                        <td>Menu</td>
                                        <td hidden>Menu ID</td>
                                        <td>Price</td>
                                        <td>QTY</td>
                                        <td hidden>QTY ID</td>
                                        <td>Total</td>
                                    </tr>
                                </thead>
                                <tbody id="tbody">

                                </tbody>
                            </table>
                            <div class="row">
                                <h3><i>Total : <b id="total"></b></i></h3>
                                <h3><i>Total DP : <b id="total_dp"></b></i></h3>
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
                <div class="modal-footer">
                    <div class="row justify-content-between">
                        <div class="col-auto"><button type="button" class="btn btn-secondary"
                                data-enchanter="previous">Previous</button></div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-primary" data-enchanter="next">Next</button>
                            <button type="submit" class="btn btn-primary" data-enchanter="finish">Finish</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('user/enchant/dist/enchanter.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>


<script>
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
        
    const showFormBook = (id) => {
        $.ajax({
            type : "get",
            url : "{{ url('table-detail') }}/"+ id +"/edit",
            success : (res) => {
                $("#table_name").val(res.data.table_name)
                $("#table_code").val(res.data.table_code)
            }
        })
        $('#modal').modal('show');

    }

    var formBooking = $('#form-booking');
    var formValidate = formBooking.validate({
      errorClass: 'is-invalid',
      errorPlacement: () => false
    });

    const wizard = new Enchanter('form-booking', {}, {
        onNext: () => {
            if (!formBooking.valid()) {
                formValidate.focusInvalid();
                return false;
            }
        },onFinish: () => {
            let data = $('#form-booking').serializeArray();
        },
    });

    const addOrder = (id) => {
        let tableBody = ''
        let menuname = $(`#menu-name-${id}`).text();
        let menunprice = $(`#menu-price-${id}`).text();
        tableBody += `
            <tr>
                <td>${menuname}</td>
                <td hidden>
                    <input class="menu-id-form-${id}" name="menu_id[]" type="text" value=${id}>
                </td>
                <td class="price-${id}">${menunprice}</td>
                <td class="align-center">
                    <center>
                        <div class="d-flex align-items-center p-2" id="menu-qty-${id}">
                            <span style="cursor: pointer;" class="text-warning mr-1" onclick="updateQty(this,'minus')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                </svg>
                            </span> 
                            <div id="qty" data-qty="1" name="qty[]">1</div>
                            <span style="cursor: pointer;" class="text-info ml-1" onclick="updateQty(this,'plus')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                            </span>
                        </div>
                    </center>
                </td>
                <td hidden>
                    <input class="qty-menu-form-${id}" name="qty_menu[]" type="text">
                </td>
                <td id="subtotal-${id}"></td>
            </tr>
        `

        $('#tbody').append(tableBody);
        updateTotal(`#menu-price-${id}`,1);
        updateSubtotal()
    }

    const updateQty = (data,type) => {
        let parent = $(data).parent().attr('id');
        let selectorQty = $(`#${parent} #qty`);
        let qty = selectorQty.text()

        type == 'minus' ? qty-- : qty++;

        selectorQty.attr('data-qty', qty);
        selectorQty.text(qty);

        updateTotal(parent,qty);
        updateSubtotal();
        
    }

    const updateTotal = (parent,qty) => {
        let id = parent.split('-');
        let selectorPrice = $(`.price-${id[2]}`).text()
        let price = formatRupiahInteger(`'${selectorPrice}'`);
        let totalPrice = price * qty;
        $(`#subtotal-${id[2]}`).text(formatRupiahReturn(`'${totalPrice}'`));
        $(`.qty-menu-form-${id[2]}`).val(qty)
    }

    const updateSubtotal = () => {
        let listItem = $('[id^="subtotal-"]');
        let total = 0;
        for (let index = 0; index < listItem.length; index++) {
            let parent = listItem[index].id;
            let subtotal = $(`#${parent}`).text()
            subtotal =  formatRupiahInteger(`'${subtotal}'`);
            total = total + parseInt(subtotal);
        }
        $('#total').text(formatRupiahReturn(`'${total}'`));
        $('#total_dp').text(formatRupiahReturn(`'${total / 2}'`));
        
    }
</script>
@endsection