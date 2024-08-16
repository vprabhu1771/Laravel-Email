Define a route in your web.php file:

use App\Http\Controllers\WelcomeEmailController;

Route::get('/send-welcome-email', [WelcomeEmailController::class, 'index']);
