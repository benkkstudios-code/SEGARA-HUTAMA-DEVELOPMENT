<!DOCTYPE html>
<html lang="en">

@include('components.head')

<body>


    @include('components.topbar')




    <main id="main">
        @include('components.breadcumb', ['title' => $data['legalitas']->title, 'desc' => ''])

        <section id="team" class="team">
            <div class="container" data-aos="fade-up">
                <div class-"card">
                    {!! $data['legalitas']->content !!}
                </div>

            </div>
        </section>


    </main>

    @include('components.footer')


</body>

</html>
