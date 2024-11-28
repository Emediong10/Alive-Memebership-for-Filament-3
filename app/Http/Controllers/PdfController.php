<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function __invoke(Payment $payment)
    {
        return Pdf::loadView('pdf', ['record' => $payment])
        ->download($payment->trans_reference . '.pdf');
    }
}
