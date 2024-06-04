@extends('admin.layout.master')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/date-1.1.2/fc-4.1.0/fh-3.2.4/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/datatables.min.css" />
@endpush

@section('content')
    <div class="card-body">

        <table class="table table-striped table-centered mb-0" id="my-Table">
            <thead>
                <tr>
                    <th style="width: 3%">#</th>
                    <th style="width: 12%">Tên</th>
                    <th style="width: 15%">Email</th>
                    <th style="width: 10%">Số điện thoại</th>
                    <th style="width: 45%">Nội dung liên hệ</th>
                    <th style="width: 10%">Ngày</th>
                    <th style="width: 5%">Xóa</th>
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
                ajax: '{!! route('contact.getdata') !!}',
                columnDefs: [{
                        className: "not-export",
                        "targets": [6]
                    } // thêm class not-export vào cột t6
                ],
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'content',
                        name: 'content'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'destroy',
                        targets: 6,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return `<form action="${data}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type='button' class="btn-delete btn btn-danger">Xóa</button>
                                        </form>`;
                        }
                    },

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


            $(document).on('click', '.btn-delete', function() {
                let row = $(this).parents('tr');
                let form = $(this).parents('form');
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    dataType: 'json',
                    data: form.serialize(),
                    success: function() {

                        toastr.success('Xóa thành công!')
                        // console.log("success");
                        // row.remove();

                        table.draw();
                        // $('#my-table').rows().invalidate().draw();
                    },
                    error: function() {
                        toastr.error('Có lỗi xảy ra!')
                    }
                });

            });
        });
    </script>
@endpush
