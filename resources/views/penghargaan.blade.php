<!DOCTYPE html>
<html lang="en">

@include('components.head')

<body>

    @include('components.topbar')

    <main id="main">
        @include('components.breadcumb', ['title' => $data['penghargaan']->title, 'desc' => $data['penghargaan']->desc])

        @include('components.gallery', ['datas' => $data['penghargaan']->content])
    </main>

    @include('components.footer')


</body>

</html>
