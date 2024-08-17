# Laravel 10 Send Mail by Gmail SMTP

1. **Folder Setup**

*Folder Setup*

```
project_folder - resources -> views -> email
```

*File Setup*

```
project_folder - resources -> views -> email -> welcome_email.blade.php
```

2. **Generate Mail**

```
php artisan make:mail WelcomeEmail
```

3. **open** ` WelcomeEmail.php`

```
<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject, $body;

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $body)
    {
        $this->subject = $subject;
        $this->body = $body;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        //  resources\views\welcome_email.blade.php
        return new Content(
            view: 'email.welcome_email',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
```
4. **open** `welcome_email.blade.php`

```
<!-- resources\views\email\welcome_email.blade.php -->

{!! $body !!}
```

5. **Generate WelcomeEmailController**
```
php artisan make:controller WelcomeEmailController
```

6. **open** `WelcomeEmailController.php`

```
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use App\Mail\WelcomeEmail;

class WelcomeEmailController extends Controller
{
    public function index() 
    {
        $subject = "Test Welcome Subject";
        $body = "Test Welcome Message";

        Mail::to('recipient@gmail.com')->send(new WelcomeEmail($subject, $body));
    }
}

```

7. **open** `web.php`

Define a route in your web.php file:
```
use App\Http\Controllers\WelcomeEmailController;

Route::get('/send-welcome-email', [WelcomeEmailController::class, 'index']);
```