@extends('clients.root.master')

@section('title')
    Liên hệ
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endpush

@section('content')
    <div class="grid wide contact-container">
        <div class="title">Liên hệ với chúng tôi</div>

        <div class="content">
            <div class="contact">
                <div class="contact__form">
                    <form method="POST" action="{{ route('contact.store') }}" accept-charset="UTF-8"
                        enctype="multipart/form-data" class="contact-form">
                        @csrf
                        <div class="form-control">
                            <label for="name">Tên của bạn</label>
                            <input type="text" id="name" name="name" value="">
                        </div>
                        <div class="form-control">
                            <label for="email">Email của bạn</label>
                            <input type="text" id="email" name="email">
                        </div>
                        <div class="form-control">
                            <label for="phone">Số điện thoại của bạn</label>
                            <input type="text" id="phone" name="phone" value="">
                        </div>
                        <div class="form-control">
                            <label for="content">Nội dung liên hệ</label>
                            <textarea rows="10" id="content" name="content"></textarea>
                        </div>
                        <input type="submit" class="btn-send" value="Gửi">
                    </form>
                </div>
                <div class="contact__content">
                    <p>Đây là một số câu hỏi thường gặp nhất mà bạn có thể muốn xem</p>

                    <ul class="list">
                        <li class="item"><a href="">FAQS</a></li>
                        <li class="item"><a href="">Vận chuyển</a></li>
                        <li class="item"><a href="">Chính sách bảo hành</a></li>
                        <li class="item"><a href="">Chính sách trả lại và hoàn tiền</a></li>
                    </ul>

                    <p>Hoặc nếu bạn có bất kỳ câu hỏi nào khác, xin vui lòng để lại tin nhắn của bạn tại đây trong phần bên
                        dưới. Chúng tôi sẽ
                        liên hệ lại với bạn sớm nhất có thể</p>

                    <div class="contact__content--info">
                        <p>Email: <a href="mailto:thaolv.21it@vku.udn.vn">thaolv.21it@vku.udn.vn</a></p>
                        <p>Số điện thoại: <a href="tel:+84947180074">0947180074</a></p>
                        <p>Trường Đại học Công nghệ Thông tin và Truyền thông Việt - Hàn</p>
                        <p>Địa chỉ: 470 Đường Trần Đại Nghĩa, Khu đô thị, Ngũ Hành Sơn, Đà Nẵng</p>
                    </div>

                    <p>Giờ mở cửa: 9:00 AM - 17:00 PM</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    {{-- <script>
        CKEDITOR.replace('content');
    </script> --}}
@endpush
