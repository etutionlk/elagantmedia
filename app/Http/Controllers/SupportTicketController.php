<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Mail;

class SupportTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customer_name = "";
        $tickets = SupportTicket::where([
            ["customer_name","!=",null],
            [function ($query) use ($request) {
                if (($cus_name = $request->customer_name)) {
                    $query->orWhere("customer_name", "LIKE", "%".$cus_name."%");
                }
            }]
        ])->paginate(10);

        if (isset($request->customer_name)) {
            $customer_name = $request->customer_name;
        }

        return view("ticket.list")
            ->with("customer_name", $customer_name)
            ->with("tickets", $tickets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("ticket.add");
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
            "customer_name"=>"required",
            "customer_email"=>"required|email:rfc",
            "customer_phone_number"=>"required|numeric",
            "ticket_description"=>"required",
        ]);

        $ref_no = $this->generateTicketNo(10);

        $data = array_merge($request->all(), ["ref_no" =>$ref_no]);
        $ticket = SupportTicket::create($data);

        $content = "Hello ".\request("customer_name").",\n
        We have Created Trouble Ticket For you. \n
        Your Ticket Reference No-".$ref_no;
        Mail::raw($content, function ($message) use ($ref_no) {
            $message->to(\request("customer_email"))
                ->from("admin@gmail.com")
                ->subject("Your Ticket ID - #".$ref_no);
        });

        if (Auth::guest()) {
            return redirect(route("ticket.show", $ticket->id));
        } else {
            return redirect(route("ticket.index"));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SupportTicket  $supportTicket
     * @return \Illuminate\Http\Response
     */
    public function show(SupportTicket $supportTicket)
    {
        return view("ticket.edit")->with("ticket", $supportTicket);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SupportTicket  $supportTicket
     * @return \Illuminate\Http\Response
     */
    public function edit(SupportTicket $supportTicket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SupportTicket  $supportTicket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SupportTicket $supportTicket)
    {
        //
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function search(Request $request)
    {
        $request->validate(["ticket_id"=>"required"]);

        $ticket = SupportTicket::where([
            ["ref_no","!=",null],
            [function ($query) use ($request) {
                if (($ticket_id = $request->ticket_id)) {
                    $query->orWhere("ref_no", "=", $ticket_id);
                }
            }]
        ])->first();

        return view('welcome')->with("ticket", $ticket);
    }

    //generate ticketNo
    public function generateTicketNo($length)
    {
        $number = '';

        do {
            for ($i=$length; $i--; $i>0) {
                $number .= mt_rand(0, 9);
            }
        } while (!empty(SupportTicket::where('ref_no', $number)->first(['ref_no'])));

        return $number;
    }
}
