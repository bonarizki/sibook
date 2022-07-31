@extends('master.admin.master')

@section('title','Order')

@section('content')
    <div class="pagetitle">
        <h1>Order</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Order</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Master Order</h5>
                        
                        <!-- Table with stripped rows -->
                        <table class="table table-bordered table-sm" id="table">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="align-middle">#</th>
                                    <th rowspan="2" class="align-middle">Order Code</th>
                                    <th rowspan="2" class="align-middle">Order By</th>
                                    <th rowspan="2" class="align-middle">Table</th>
                                    <th rowspan="2" class="align-middle">Seats</th>
                                    <th rowspan="2" class="align-middle">Time</th>
                                    <th rowspan="2" class="align-middle">Status</th>
                                    <th colspan="2"><center>Action<center></th>
                                </tr>
                                <tr>
                                    <th><center>Verifikasi<center></th>
                                    <th><center>Done<center></th>
                                    <th><center>Delete<center></th>
                                </tr>
                            </thead>
                            
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>

            </div>
        </div>

        <div class="modal fade" id="modal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <form id="form">
                                @csrf
                                <div class="card-body">
                                    <div class="col-12 mb-2">
                                        <label for="booking_code" class="form-label">Booking Code</label>
                                        <input type="text" class="form-control" id="booking_code" name="booking_code"
                                            placeholder="Booking Code" readonly>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="col-12 mb-2">
                                        <label for="order_by" class="form-label">Order By</label>
                                        <input type="text" class="form-control" id="order_by" name="order_by"
                                            placeholder="Order By" readonly>
                                        <div class="invalid-feedback" id="order_by_alert"></div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="col-12 mb-2">
                                        <label for="table" class="form-label">Table</label>
                                        <input type="text" class="form-control" id="table" name="table"
                                            placeholder="Table" readonly>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6 mb-2">
                                            <label for="seats" class="form-label">Seats</label>
                                            <input type="text" class="form-control" id="seats" name="seats"
                                                placeholder="Seats" readonly>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <label for="time" class="form-label">Time</label>
                                            <input type="text" class="form-control" id="time" name="time"
                                                placeholder="Time" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="col-12 mb-2">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="need_confirmation">Need Confirmation</option>
                                            <option value="payment">Payment</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="col-12 mb-2">
                                        <label for="file" class="form-label">File Transaksi</label>
                                        <input type="text" class="form-control my-filepond" placeholder="file" readonly>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingOne">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                    aria-expanded="false" aria-controls="flush-collapseOne">
                                                    Show Detail Orders
                                                </button>
                                            </h2>
                                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <table class="table table-bordered table-hovered">
                                                        <thead>
                                                            <tr>
                                                                <th>Menu</th>
                                                                <th>Qty</th>
                                                                <th>Price</th>
                                                                <th>SubTotal</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="table-body">

                                                        </tbody>
                                                    </table>
                                                    <div class="row">
                                                        <span><i>Total : <b id="total"></b></i></span>
                                                        <span><i>Total DP : <b id="total_dp"></b></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" id="submit">Verifikasi</button>
                    </div>
                </div>
            </div>
        </div><!-- End Large Modal-->
    </section>
@endsection

@section('script')
    <script>
        FilePond.registerPlugin(FilePondPluginImagePreview);
        FilePond.registerPlugin(FilePondPluginGetFile);

        $('#management-order').addClass('active');
        $('#management-order').removeClass('collapsed');
       
        $(document).ready(function () {
            $('#table').DataTable({
                destroy: true,
                serverSide : true,
                ajax: {
                    url: "{{ url('order') }}",
                    type: "get",
                },
                columns : [{
                    data: "DT_RowIndex",
                    name: "DT_RowIndex"
                },
                {
                    data: "booking_code",
                    name: "booking_code"
                },
                {
                    data: "user.name",
                    name: "user.name"
                },
                {
                    data: "table",
                    name: "table",
                    render: (data) => {
                        return `${data.table_name} - ${data.table_code}`
                    }
                },
                {
                    data: "seats",
                    name: "seats"
                },
                {
                    data: "hours",
                    name: "hours"
                },
                {
                    data: "status",
                    name: "status",
                    render: (data) => {
                        if (data == 'need_confirmation') {
                            return 'need confirmation'
                        }

                        return data
                    }
                },
                {
                    data:"id",
                    name:"id",
                    render : (data,meta,row) => {
                        if (row.status == 'need_confirmation') {
                            return  `<center>
                                        <span class='bi bi-pencil-square' onclick="showModal('edit','${data}')"></span>
                                    </center>`;
                        }

                        return `<center>
                                    <span class='bi bi-lock'></span>
                                </center>`;
                      
                    }
                },
                {
                    data:"id",
                    name:"id",
                    render : (data,meta,row) => {
                        if (row.status == 'payment') {
                            return  `<center>
                                        <span class='bi bi-pencil-square' onclick="setDone('${data}')"></span>
                                    </center>`;
                        }

                        return `<center>
                                    <span class='bi bi-lock'></span>
                                </center>`;
                      
                    }
                },
                {
                    data:"id",
                    name:"id",
                    render : (data,meta,row) => {
                        if (row.status == 'payment' || row.status == 'done') {
                            return `<center>
                                        <span class='bi bi-lock'></span>
                                    </center>`;
                        }

                        return `<center>
                                    <span class='bx bxs-trash' onclick="alertDelete('${data}')"></span>
                                </center>`;
                    }
                }
                ]
            })
        });

        const showModal = (type,id = null) => {
            $('.is-invalid').removeClass('is-invalid')
            $('#form')[0].reset()
            if (type == 'add') {
                $('.modal-title').text('Form Verifikasi');
                $('#modal').modal('show');
                $('#submit').attr('onclick','add()')
            }else{
                $('.modal-title').text('Form Verifikasi');
                edit(id)
            }
        }

        const add = () => {
            let data = $('#form').serialize();
            $.ajax({
                type : "POST",
                url : "{{ url('order') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data : data,
                success : (res) => {
                    sweetSuccess(res.status,res.message)
                    $(`#table`).DataTable().ajax.reload();
                    $('#modal').modal('hide');
                },
                error : (res) => {
                    errorHandle(res)
                },
            })
        }

        const edit = (id) => {
            $.ajax({
                type : "get",
                url : `{{ url('order') }}/${id}/edit`,
                success : (res) => {
                    let data = res.data
                    $('#booking_code').val(data.booking_code)
                    $('#order_by').val(data.user.name)
                    $('#table').val(`${data.table.table_name} - ${data.table.table_code}`)
                    $('#seats').val(data.seats)
                    $('#time').val(data.hours)
                    $('#status').val(data.status)
                    $('.my-filepond').filepond({
                        name: 'filepond',
                        labelButtonDownloadItem: 'custom label', // by default 'Download file'
                        allowDownloadByUrl: false, // by default downloading by URL disabled
                    });
                    $('.my-filepond').filepond('removeFiles');
                    showImage(data)
                    showDetailOrder(data)
                },
                complete : () => {
                    $('#modal').modal('show');
                    $('#submit').attr('onclick',`update('${id}')`);
                }
            })
        }

        const showDetailOrder = (data) => {
            $('#table-body').empty()
            let detail = data.detail
            let tbody = ''
            let total = 0
            detail.forEach(menu => {
                subtotal = menu.menu.price * menu.qty 
                total = total + subtotal 
                tbody += `
                    <tr>
                        <td>${menu.menu.menu_name}</td>
                        <td>${menu.qty}</td>
                        <td>${formatRupiahReturn(`'${menu.menu.price}'`)}</td>
                        <td>${formatRupiahReturn(`'${subtotal}'`)}</td>
                    </tr>
                `
            });
            $('#table-body').append(tbody)
            $('#total').text(formatRupiahReturn(`'${total}'`))
            $('#total_dp').text(formatRupiahReturn(`'${total / 2}'`))
        }

        const showImage = (data) => {
            $('.my-filepond').filepond();
            if (data.file_pembayaran != null) {
                $('.my-filepond').filepond('addFile', `{{asset('file_upload/transaksi_file/${data.file_pembayaran}')}}`)
                .then(function(file){

                });
            }
        }

        const update = (id) => {
            let data = $('#form').serialize();
            $.ajax({
                type : "PATCH",
                url : "{{ url('order') }}/" + id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data : data,
                success : (res) => {
                    sweetSuccess(res.status,res.message)
                    $(`#table`).DataTable().ajax.reload();
                    $('#modal').modal('hide');
                    $('#form')[0].reset();
                },
                error : (res) => {
                    errorHandle(res)
                },
            })
        }

        const alertDelete = (id) => {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    deleteProcess(id)
                }
            })
        }

        const deleteProcess = (id) => {
            $.ajax({
                type : "delete",
                url : "{{ url('order') }}/" + id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success : (res) => {
                    sweetSuccess(res.status,res.message)
                },
                error : (res) => {
                    errorHandle(res)
                },
                complete : () => {
                    $(`#table`).DataTable().ajax.reload();
                    $('#form')[0].reset()
                }
            })
        }

        const setDone = (id) => {
            Swal.fire({
                title: 'Are you sure?',
                text: "You will be update this order to done",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update!'
            }).then((result) => {
                $.ajax({
                    type : "PATCH",
                    url : "{{ url('order') }}/" + id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data : {
                        status : "done"
                    },
                    success : (res) => {
                        sweetSuccess(res.status,res.message)
                        $(`#table`).DataTable().ajax.reload();
                        $('#modal').modal('hide');
                        $('#form')[0].reset();
                    },
                    error : (res) => {
                        errorHandle(res)
                    },
                })
            })
        }
    </script>
@endsection