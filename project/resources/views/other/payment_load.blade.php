
@if (in_array($gateway->keyword,['stripe','authorize']))
<div class="card border-0 mt-5">
    <div class="card-header">
        <h4>@langg('Card Information')</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <input type="text" name="card_number" class="form-control" placeholder="@langg('Card Number')">
            </div>
            <div class="col-4">
                <input type="text" name="cvc" class="form-control" placeholder="@langg('CVC')">
            </div>
            <div class="col-2">
                <input type="text" name="month" class="form-control" placeholder="@langg('Month')">
            </div>
            <div class="col-2">
                <input type="text" name="year" class="form-control" placeholder="@langg('Year')">
            </div>
        </div>
    </div>
</div>
@endif


@if ($gateway->keyword == 'paystack')
    <input type="hidden" id="ref_id" name="ref_id" value="">
@endif


@if ($gateway->keyword == 'mercadopago')
<div class="row mt-3">
    <div class="col-lg-6 mb-2">
      <input class="form-control" type="text" placeholder="{{ __('Credit Card Number') }}" id="cardNumber" data-checkout="cardNumber" onselectstart="return false" autocomplete=off required />
    </div>

    <div class="col-lg-6 mb-2">
      <input class="form-control" type="text" id="securityCode" data-checkout="securityCode" placeholder="{{ __('Security Code') }}" onselectstart="return false" autocomplete=off required />
    </div>

    <div class="col-lg-6 mb-2">
      <input class="form-control" type="text" id="cardExpirationMonth" data-checkout="cardExpirationMonth" placeholder="{{ __('Expiration Month') }}" autocomplete=off required />
    </div>

    <div class="col-lg-6 mb-2">
    <input class="form-control" type="text" id="cardExpirationYear" data-checkout="cardExpirationYear" placeholder="{{ __('Expiration Year') }}" autocomplete=off required />
    </div>

    <div class="col-lg-6 mb-2">
      <input class="form-control" type="text" id="cardholderName" data-checkout="cardholderName" placeholder="{{ __('Card Holder Name') }}" required />
    </div>

    <div class="col-lg-6">
      <label for="docType" class="col-lg-3 pl-0" id="dc-label">{{ __('Document type') }}</label>
        <select class="form-control col-lg-9 pl-0" id="docType" data-checkout="docType" required>
          
        </select>
    </div>

    <div class="col-lg-6">
      <input class="form-control" type="text" id="docNumber" data-checkout="docNumber" placeholder="{{ __('Document Number') }}" required />
    </div>

  </div>


  <input type="hidden" id="installments" value="1" />
  <input type="hidden" name="amount" id="amount" />
  <input type="hidden" name="description" />
  <input type="hidden" name="paymentMethodId" />
@endif

@if ($gateway->type == 'manual')
<div class="row mt-3">
  <div class="form-group col-lg-12">
    <h3>@langg('Deposit Instruction')</h3>
    <p>
      @php
          echo $gateway->details;
      @endphp
    </p>
  </div>

  <div class="form-group col-lg-12">
    <label class="my-3">@langg('Please provide your transaction details')</label>
    <textarea name="trx_details" class="form-control" id="" cols="30" rows="10"></textarea>
  </div>
  <input type="hidden" name="type"  value="manual">

</div>
@endif