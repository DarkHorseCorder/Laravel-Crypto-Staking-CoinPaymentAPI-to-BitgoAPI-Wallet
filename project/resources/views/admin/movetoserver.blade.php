@extends('layouts.admin')
@section('title')
   @langg('Generate BackUp')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header">
        <h1>@langg('Generate BackUp')</h1>
    </div>
</section>
@endsection
@section('content')
	<div class="row">
		<div class="col-lg-12">
			<div class="card"> 
				<div class="card-body">
					<div class="product-description">
						<div class="body-area">
		
					<div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
							@include('admin.partials.form-both')
		
							<div style="padding: 10px;" class="text-center">
								@if($bkuplink == "")
									<span id="bkupData">{{ __('No Backup File Generated.') }}</span>
								@else
									<span id="bkupData"><a href="{{$bkuplink}}">{{$chk}}</a><a href="{{route('admin-clear-backup')}}"> <i class="fa fa-times-circle"></i></a></span>
								@endif
							</div>
							<hr/>
							<div class="add-product-footer text-center">
								<button name="addProduct_btn" id="generateBkup" type="button" class="addProductSubmit-btn btn btn-primary">{{ __('Generate Backup') }}</button>
							</div>
		
		
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		

@endsection

@section('scripts')
	<script type="text/javascript">

        $("#generateBkup").click(function(){
            $('#bkupData').html('<p>{{ __('Generating Backup... Please wait....') }}</p>');
            $.ajax({
                url: "{{url('admin/check/movescript')}}",
                success: function(result){
                    if(result.status == 'success'){
                        $("#bkupData").html('<a href="'+result.backupfile+'">'+result.filename+'</a>');
                    }
                }
            });
        });

	</script>

@endsection