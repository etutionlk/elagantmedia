<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketReply extends Model
{
    use HasFactory;

    protected $fillable = ["ticket_id","agent_id","reply_description"];

    public function support_ticket()
    {
        return $this->belongsTo(SupportTicket::class);
    }

    public function agent()
    {
        return $this->belongsTo(User::class, "agent_id");
    }
}
