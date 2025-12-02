<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\User;
use App\Mail\TicketCreated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
{
    // Ensure authentication for most routes
    public function __construct()
    {
        $this->middleware('auth')->except(['anonymousView']);
    }

    // Show all tickets (paginated)
    public function index(Request $request)
    {
        $query = Ticket::query();

        // Filter by date range
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        // Sorting
        if ($request->sort_by) {
            $query->orderBy($request->sort_by);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $tickets = $query->paginate(10);
        return view('tickets.index', compact('tickets'));
    }

    // Show form to create a new ticket
    public function create()
    {
        return view('tickets.create');
    }

    // Store a new ticket
    public function store(Request $request)
    {
        $data = $request->validate([
            'category' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'issue' => 'required|string',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
        ]);

        $data['status'] = 'new';
        $data['user_id'] = Auth::id();

        $ticket = Ticket::create($data);

        // Send email notification
        // TODO: Configure SMTP settings in .env file before enabling email
        // Uncomment the lines below when ready to send emails:
        // try {
        //     Mail::to($ticket->email)->send(new TicketCreated($ticket));
        // } catch (Exception $e) {
        //     Log::warning('Failed to send ticket email for ID ' . $ticket->id . ': ' . $e->getMessage());
        // }

        return redirect()->route('tickets.index')->with('success', 'Ticket logged successfully.');
    }

    // Show a single ticket (for authenticated users)
    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    // Update ticket status
    public function updateStatus(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:new,in progress,resolved'
        ]);

        $ticket->status = $request->status;
        $ticket->save();

        return redirect()->back()->with('success', 'Status updated.');
    }

    // Anonymous view by ticket ID
    public function anonymousView($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('tickets.anonymous', compact('ticket'));
    }
}

