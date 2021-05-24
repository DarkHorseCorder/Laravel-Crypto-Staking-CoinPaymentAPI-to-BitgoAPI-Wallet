
<li class="list-group-item d-flex justify-content-between">@langg('Transaction ID')<span>{{$transaction->trnx}}</span></li>
<li class="list-group-item d-flex justify-content-between">@langg('Remark')<span class="badge badge-primary">{{ucwords(str_replace('_',' ',$transaction->remark))}}</span></li>
<li class="list-group-item d-flex justify-content-between">@langg('Currency')<span class="font-weight-bold">{{$transaction->currency->code}}</span></li>
<li class="list-group-item d-flex justify-content-between">@langg('Amount')<span class="badge {{$transaction->type == '+' ? 'badge-success':'badge-danger'}}">{{$transaction->type}}{{amount($transaction->amount,$transaction->currency->type,2)}} {{$transaction->currency->code}}</span></li>
<li class="list-group-item d-flex justify-content-between">@langg('Charge')<span>{{amount($transaction->charge,$transaction->currency->type,2)}} {{$transaction->currency->code}}</span></li>

<li class="list-group-item d-flex justify-content-between">@langg('Date')<span>{{dateFormat($transaction->created_at,'d M y')}}</span></li>