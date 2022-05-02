@php
    $page_one = DB::table('pages')->where('page_position', 1)->get();
    $page_two = DB::table('pages')->where('page_position', 2)->get();
@endphp
<footer class="footer">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 footer_col">
                    <div class="footer_column footer_contact">
                        <div class="logo_container">
                            <div class="logo"><a href="{{ url('/') }}">Online</a></div>
                        </div>
                        <div class="footer_title">Got Question? Call Us 24/7</div>
                        <div class="footer_phone">01747706163</div>
                        <div class="footer_contact_text">
                            <p>17 Princess Road, London</p>
                            <p>Grester London NW18JR, UK</p>
                        </div>
                        <div class="footer_social">
                            <ul>
                                <li><a href="{{ $setting->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="{{ $setting->linkedin }}" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                                <li><a href="{{ $setting->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a></li>
                                <li><a href="{{ $setting->pinterest }}" target="_blank"><i class="fab fa-pinterest"></i></a></li>
                                <li><a href="{{ $setting->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="{{ $setting->whatsapp }}" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                                <li><a href="{{ $setting->messenger }}" target="_blank"><i class="fab fa-messenger"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 offset-lg-2">
                    <div class="footer_column">
                        <div class="footer_title">Other Page</div>
                        <ul class="footer_list">
                            @foreach ($page_one as $row)
                                <li>
                                    <a href="{{ route('view.page', $row->page_slug) }}">{{ $row->page_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="footer_column">
                        <div class="footer_title">Important Page</div>
                        <ul class="footer_list">
                            @foreach ($page_two as $row)
                                <li>
                                    <a href="#">{{ $row->page_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="footer_column">
                        <div class="footer_title">Customer Care</div>
                        <ul class="footer_list">
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">Order Tracking</a></li>
                            <li><a href="#">Wish List</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Become a Vendor</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </footer>

    <!-- Copyright -->

    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
                        <div class="copyright_content">
Copyright &copy;<script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>document.write(new Date().getFullYear());</script> All rights reserved.
</div>
                        <div class="logos ml-sm-auto">
                            <ul class="logos_list">
                                <li><a href="#"><img src="{{ asset('public/frontend') }}/images/logos_1.png" alt=""></a></li>
                                <li><a href="#"><img src="{{ asset('public/frontend') }}/images/logos_2.png" alt=""></a></li>
                                <li><a href="#"><img src="{{ asset('public/frontend') }}/images/logos_3.png" alt=""></a></li>
                                <li><a href="#"><img src="{{ asset('public/frontend') }}/images/logos_4.png" alt=""></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
