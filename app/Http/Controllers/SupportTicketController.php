<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;

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
            ["customer_name","!=",Null],
            [function ($query) use ($request){
                if(($cus_name = $request->customer_name)){
                    $query->orWhere("customer_name","LIKE","%".$cus_name."%");
                }
            }]
        ])->paginate(10);

        if (isset($request->customer_name)) {
            $customer_name = $request->customer_name;
        }
//        $tickets = SupportTicket::paginate(10);
        return view("ticket.list")
            ->with("customer_name",$customer_name)
            ->with("tickets",$tickets);
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

        //get last id
//        $last = SupportTicket::latest()->first();

        $tk = "TKT001";

        $data = array_merge($request->all(),["ref_no" =>$tk]);
        SupportTicket::create($data);

        return redirect(route("ticket.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SupportTicket  $supportTicket
     * @return \Illuminate\Http\Response
     */
    public function show(SupportTicket $supportTicket)
    {
        return view("ticket.edit")->with("ticket",$supportTicket);
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
    public function search()
    {
        echo "Dsdss"; die();
        $ticket = SupportTicket::where([
            ["ticket_id","!=",Null],
            [function ($query) use ($request){
                if(($ticket_id = $request->ticket_id)){
                    $query->orWhere("ticket_id","=",$ticket_id);
                }
            }]
        ])->first();

        return view('welcome');
    }
}
