@extends('layouts.admin')

@section('title')
 @lang('KYC Details')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header justify-content-between">
        <h1>@lang('User Submitted Documents')</h1>
        Government Issued ID's or Passports Are Accepted. No other documents are allowed 
        For Example: Employee ID's or College ID's are Not Acceptable.
        <a href="{{route('admin.kyc.info')}}" class="btn btn-primary"><i class="fas fa-backward"></i> @lang('Back')</a>
    </div>
</section>
@endsection

@section('content')
    <div class="row justify-content-center mb-5">
        <div class="col-md-10 ">
            @if ($info->kyc_info)
            <ul class="list-group">
                @foreach ($info->kyc_info as $key => $item)
                   @if ($key == 'details')
                      @foreach($item as $k => $data)
                        <li class="list-group-item">
                         <h6 class="mb-3">{{ucwords(str_replace('_',' ',$k))}} : </h6>
                          <textarea disabled rows="5" class="form-control">{{$data}}</textarea>
                        </li>
                        @endforeach
         
                   @elseif ($key == 'image')
                       @foreach ($item as $k => $data)
                        <li class="list-group-item">
                          <h6 class="mb-3">{{ucwords(str_replace('_',' ',$k))}} : </h6>
                          <img class="mb-3 w-50" src="{{getPhoto($data)}}" alt="">
                        </li>
                        @endforeach
                    @else
                    <li class="list-group-item">
                          <h6 class="mb-3">{{ucwords(str_replace('_',' ',$key))}} : </h6>
                          <p class="mb-3">{{$item}}</p>
                    </li>
                   @endif

                   
                   @endforeach
                   @if ($info->kyc_status == 2)
                   <li class="list-group-item text-right">
                        @if (access('kyc reject'))
                        <button class="btn btn-danger mr-2" data-toggle="modal" data-target="#rejectModal"><i class="fas fa-ban"></i> @lang('Reject')</button>
                        @endif
                        @if (access('kyc approve'))
                        <button class="btn btn-success" data-toggle="modal" data-target="#approveModal"><i class="fas fa-check"></i> @lang('Approved')</button>
                        @endif
                   </li>
                   @endif
                
            </ul>
            @else
            <h4 class="text-center">@lang('No data submitted')</h4>
            @endif
        </div>
            
    </div>

    
    <!-- Modal -->
    @if (access('kyc reject'))
    <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{route('admin.kyc.reject',$info->id)}}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('Reject KYC')</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <label for="">@lang('Reject Reasons')</label>
                       <textarea name="reason" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-danger">@lang('Reject')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif
    @if (access('kyc approve'))
    <div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{route('admin.kyc.approve',$info->id)}}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('Approve User')</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                      <h6>@lang('Please Confirm your request')</h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">@lang('No Cancel')</button>
                        <button type="submit" class="btn btn-primary">@lang('Yes Approve')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif
@endsection