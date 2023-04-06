<?php

    namespace App\Mail;

    use Illuminate\Bus\Queueable;
    use Illuminate\Mail\Mailable;
    use Illuminate\Mail\Mailables\Address;
    use Illuminate\Mail\Mailables\Attachment;
    use Illuminate\Mail\Mailables\Content;
    use Illuminate\Mail\Mailables\Envelope;
    use Illuminate\Queue\SerializesModels;

    class SaveOrder extends Mailable
    {
        use Queueable;
        use SerializesModels;

        protected $order;

        /**
         * Create a new message instance.
         */
        public function __construct($order)
        {
            $this->order = $order;
        }

        /**
         * Get the message envelope.
         */
        public function envelope(): Envelope
        {
            return new Envelope(
                from: new Address('course-shop-app@yandex.ru', 'course-shop-app'),
                subject: 'Заказ оформлен',
            );
        }

        /**
         * Get the message content definition.
         */
        public function content(): Content
        {
            return new Content(
                view: 'emails.order',
                with: [
                    "order" => $this->order,
                ]
            );
        }

        /**
         * Get the attachments for the message.
         *
         * @return array<int, Attachment>
         */
        public function attachments(): array
        {
            return [];
        }
    }
