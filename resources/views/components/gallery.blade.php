<section data-aos="fade-up">
    <div class="gallery">
        @foreach ($datas as $data)
        <div class="gallery-item">
            <a class="gallery-lightbox" href="{{ asset($data['image']) }}"><img src="{{ asset($data['image']) }}"
                    class="gallery-image"></a>
        </div>
        @endforeach

    </div>
</section>
