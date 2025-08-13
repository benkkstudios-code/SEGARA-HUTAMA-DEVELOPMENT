<!DOCTYPE html>
<html lang="en">

@include('components.head')

<body>


    @include('components.topbar')




    <main id="main">
        @include('components.breadcumb', ['title' => $data['buletin']->title, 'desc' => $data['buletin']->desc])

        @include('components.gallery', ['datas' => $data['buletin']->content])


    </main>

    @include('components.footer')


</body>

</html>
