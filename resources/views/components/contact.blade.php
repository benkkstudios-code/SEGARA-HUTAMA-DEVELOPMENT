<section id="contact" class="contact contact-section">
    <div class="container">

        <div class="section-title">
            <h2>Contact</h2>
        </div>

    </div>

    <div>
        <iframe style="border:0; width: 100%; height: 350px;" src="{{ $data['kontak']->map}}" frameborder="0"
            allowfullscreen></iframe>
    </div>

    <div class="container">

        <div class="row mt-5">

            <div class="col-6">
                <div class="info-box mt-4">
                    <i class="bx bx-envelope"></i>
                    <h3>Kontak Email</h3>
                    @foreach ($data['kontak']->email as $emails)
                    <p>{{ $emails['email']}}</p>
                    @endforeach
                </div>
            </div>

            <div class="col-6">
                <div class="info-box mt-4">
                    <i class="bx bx-phone-call"></i>
                    <h3>Kontak Telpon</h3>
                    @foreach ($data['kontak']->phone as $phones)
                    <p>{{ $phones['phone']}}</p>
                    @endforeach

                </div>
            </div>
        </div>

    </div>
</section>