@extends('admin.layout.master')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/date-1.1.2/fc-4.1.0/fh-3.2.4/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/datatables.min.css" />
@endpush
@section('content')
    <div class="card-body">

        {{-- section phải trùng tên với yield bên master --}}
        <table class="table table-striped table-centered mb-0" id="my-Table">
            {{-- <div class="form-group ">
                <select id="select-user-name" class="custom-select mb-3">
                    <option value="" selected>Tìm tên</option>
                </select>
            </div> --}}
            {{-- <div class="form-group ">
                <select id="select-name" class="custom-select mb-3">

                </select>
            </div> --}}
            {{-- <div class="form-group">
                <select id="select-status"class="custom-select mb-3">
                    <option value="">Chọn trạng thái</option>
                    <option value="0">Đang xác nhận</option>
                    <option value="1">Đã xác nhận</option>
                    <option value="2">Hủy đơn</option>
                </select>
            </div>
            <button class="btn btn-success" id="btn-Delete-Filter">Xóa tìm kiếm</button> --}}
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Địa chỉ</th>
                    <th>Ngày tạo</th>
                    <th>Ngày chỉnh sửa</th>
                    <th>Sửa</th>
                    {{-- <th>Xóa</th> --}}
                </tr>
            </thead>

        </table>
    </div>
@endsection
@push('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.11.5/b-2.2.2/b-colvis-2.2.2/b-html5-2.2.2/b-print-2.2.2/date-1.1.2/fc-4.0.2/fh-3.2.2/r-2.2.9/rg-1.1.4/sc-2.0.5/sb-1.3.2/sl-1.3.4/datatables.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(function() {

            var table = $('#my-Table').DataTable({
                dom: 'Blfrtip',
                select: true,
                processing: true,
                serverSide: true,
                ajax: '{!! route('orders.getdata') !!}',
                columnDefs: [{
                        className: "not-export",
                        "targets": [7]
                    } // thêm class not-export vào cột t7,8
                ],
                columns: [

                    {
                        data: 'id',
                        targets: 0,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return `<a class=""
                                        href=" ${data['link']} ">${data['id']}
                                         </a>`;
                        }
                    },
                    {
                        data: 'user_name',
                        name: 'user_name'
                    },

                    {
                        data: 'order_total',
                        name: 'order_total'
                    },

                    {
                        data: 'order_status',
                        name: 'order_status'
                    },
                    {
                        data: 'order_address',
                        name: 'order_address'
                    },

                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },

                    {
                        data: 'edit',
                        targets: 6,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return `<a class="btn btn-primary"
                                        href=" ${data} ">Sửa
                                         </a>`;
                        }
                    },
                    // {
                    //     data: 'destroy',
                    //     targets: 7,
                    //     orderable: false,
                    //     searchable: false,
                    //     render: function(data, type, row, meta) {
                    //         return `<form action="${data}" method="POST">
                    //                         @csrf
                    //                         @method('delete')
                    //                         <button type='button' class="btn-delete btn btn-danger">Xoa</button>
                    //                     </form>`;
                    //     }
                    // },

                ],

                buttons: [

                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible :not(.not-export)'
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':visible :not(.not-export)'
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':visible :not(.not-export)'
                        }
                    },

                    'colvis'
                ],
            });

            // $('#select-user-name').change(function() {
            //     console.log($(this).val());
            //     table.column(1).search($(this).val()).draw();
            // });
            // $('#select-status').change(function() {
            //     console.log($(this).val());
            //     table.column(3).search($(this).val()).draw();
            // });

            // $(document).on('click', '#btn-Delete-Filter', function() {
            //     table.search('');
            //     table.columns().search('').draw();
            // });
            $(document).on('click', '.btn-delete', function() {
                let row = $(this).parents('tr');
                let form = $(this).parents('form');
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    dataType: 'json',
                    data: form.serialize(), // lấy toàn bộ dữ liệu ở form -> chuyển data sang route ở form xử lí -> trả về json
                    //-> thành công thì xóa
                    success: function() {
                        toastr.success('Xóa thành công!')
                        table.draw();
                    },
                    error: function() {
                        toastr.error('Có lỗi xảy ra!')
                    }
                });

            });
        });
    </script>
@endpush
