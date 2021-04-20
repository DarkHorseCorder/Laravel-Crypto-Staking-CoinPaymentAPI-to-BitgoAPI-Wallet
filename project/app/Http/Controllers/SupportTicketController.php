<?php

namespace App\Http\Controllers;

use App\Helpers\MediaHelper;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Models\TicketMessage;

class SupportTicketController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $pref = 'user';
        $tickets = SupportTicket::where('user_id',$user->id)->latest()->paginate(15);
        $messages = TicketMessage::when(request('messages'),function($q){
            return $q->where('ticket_num',request('messages'));
        })->where('user_id',$user->id)->get();

        return view($pref.'.ticket.index',compact('tickets','messages','user'));
    }

    public function openTicket(Request $request)
    {
        $request->validate(['subject'=>'required']);
        $user = auth()->user();
        $pref = 'user';
        $tkt = 'TKT'.randNum(8);
        SupportTicket::create([
            'user_id' => $user->id,
            'ticket_num' => $tkt,
            'subject'  => $request->subject,
        ]);

        return redirect(url($pref.'/support/tickets?messages='.$tkt))->with('success','New ticket has been opened');
    }

    public function replyTicket(Request $request,$ticket_num)
    {
        $request->validate(['message'=>'required_without:file','file'=>'mimes:pdf,jpeg,jpg,png,PNG,JPG']);
        $user = auth()->user();
        $ticket = SupportTicket::where('ticket_num',$ticket_num)->where('user_id',$user->id)
        ->firstOrFail();
        $message = new TicketMessage();
        $message->ticket_id = $ticket->id;
        $message->ticket_num = $ticket->ticket_num;
        $message->user_id = $user->id;
        $message->message = $request->message;
        if($request->file) $message->file = MediaHelper::handleMakeImage($request->file,null,true);
        $message->save();

        $ticket->status = 0;
        $ticket->save();
        return back()->with('success','Replied successfully');
    }
}


