@extends('admin.layout.master')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/date-1.1.2/fc-4.1.0/fh-3.2.4/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/datatables.min.css" />
        <style>
            button.image-btn {
                padding: 3px 15px;
                border: 1px solid silver;
                border-radius: 10px;
                background-color: #fff;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            button.image-btn a {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            button i.fa-right-to-bracket {
                padding-left: 10px;
                font-size: 17px;
            }
        </style>
@endpush
@section('content')
    <div class="card-body">
        <div>
            <h4>Hình ảnh</h4>
            <button class="image-btn"><a href="{{ route('admin.homepage.images') }}">Quản lý hình ảnh<i class="fa-solid fa-right-to-bracket"></i></a></button>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.11.5/b-2.2.2/b-colvis-2.2.2/b-html5-2.2.2/b-print-2.2.2/date-1.1.2/fc-4.0.2/fh-3.2.2/r-2.2.9/rg-1.1.4/sc-2.0.5/sb-1.3.2/sl-1.3.4/datatables.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script></script>
@endpush
