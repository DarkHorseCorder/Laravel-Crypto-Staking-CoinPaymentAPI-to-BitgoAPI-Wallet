
<li class="list-group-item d-flex justify-content-between font-weight-bold">@langg('Created at :')<span>{{$offer->created_at->format('d M Y')}}</span></li>
<li class="list-group-item d-flex justify-content-between font-weight-bold">@langg('Rate :')<span class="text-primary">{{amount($offer->crypto->rate).' '.$offer->fiat->code.'/'.$offer->crypto->code}}</span></li>

<li class="list-group-item d-flex justify-content-between font-weight-bold">@langg('Minimum Limit :')<span class="font-weight-bold">{{amount($offer->minimum)}} {{$offer->fiat->code}}</span></li>

<li class="list-group-item d-flex justify-content-between font-weight-bold">@langg('Maximum Limit :')<span class="font-weight-bold">{{amount($offer->maximum)}} {{$offer->fiat->code}}</span></li>

<li class="list-group-item">
    <div class="form-group">
        <h6 class="">@langg('Offer Terms')</h6>
        <textarea class="form-control" disabled rows="5">@langg($offer->offer_terms)</textarea>
    </div>
</li>
<li class="list-group-item">
    <div class="form-group">
        <h6 class="">@langg('Trade Instructions')</h6>
        <textarea class="form-control" disabled rows="5">@langg($offer->trade_instructions)</textarea>
    </div>
</li>
