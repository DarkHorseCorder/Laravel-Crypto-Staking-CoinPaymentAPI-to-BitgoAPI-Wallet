<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MediaHelper;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Models\TicketMessage;
use App\Http\Controllers\Controller;

class ManageTicketController extends Controller
{
    public function index()
    {
        $search = request('search');
        $tickets = SupportTicket::when($search,function($q) use($search){ 
            return $q->where('ticket_num','like',"%$search%");
        })->with(['user'])
        ->whereHas('messages')->latest()->paginate(15);

        $messages = TicketMessage::when(request('messages'),function($q){
            return $q->where('ticket_num',request('messages'));
        })->get();

        return view('admin.ticket.index',compact('tickets','messages','search'));
    }

    public function replyTicket(Request $request,$ticket_num)
    {
        $request->validate(['message'=>'required','file'=>'mimes:pdf,jpeg,jpg,png,PNG,JPG']);
        $ticket = SupportTicket::where('ticket_num',$ticket_num)->firstOrFail();

        $message = new TicketMessage();
        $message->ticket_id      = $ticket->id;
        $message->ticket_num     = $ticket->ticket_num;
        $message->user_id        = $ticket->user_id;
        $message->admin_id       = admin()->id;
        $message->message        = $request->message;
        if($request->file) $message->file = MediaHelper::handleMakeImage($request->file,null,true);
        $message->save();

        $ticket->status = 1;
        $ticket->save();
        return back()->with('success','Replied');
    }
}
