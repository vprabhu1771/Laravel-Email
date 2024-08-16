# Laravel Send Mail With PDF Without Store in Local
 
https://github.com/barryvdh/laravel-dompdf

```
composer require barryvdh/laravel-dompdf
```

```
php artisan make:controller InvoiceController
```

3. open `InvoiceController.php`

```
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
```

3. open `pdf/invoice.blade.php`

```
<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>Date: {{ $date }}</p>
    <!-- Add more content for the invoice here -->
</body>
</html>
```

4. open `email/invoice.blade.php`

```
<!DOCTYPE html>
<html>
<head>
    <title>Invoice Email</title>
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>Your invoice is attached to this email.</p>
    <!-- Add more email content here -->
</body>
</html>
```


5. open `web.php`

```
use App\Http\Controllers\InvoiceController;

Route::post('/send-invoice', [InvoiceController::class, 'sendInvoice']);
```