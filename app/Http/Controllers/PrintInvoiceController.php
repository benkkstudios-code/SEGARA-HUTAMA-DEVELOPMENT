<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use App\Models\Angkutan;
use App\Http\Requests\StoreAngkutanRequest;
use App\Http\Requests\UpdateAngkutanRequest;
use App\Libraries\Benkkstudios;
use App\Models\DebitNote;
use App\Models\Invoice as Model;
use App\Models\Perusahaan;
use App\Models\Rekening;
use App\Models\Settings;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use DateTime;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;


class PrintInvoiceController extends Controller
{

    public function print(Model $record)
    {
        return view('invoice')->with('data', Benkkstudios::calculateInvoice($record));
    }

    function includePPN($record): bool
    {
        return $record->include_ppn;
    }

    function includePPH($record)
    {
        return $record->include_pph;
    }


    public function index()
    {
        return view('invoice');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAngkutanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Model $angkutan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Model $angkutan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAngkutanRequest $request, Model $angkutan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Model $angkutan)
    {
        //
    }
}
