
<li class="list-group-item d-flex justify-content-between">@langg('Transaction ID')<span>{{$transaction->trnx}}</span></li>
<li class="list-group-item d-flex justify-content-between">@langg('Remark')<span class="badge badge--dark">{{ucwords(str_replace('_',' ',$transaction->remark))}}</span></li>
<li class="list-group-item d-flex justify-content-between">@langg('Currency')<span class="font-weight-bold">{{$transaction->currency->code}}</span></li>
<li class="list-group-item d-flex justify-content-between">@langg('Amount')<span class="badge {{$transaction->type == '+' ? 'bg-success':'bg-danger'}}">{{$transaction->type}}{{amount($transaction->amount,$transaction->currency->type,2)}} {{$transaction->currency->code}}</span></li>
<li class="list-group-item d-flex justify-content-between">@langg('Charge')<span>{{amount($transaction->charge,$transaction->currency->type,2)}} {{$transaction->currency->code}}</span></li>
@if ($transaction->invoice_num)
 <li class="list-group-item d-flex justify-content-between">@langg('Invoice')<a target="_blank" href="{{route('user.invoice.view',$transaction->invoice_num)}}">{{$transaction->invoice_num}}</a></li>
@endif
<li class="list-group-item d-flex justify-content-between">@langg('Date')<span>{{dateFormat($transaction->created_at,'d M y')}}</span></li>