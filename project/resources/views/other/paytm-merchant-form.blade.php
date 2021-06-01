@extends('layouts.user')

@section('content')
<center><h1>{{ __('Please do not refresh this page...') }}</h1></center>
<form method="post" action="{{ $paytm_txn_url }}" name="f1">
    {{ csrf_field()  }}
    <table border="1">
        <tbody>
		<?php
		foreach($paramList as $name => $value) {
			echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
		}
		?>
        <input type="hidden" name="CHECKSUMHASH" value="<?php echo $checkSum ?>">
        </tbody>
    </table>
    
</form>

@endsection

@push('script')
<script type="text/javascript">

(function($) {
		"use strict";
    document.f1.submit();

})(jQuery);

</script>
@endpush