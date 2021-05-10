<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketMessage extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
  

    public function ticket()
    {
        return $this->belongsTo(SupportTicket::class,'ticket_id')->withDefault();
    }
}
