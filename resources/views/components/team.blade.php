<div class="responsive-container-block outer-container" data-aos="fade-right">
    <div class="responsive-container-block inner-container">
        <div class="responsive-cell-block team-cards-outer-container">
            <div class="responsive-container-block team-cards-inner-container">
                @foreach ($datas as $data)
                <div class="responsive-cell-block card-container">
                    <div class="card">
                        <div class="img-box">
                            <img class="person-img" src="{{ asset($data['image']) }}">
                        </div>
                        <div class="card-content-box">
                            <p class="text-blk person-name">{{ $data['nama'] }}</p>
                            <p class="text-blk person-jabatan">{{ $data['Jabatan'] }}</p>
                            <p class="text-blk person-nik">NI.SEGARA : SHG-{{ $data['nik'] }}</p>
                            @if ($portofolio)
                            <p class="text-blk person-info">{{ $data['portofolio'] }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
