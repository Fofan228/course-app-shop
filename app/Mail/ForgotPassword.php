<?php

    namespace App\Mail;

    use Illuminate\Bus\Queueable;
    use Illuminate\Mail\Mailable;
    use Illuminate\Mail\Mailables\Address;
    use Illuminate\Mail\Mailables\Content;
    use Illuminate\Mail\Mailables\Envelope;
    use Illuminate\Queue\SerializesModels;

    class ForgotPassword extends Mailable
    {
        use Queueable;
        use SerializesModels;

        protected $password;
        /**
         * Create a new message instance.
         */
        public function __construct($password)
        {
            $this->password = $password;
        }

        /**
         * Get the message envelope.
         */
        public function envelope(): Envelope
        {
            return new Envelope(
                from: new Address('course-shop-app@yandex.ru', 'course-shop-app'),
                subject: 'Восстановление пароля',
            );
        }

        /**
         * Get the message content definition.
         */
        public function content(): Content
        {
            return new Content(
                view: 'emails.forgot',
                with: [
                    "password" => $this->password,
                ]
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
