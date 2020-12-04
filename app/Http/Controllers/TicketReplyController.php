<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use App\Models\TicketReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TicketReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "ticket_reply"=>"required"
        ]);

        $id = 0;

        $ticket = SupportTicket::find($request->ticket_id);

        if (Auth::check() )
        {
            $id = Auth::id();

            //agent reply
//            $data = SupportTicket::find($request->ticket_id);
            $content = "Hello ".$ticket->customer_name.",\nWe have Replied to your Support Ticket.";
            $title = "Reply Ticket ID - #".($ticket->ref_no).".";

            Mail::raw($content, function ($message) use ($title, $ticket) {
                $message->to($ticket->customer_email)
                    ->from("admin@gmail.com")
                    ->subject($title);
            });

            //update the ticket
            $ticket->ticket_status = 5;
        } else {
            //update the ticket
            $ticket->ticket_status = 2;
        }

        if (!empty($request->get("is_resolved"))) {
            //update the ticket
            $ticket->ticket_status = 4;
        }

        $ticket->save();

        TicketReply::create([
            "reply_description"=> $request->get("ticket_reply"),
            "ticket_id" => $request->get("ticket_id"),
            "agent_id" => $id
        ]);

        return redirect(route("ticket.show", $ticket));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TicketReply  $ticketReply
     * @return \Illuminate\Http\Response
     */
    public function show(TicketReply $ticketReply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TicketReply  $ticketReply
     * @return \Illuminate\Http\Response
     */
    public function edit(TicketReply $ticketReply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TicketReply  $ticketReply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TicketReply $ticketReply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TicketReply  $ticketReply
     * @return \Illuminate\Http\Response
     */
    public function destroy(TicketReply $ticketReply)
    {
        //
    }
}
