<!DOCTYPE html>
<!-- saved from url=(0067)https://harnishdesign.net/demo/html/koice/index-invoice-hotels.html -->
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{--
    <link href="https://harnishdesign.net/demo/html/koice/images/favicon.png" rel="icon"> --}}
    <title>Invoice</title>
    <meta name="author" content="BENKKSTUDIOS">

    <!-- Web Fonts
======================= -->
    <link rel="stylesheet" href="./Hotel Booking Invoice - Koice_files/css" type="text/css">

    <!-- Stylesheet
======================= -->

    <link rel=" stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel=" stylesheet" type="text/css" href="{{ asset('assets/css/stylesheet.css') }}">
    <link rel=" stylesheet" type="text/css" href="{{ asset('assets/css/all.min.css') }}">
</head>

<body>
    <!-- Container -->
    <div class="container-fluid invoice-container"
        style="background-image: url({{ asset('icon/logo-mask.png') }});   background-position: 50% 70%; background-size: 50%; background-repeat: no-repeat; ">
        <!-- Header -->
        <header>
            <div class="row align-items-center gy-3">
                <div class="col-sm-12 text-center text-sm-start"> <img id="logo"
                        src="{{ asset('assets/css/logo.png') }}" title="Koice" alt="Koice" width="100%"> </div>

            </div>
            <div class="gradient-divider"></div>
        </header>

        <!-- Main Content -->
        <main>
            <div class="row .invoice-header">
                <div class="col-sm-9 text-start">
                    <h2 class="invoice-label">INVOICE</h2>

                    <p style="margin-bottom: 0px !important;"><strong>KEPADA: {{ $data['perusahaan']->nama}}</strong>
                    </p>
                    <P class="invoice-alamat">{{ $data['perusahaan']->alamat }}</P>
                    <div class="row row-info">
                        <div class="col-sm-3 text-start">
                            <p class="invoice-info">NAMA KAPAL</p>
                            <p class="invoice-info">PELABUHAN MUAT</p>
                            <p class="invoice-info">NOMOR PEB/PIB</p>
                            <p class="invoice-info">SHIPPER</p>
                        </div>
                        <div class="col-sm-8 text-start">
                            <p class="invoice-info"><strong>{{ $data['invoice']->transportasi }}</strong></p>
                            <p class="invoice-info">{{ $data['invoice']->lokasi_muat }}</p>
                            <p class="invoice-info">{{ $data['invoice']->pib }}</p>
                            <p class="invoice-info">{{ $data['invoice']->pengirim }}</p>
                        </div>
                    </div>
                </div>
                <div class=" col-sm-3 text-start">
                    <p class="mb-1 nominal-title"><strong>NOMINAL</strong></p>
                    <p class="nominal-text"> <strong>{{ $data['total'] }}</strong></p>
                    <p class="mb-0 date-title"><strong>TANGGAL</strong></p>
                    <p class="date-text"> {{ $data['tanggal'] }}</p>
                    <p class="mb-0 nomor-title"><strong>NO. INVOICE</strong></p>
                    <p class="nomor-text"> {{ $data['invoice']->nomor }}</p>
                </div>
            </div>

            <hr class="mt-10">
            <div class="row">
                <div class="col-sm-9 text-start">
                    <div class="row invoice-row-head">
                        <div class="col-sm-6">
                            <p class="mb-0"><strong>URAIAN</strong></p>
                        </div>
                        <div class="col-sm-3 text-center">
                            <p class="mb-0"><strong>TONASE(mt)</strong></p>
                        </div>
                        <div class="col-sm-3 text-end">
                            <p class="mb-0"><strong>JUMLAH</strong></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 text-end invoice-row-total">
                    <p class="mb-0"><strong>TOTAL</strong></p>
                </div>
            </div>
            @foreach ($data['invoice']->uraian as $item)
            <div class="row">
                <div class="col-sm-9 text-start">
                    <div class="row invoice-row-content">
                        <div class="col-sm-6">
                            <p class="mb-0">{{ $item['keterangan'] }}</p>
                        </div>
                        <div class="col-sm-3 text-center">
                            <p class="mb-0">{{ $item['tonase'] }}</p>
                        </div>
                        <div class="col-sm-3 text-end">
                            <p class="mb-0">{{ 'Rp.' . str_replace(',00', '', number_format($item['jumlah'],
                                2, ",",
                                ".")) }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 text-end invoice-row-content">
                    <p class="mb-0">{{ 'Rp.' . str_replace(',00', '', number_format($item['jumlah'],
                        2, ",",
                        ".")) }}</p>
                </div>
            </div>
            @endforeach
            @if ($data['invoice']->include_pph)
            <div class="row invoice-row-pph">
                <div class="col-sm-9 text-start">
                    <div class="row ">
                        <div class="col-sm-6">
                            <p class="mb-0">PPH {{ $data['setting']->pph }}%</p>
                        </div>
                        <div class="col-sm-3 text-center">
                            <p class="mb-0"></p>
                        </div>
                        <div class="col-sm-3 text-end">
                            <p class="mb-0"></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 text-end">
                    <p class="mb-0">{{ $data['pph'] }}</p>
                </div>
            </div>
            @endif
            <div class="row invoice-row-terbilang">
                <div class="col-sm-9 text-start">
                    <div class="row ">
                        <div class="col-sm-4">
                            <p class="mb-0">TERBILANG</p>
                        </div>
                        <div class="col-sm-8 text-end">
                            <p class="mb-0">{{ $data['terbilang'] }} Rupiah</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 text-end">
                    <p class="mb-0"></p>
                </div>
            </div>
        </main>
        <!-- Footer -->
        <footer class="text-center" style="margin-top: 10px;">
            <div class="row ">
                <div class="col-sm-8 text-start " style="margin-top: 110px;">
                    <strong>Rekening :</strong></br>
                    <strong>{{ $data['rekening']->bank }} {{ $data['rekening']->cabang }}</strong><br>
                    <strong>SWIFT CODE : {{ $data['rekening']->swift }}</strong><br>
                    <strong>Rek IDR : {{ $data['rekening']->nomor }}</strong><br>
                    <strong>A/n : {{ $data['rekening']->pemilik }}</strong><br>
                </div>
                <div class="col-sm-4 text-start ">
                    <div class="row invoice-result">

                        <div class="col-sm-4 text-start">
                            DPP</br>
                            @if ( $data['invoice']->include_ppn)
                            PPN</br>
                            @endif
                            <strong>TOTAL</strong>


                        </div>
                        <div class="col-sm-8 text-end">
                            {{ $data['dpp'] }}</br>
                            @if ( $data['invoice']->include_ppn)
                            {{ $data['ppn'] }}</br>
                            @endif
                            <strong>{{ $data['total'] }}</strong>
                        </div>
                    </div>
                    <div class="col-sm-12 ttd-top">
                        Terimakasih</br>
                        <strong>PT. SEGARA HUTAMA KARYA EXIM</strong>
                    </div>
                    <div class="col-sm-12">
                        @if (str_contains($data['invoice']->stempel, 'stempel1'))
                        <img class="stempel1" src=" {{ asset($data['invoice']->stempel) }}" alt="stempel">
                        @elseif (str_contains($data['invoice']->stempel, 'stempel2'))
                        <img class="stempel2" src=" {{ asset($data['invoice']->stempel) }}" alt="stempel">
                        @elseif (str_contains($data['invoice']->stempel, 'stempel3'))
                        <img class="stempel3" src=" {{ asset($data['invoice']->stempel) }}" alt="stempel">
                        @endif
                    </div>
                    @if (str_contains($data['invoice']->stempel, 'kosong'))
                    <div class="col-sm-12 ttd-bottom" style="margin-top: 80px">
                        <p class="ttd-name">{{ $data['setting']->penandatangan}}</p>
                    </div>
                    @else
                    <div class="col-sm-12 ttd-bottom">
                        <p class="ttd-name">{{ $data['setting']->penandatangan}}</p>
                    </div>
                    @endif
                </div>
            </div>


            <hr>
            <div class="btn-group btn-group-sm d-print-none"> <a href="javascript:window.print()"
                    class="btn btn-light border text-black-50 shadow-none"><i class="fa fa-print"></i> Print &amp;
                    Download</a> </div>
        </footer>
    </div>

</body>

</html>
