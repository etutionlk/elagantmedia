<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    use HasFactory;

    protected $primaryKey = "id";

    protected $fillable = ["ticket_description", "customer_name", "customer_email", "customer_phone_number", "ref_no"];

    public function ticket_reply()
    {
        return $this->hasMany(TicketReply::class, "ticket_id");
    }
}
