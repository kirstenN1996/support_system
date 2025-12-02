<?php

namespace App\Mail;

use App\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;

    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function build()
    {
        return $this->from(config('mail.from.address') ?: 'noreply@support.local', config('mail.from.name') ?: 'Support System')
                    ->subject('Your Support Ticket #' . $this->ticket->id . ' Has Been Logged')
                    ->markdown('emails.ticket_created');
    }
}
