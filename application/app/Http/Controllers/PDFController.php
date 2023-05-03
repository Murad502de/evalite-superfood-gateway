<?php

namespace App\Http\Controllers;

class PDFController extends Controller
{
    public function preview()
    {
        return view('agency_contract');
    }

    public function generatePDF()
    {}
}
