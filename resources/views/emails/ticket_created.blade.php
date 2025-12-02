@component('mail::message')
# Ticket Logged Successfully

Thank you for contacting us. Your ticket details:

- **ID**: #{{ $ticket->id }}
- **Category**: {{ ucfirst($ticket->category) }}
- **Issue**: {{ $ticket->issue }}
- **Status**: {{ ucfirst($ticket->status) }}

Click below to view your ticket status anonymously:

@component('mail::button', ['url' => route('ticket.anonymous', $ticket->id)])
View Ticket Status
@endcomponent

If you have any questions, reply to this email.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
