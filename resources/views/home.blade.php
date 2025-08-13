<!DOCTYPE html>
<html lang="en">

@include('components.head')

<body>

    @include('components.topbar')


    <!-- ======= Hero Section ======= -->

    <section id="hero">
        <div class="big-swiper" data-aos="fade-up">
            <div class="wrapper swiper-wrapper">
                @foreach ($data['carousel']->content as $carousels)
                <div class="slide swiper-slide">
                    <img src="{{ asset($carousels['image']) }}" alt="{{ $carousels['title'] }}" class="image" />
                    <div class="image-data" data-aos="fade-left">
                        <h2>{{ $carousels['title'] }}</h2>
                    </div>
                </div>
                @endforeach
            </div>
        </div>



    </section><!-- End Hero -->

    <main id="main">
        <!-- ======= Counts Section ======= -->
        <section id="counts" class="counts">
            <div class="container" data-aos="fade-up">

                <div class="row no-gutters">
                    @foreach ($data['kelebihan']->content as $kelebihans)
                    <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
                        <div class="count-box">
                            <img src="{{ asset($kelebihans['image']) }}" alt="{{ $kelebihans['title'] }}" class="mb-10">
                            <h5>{{ $kelebihans['title'] }}</h5>
                            <p>{{ $kelebihans['description'] }}</p>
                        </div>
                    </div>
                    @endforeach



                </div>

            </div>
        </section><!-- End Counts Section -->

        <!-- ======= About Us Section ======= -->
        <section id="about" class="about">
            <div class="container-xxl about my-5" style="    background: linear-gradient(rgba(0, 0, 0, .1), rgba(0, 0, 0, .1)), url({{ asset($data['about']->image) }}) left center no-repeat;
    background-size: cover;" data-aos="fade-up">
                <div class="container">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="h-100 d-flex align-items-center justify-content-center"
                                style="min-height: 300px;">

                            </div>
                        </div>
                        <div class="col-lg-6 pt-lg-5 wow fadeIn" data-wow-delay="0.5s">
                            <div class="bg-white rounded-top p-5 mt-lg-5">
                                {{-- <p class="fs-5 fw-medium text-primary">{{ $data['about']->title }}</p> --}}
                                <h2 class="mb-4">{{ $data['about']->subtitle }}</h2>
                                <p class="mb-4">{{ $data['about']->content }}</p>
                                <div class="row g-5 pt-2 mb-5">
                                    <div class="col-sm-6">
                                        <img class="img-fluid mb-4" src="{{ asset('icon/icon-5.png') }}" alt="">
                                        <h5 class="mb-3">Pelayanan Yang Baik</h5>
                                        <span>Sehingga pelanggan selalu menjadi perioritas</span>
                                    </div>
                                    <div class="col-sm-6">
                                        <img class="img-fluid mb-4" src="{{ asset('icon/icon-2.png') }}" alt="">
                                        <h5 class="mb-3">Ditangani Langsung</h5>
                                        <span>Oleh tenaga profesional dibidangnya masing-masing</span>
                                    </div>
                                </div>
                                <a class="btn btn-primary rounded-pill py-3 px-5" href="{{ url('/perkenalan') }}">baca
                                    selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End About Us Section -->

        <!-- ======= Services Section ======= -->
        <section id="services" class="services services">
            <div class="section-title">
                <h3>{{ $data['services']->description }}</h3>
            </div>
            <div class="container-xxl py-5">
                <div class="container">
                    <div class="row g-4">
                        @foreach ($data['services']->content as $content)
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s"
                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                            <div class="service-item position-relative h-100">
                                <div class="service-text rounded p-5">
                                    <div class="btn-square bg-light rounded-circle mx-auto mb-4"
                                        style="width: 164px; height: 100px;">
                                        <img class="img-fluid" src="{{ asset($content['image']) }}" alt="Icon">
                                    </div>
                                    <h5 class="mb-3">{{ $content['title'] }}</h5>
                                    <p class="mb-0">{{ $content['description'] }}</p>
                                </div>
                                {{-- <div class="service-btn rounded-0 rounded-bottom">
                                    <a class="text-primary fw-medium" href="">Read More<i
                                            class="bi bi-chevron-double-right ms-2"></i></a>
                                </div> --}}
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
        </section><!-- End Services Section -->
        <!-- ======= Project Section ======= -->
        <section id="project" class="project">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Perusahaan Yang Telah Menggunakan Jasa Kami</h2>
                </div>

                <div class="partner-component ">
                    <!-- Slider main container -->
                    <div class="partner-swiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            @foreach ($data['project']['content'] as $projects)
                            <div class="swiper-slide">
                                <div class="parner-image">
                                    <a class="gallery-lightbox" href="{{ asset($projects['image']) }}"><img
                                            src="{{ asset($projects['image']) }}" class="partner-image" alt=""></a>
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>

            </div>
        </section><!-- End Project Section -->

        <!-- ======= Direksi Section ======= -->
        <section id="direksi" class="direksi">
            <div class="section-title">
                <h2>DIREKSI SEGARA</h2>
            </div>
            @include('components.team', ['datas' => $data['direksi']->content, 'portofolio' => true])


        </section>
        <!-- ======= End Direksi Section ======= -->
        <!-- ======= Counts Section ======= -->
        <section id="counts" class="counts">
            <div class="container" data-aos="fade-up">

                <div class="row no-gutters">
                    @foreach ($data['kelebihan']->content as $kelebihans)
                    <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
                        <div class="count-box">
                            <img src="{{ asset($kelebihans['image']) }}" alt="{{ $kelebihans['title'] }}" class="mb-10">
                            <h5>{{ $kelebihans['title'] }}</h5>
                            <p>{{ $kelebihans['description'] }}</p>
                        </div>
                    </div>
                    @endforeach



                </div>

            </div>
        </section><!-- End Counts Section -->

        @include('components.contact')

    </main><!-- End #main -->

    @include('components.footer')

</body>

</html>
