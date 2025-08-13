<!DOCTYPE html>
<html lang="en">

@include('components.head')

<body>


    @include('components.topbar')


    <main id="main">
        @include('components.breadcumb', ['title' => 'TESTIMONI', 'desc' => 'Beberapa testimoni dari klien yang sudah
        bekerjasama dengan kami.'])
        <section id="testimonials">

            <div class="testimonial-box-container">
                @foreach ($data['testi']->content as $testis)
                <div class="testimonial-box">
                    <!--top------------------------->
                    <div class="box-top">
                        <!--profile----->
                        <div class="profile">
                            <!--img---->
                            <div class="profile-img">
                                <img src="{{ $testis['foto'] }}" />
                            </div>
                            <!--name-and-username-->
                            <div class="name-user">
                                <strong>{{ $testis['nama'] }}</strong>
                                <span>{{ $testis['perusahaan'] }}</span>
                            </div>
                        </div>
                        <!--reviews------>
                        <div class="reviews">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <!--Empty star-->
                        </div>
                    </div>
                    <!--Comments---------------------------------------->
                    <div class="client-comment">
                        <p>{{ $testis['testimoni'] }}</p>
                    </div>
                </div>
                @endforeach

            </div>
        </section>
    </main>

    @include('components.footer')


</body>

</html>