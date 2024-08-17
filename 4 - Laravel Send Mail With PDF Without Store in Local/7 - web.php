use App\Http\Controllers\InvoiceController;

Route::post('/send-invoice', [InvoiceController::class, 'sendInvoice']);
