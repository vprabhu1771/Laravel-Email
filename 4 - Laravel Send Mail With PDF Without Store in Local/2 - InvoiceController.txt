<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PDF;
use Illuminate\Support\Facades\Mail;

class InvoiceController extends Controller
{
    // Method to send invoice
    public function sendInvoice(Request $request)
    {
        $data = [
            'title' => 'Invoice Title',
            'date' => date('m/d/Y'),
        ];

        // Generate the PDF
        $pdf = PDF::loadView('pdf.invoice', $data);

        // Send email with the invoice attached
        Mail::send('emails.invoice', $data, function($message) use ($pdf) {
            $message->to('recipient@example.com', 'Recipient Name')
                    ->subject('Invoice')
                    ->attachData($pdf->output(), "invoice.pdf");
        });

        return response()->json(['message' => 'Invoice sent successfully!']);
    }

}
