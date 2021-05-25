@extends('layouts.admin')

@section('title')
   @langg('Identity Verifications')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header justify-content-between">
        <h1>@langg('Identity Verifications')</h1>
        <form action="">
            <div class="row">
                <div class="col-md-6">
                    <select class="form-control" id="" onChange="window.location.href=this.value">
                        <option value="{{url('admin/kyc-info?status=pending')}}" {{request('status') == 'pending'?'selected':''}}>@lang('Pending')</option>
                        <option value="{{url('admin/kyc-info/?status=approved')}}" {{request('status') == 'approved'?'selected':''}}>@lang('Approved')</option>
                        <option value="{{url('admin/kyc-info/?status=rejected')}}" {{request('status') == 'rejected'?'selected':''}}>@lang('Rejected')</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <div class="input-group has_append ">
                      <input type="text" class="form-control" placeholder="@lang('email')" name="search" value=""/>
                      <div class="input-group-append">
                          <button class="input-group-text bg-primary border-0"><i class="fas fa-search text-white"></i></button>
                      </div>
                    </div>
                </div>
                
            </div>
          </form>
    </div>
</section>
@endsection

@section('content')
    
<div class="row">

    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
   
            <div class="card-body text-center">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>@lang('sl')</th>
                            <th>@lang('Name')</th>
                            <th>@lang('Email Address')</th>
                            <th>@lang('Identity Status')</th>
                            <th>@lang('More Information')</th>
                        </tr>
                        @forelse ($userKycInfo as $key => $info)
                            <tr>
                                <td data-label="@lang('Sl')">{{$key + $userKycInfo->firstItem()}}</td>
                    
                                 <td data-label="@lang('Name')">
                                   {{$info->name}}
                                 </td>
                                 <td data-label="@lang('Email')">{{$info->email}}</td>
                                 <td data-label="@lang('KYC Status')">
                                    @if($info->kyc_status == 1)
                                        <span class="badge badge-success">@lang('Approved')</span>
                                    @elseif($info->kyc_status == 2)
                                         <span class="badge badge-warning">@lang('Pending')</span>
                                    @elseif($info->kyc_status == 3)
                                        <span class="badge badge-danger">@lang('Rejected')</span>
                                    @endif
                                 </td>
                                 @if (access('kyc details'))
                                 <td data-label="@lang('Details')">
                                     <a class="btn btn-info details" href="{{route('admin.kyc.details',$info->id)}}">@lang('View Documents')</a>
                                 </td>
                                 @else
                                 <td>@lang('N/A')</td>
                                 @endif
                               
                            </tr>
                         @empty

                            <tr>
                                <td class="text-center" colspan="100%">@lang('No Data Found')</td>
                            </tr>

                        @endforelse
                    </table>
                </div>
            </div>
            @if ($userKycInfo->hasPages())
                {{ $userKycInfo->links('admin.partials.paginate') }}
            @endif
        </div>
    </div>
</div>




@endsection
