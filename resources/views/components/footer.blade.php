<!-- ======= Footer ======= -->
<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 ">
                    <div class="footer-info">
                        <h4>KANTOR OPERASIONAL</h4>
                        <p>{{ $data['kontak']->kantor_operasional}}</p>
                        <div class="social-links mt-3">
                            <a href="{{ $data['kontak']->twiter}}" class="twitter"><i class="bx bxl-twitter"></i></a>
                            <a href="{{ $data['kontak']->facebook}}" class="facebook"><i
                                    class="bx bxl-facebook"></i></a>
                            <a href="{{ $data['kontak']->instagram}}" class="instagram"><i
                                    class="bx bxl-instagram"></i></a>
                            <a href="{{ $data['kontak']->linkedin}}" class="linkedin"><i
                                    class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 ">
                    <div class="footer-info">
                        <h4>KANTOR ADMINISTRASI</h4>
                        <p>J{{ $data['kontak']->kantor_administrasi}}</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 footer-links">
                    <h4>Navigasi</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ url('/') }}">{{ $data['menu']['home']}}</a>
                        </li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ url('/#services') }}">{{
                                $data['menu']['service']}}</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('kantor') }}">{{
                                $data['menu']['kantor']}}</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ url('/#contact') }}">{{
                                $data['menu']['contact']}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            &copy; Copyright <strong><span>{{ $data['kontak']->nama}}</span></strong>. All Rights Reserved
        </div>
    </div>
</footer><!-- End Footer -->

<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src={{ asset('home/vendor/aos/aos.js') }}></script>
<script src={{ asset('home/vendor/bootstrap/js/bootstrap.bundle.min.js') }}></script>
<script src={{ asset('home/vendor/glightbox/js/glightbox.min.js') }}></script>
<script src={{ asset('home/vendor/php-email-form/validate.js') }}></script>
<script src={{ asset('home/vendor/purecounter/purecounter.js') }}></script>
<script src={{ asset('home/vendor/swiper/swiper-bundle.min.js') }}></script>

<!-- Template Main JS File -->
<script src={{ asset('home/js/main.js') }}></script>