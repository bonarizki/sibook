@extends('master.admin.master')

@section('title','Management Menu')

@section('content')
    <div class="pagetitle">
        <h1>Management Menu</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Master Management</li>
                <li class="breadcrumb-item active">Management Menu</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Master Menu</h5>
                        <button class="btn btn-primary mb-2"  onclick="showModal('add')">
                            <i class="bi bi-plus me-1"></i> Add Menu
                        </button>

                        <!-- Table with stripped rows -->
                        <table class="table table-bordered table-sm" id="table">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="align-middle">#</th>
                                    <th rowspan="2" class="align-middle">Menu Name</th>
                                    <th rowspan="2" class="align-middle">Category Name</th>
                                    <th rowspan="2" class="align-middle">Price</th>
                                    <th colspan="2"><center>Action<center></th>
                                </tr>
                                <tr>
                                    <th><center>Edit<center></th>
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
                                        <label for="menu_name" class="form-label">Menu Name</label>
                                        <input type="text" class="form-control" id="menu_name" name="menu_name" placeholder="Menu Name">
                                        <div class="invalid-feedback" id="menu_name_alert"></div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="col-12 mb-2">
                                        <label for="category_id" class="form-label">Category</label>
                                        <select class="form-control" id="category_id" name="category_id" placeholder="Category">
                                            <option value="">Choose</option>
                                        </select>
                                        <div class="invalid-feedback" id="category_id_alert"></div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="col-12 mb-2">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="text" class="form-control" id="price" name="price" placeholder="Price" onkeyup="formatRupiah(this)">
                                        <div class="invalid-feedback" id="price_alert"></div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="col-12 mb-2">
                                        <label for="price" class="form-label">Menu Photo</label>
                                        <input class="form-control my-pond" placeholder="Menu Photo"
                                                id="menu_file" name="menu_file" style="height: 100px;">
                                        <div class="invalid-feedback" id="price_alert"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" id="submit">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </div>
            </div>
        </div><!-- End Large Modal-->
    </section>
@endsection

@section('script')
    <script>
        $.fn.filepond.registerPlugin(FilePondPluginImagePreview);

        $('#management-menu').addClass('active');
        $('#management-master').addClass('collapsed');
        $('#management-master').addClass('show');
        $('#master').removeClass('collapsed');
       
        $(document).ready(function () {
            getCategory();

            $('#table').DataTable({
                destroy: true,
                serverSide : true,
                ajax: {
                    url: "{{ url('menu') }}",
                    type: "get",
                },
                columns : [{
                    data: "DT_RowIndex",
                    name: "DT_RowIndex"
                },
                {
                    data: "menu_name",
                    name: "menu_name"
                },
                {
                    data: "category.category_name",
                    name: "category.category_name"
                },
                {
                    data: "price",
                    name: "price",
                    render : (data) => {
                        return formatRupiahReturn(`'${data}'`);
                    }
                },
                {
                    data:"id",
                    name:"id",
                    render : (data) => {
                        return `<center>
                                    <span class='bi bi-pencil-square' onclick="showModal('edit','${data}')"></span>
                                </center>`;
                    }
                },
                {
                    data:"id",
                    name:"id",
                    render : (data) => {
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
            $('.my-pond').filepond();
            if (type == 'add') {
                $('.modal-title').text('Form Add Menu');
                $('#modal').modal('show');
                $('#submit').attr('onclick','add()')
            }else{
                $('.modal-title').text('Form Edit Menu');
                edit(id)
            }
        }

        const add = () => {
            let file = $(`.my-pond`).filepond('getFiles');
            let formData = new FormData($('#form').get(0));
            if (file.length != 0) {
                formData.append('file', file[0].file, file[0].file.name);
            }

            $.ajax({
                type: "POST",
                url: "{{ url('menu') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                success: (res) => {
                    sweetSuccess(res.status,res.message)
                    $(`#table`).DataTable().ajax.reload();
                    $('#modal').modal('hide');
                },
                error: (res) => {
                    errorHandle(res)
                },
            })
        }

        const edit = (id) => {
            $.ajax({
                type : "get",
                url : `{{ url('menu') }}/${id}/edit`,
                success : (res) => {
                    $('#menu_name').val(res.data.menu_name);
                    $('#category_id').val(res.data.category_id);
                    $('#price').val(formatRupiahReturn(`'${res.data.price}'`));
                    showImage(res.data)
                },
                complete : () => {
                    $('#modal').modal('show');
                    $('#submit').attr('onclick',`update('${id}')`);
                }
            })
        }

        const showImage = (data) => {
            console.log(data)
            $('.my-pond').filepond();
            if (data.menu_file_name != null) {
                $('.my-pond').filepond('addFile', `{{asset('file_upload/menu/${data.menu_file_name}')}}`)
                    .then(function (file) {

                    });
            }
        }

        const update = (id) => {
            let file = $(`.my-pond`).filepond('getFiles');
            let formData = new FormData($('#form').get(0));
            if (file.length != 0) {
                formData.append('file', file[0].file, file[0].file.name);
            }
            formData.append('id',id);
            $.ajax({
                type: "post",
                url: "{{ url('menu-update') }}",
                data: formData,
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: (res) => {
                    sweetSuccess(res.status, res.message)
                    $(`#table`).DataTable().ajax.reload();
                    $('#modal').modal('hide');
                },
                error: (res) => {
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
                url : "{{ url('menu') }}/" + id,
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

        const getCategory = () => {
            $.ajax({
                url : "{{ url('category') }}",
                type : 'get',
                success : (res) => {
                    let data = res.data
                    let option = '';
                    data.forEach(item => {
                        option += `<option value="${item.id}">${item.category_name}</option>`
                    });
                    $('#category_id').append(option)
                }
            })
        }
    </script>
@endsection