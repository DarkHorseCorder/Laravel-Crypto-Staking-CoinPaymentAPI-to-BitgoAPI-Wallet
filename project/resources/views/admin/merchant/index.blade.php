@extends('layouts.admin')

@section('title')
   @langg('Manage Merchant')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header justify-content-between">
        <h1> @langg('Manage Merchant')</h1>
        <form action="">
            <div class="row">
                <div class="col-md-6">
                    <select class="form-control" id="" onChange="window.location.href=this.value">
                        <option value="{{url('admin/manage-merchants/'.'?status=all')}}" {{request('status') == 'all'?'selected':''}}>@langg('All')</option>
                        <option value="{{url('admin/manage-merchants/'.'?status=active')}}" {{request('status') == 'active'?'selected':''}}>@langg('Active')</option>
                        <option value="{{url('admin/manage-merchants/'.'?status=banned')}}" {{request('status') == 'banned'?'selected':''}}>@langg('Banned')</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <div class="input-group has_append ">
                      <input type="text" class="form-control" placeholder="@langg('email')" name="search" value="{{$search ?? ''}}"/>
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
                            <th>@langg('Sl')</th>
                            <th>@langg('Name')</th>
                            <th>@langg('Email')</th>
                            <th>@langg('Country')</th>
                            <th>@langg('Status')</th>
                            <th>@langg('Action')</th>
                        </tr>
                        @forelse ($users as $key => $user)
                            <tr>
                                <td data-label="@langg('Sl')">{{$key + $users->firstItem()}}</td>
                    
                                 <td data-label="@langg('Name')">
                                   {{$user->name}}
                                 </td>
                                 <td data-label="@langg('Email')">{{$user->email}}</td>
                                 <td data-label="@langg('Country')">{{$user->country}}</td>
                                 <td data-label="@langg('Status')">
                                    @if($user->status == 1)
                                        <span class="badge badge-success">@langg('active')</span>
                                    @elseif($user->status == 2)
                                         <span class="badge badge-danger">@langg('banned')</span>
                                    @endif
                                 </td>
                                 @if (access('edit merchant'))
                                 <td data-label="@langg('Action')">
                                     <a class="btn btn-primary details" href="{{route('admin.merchant.details',$user->id)}}">@langg('Details')</a>
                                 </td>
                                 @endif
                               
                            </tr>
                         @empty

                            <tr>
                                <td class="text-center" colspan="100%">@langg('No Data Found')</td>
                            </tr>

                        @endforelse
                    </table>
                </div>
            </div>
            @if ($users->hasPages())
                {{ $users->links('admin.partials.paginate') }}
            @endif
        </div>
    </div>
</div>
@endsection