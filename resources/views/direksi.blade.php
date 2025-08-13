<!DOCTYPE html>
<html lang="en">

@include('components.head')

<body>


    @include('components.topbar')


    <main id="main">
        @include('components.breadcumb', ['title' => 'DIREKSI SEGARA', 'desc' => ''])
        <section id="direksi" class="direksi">
            <div class="section-title">
                <h2>DIREKSI SEGARA</h2>
            </div>

            @include('components.team', ['datas' => $data['direksi']->content, 'portofolio' => true])

        </section>
        <section id="team" class="team">
            <div class="section-title">
                <h2>TEAM HEBAT KAMI</h2>
            </div>

            @include('components.team', ['datas' => $data['punggawa']->content, 'portofolio' => false])

        </section>

    </main>

    @include('components.footer')


</body>

</html>