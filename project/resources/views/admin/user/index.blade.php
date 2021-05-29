@extends('layouts.admin')

@section('title')
   @langg('Manage User')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header justify-content-between">
        <h1> @langg('Manage User Accounts')</h1>
        <form action="">
            <div class="row">
                <div class="col-md-6">
                    <select class="form-control" id="" onChange="window.location.href=this.value">
                        <option value="{{url('admin/manage-users/'.'?status=all')}}" {{request('status') == 'all'?'selected':''}}>@langg('All Users')</option>
                        <option value="{{url('admin/manage-users/'.'?status=active')}}" {{request('status') == 'active'?'selected':''}}>@langg('Active Users')</option>
                        <option value="{{url('admin/manage-users/'.'?status=banned')}}" {{request('status') == 'banned'?'selected':''}}>@langg('Disabled Users')</option>
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
            <div class="card-header d-flex justify-content-end">
                <a href="{{route('admin.mail.group.show')}}" class="btn btn-primary"><i class="fa-solid fa-paper-plane"></i> @langg('Send Group Mail')</a>
            </div>
            <div class="card-body text-center">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>@langg('User ID')</th>
                            <th>@langg('User Name')</th>
                            <th>@langg('Email Address')</th>
                            <th>@langg('Country')</th>
                            <th>@langg('Account Status')</th>
                            <th>@langg('Email Verified')</th>
                            <th>@langg('View/Modify Accounts')</th>
                        </tr>
                        @forelse ($users as $key => $user)
                            <tr>
                                <td data-label="@langg('User ID')">{{$key + $users->firstItem()}}</td>
                    
                                 <td data-label="@langg('User Name')">
                                   {{$user->name}}
                                 </td>
                                 <td data-label="@langg('Email')">{{$user->email}}</td>
                                 <td data-label="@langg('Country')">{{$user->country}}</td>
                                 <td data-label="@langg('Status')">
                                    @if($user->status == 1)
                                        <span class="badge badge-success">@langg('Active')</span>
                                    @else
                                         <span class="badge badge-danger">@langg('Disabled')</span>
                                    @endif
                                 </td>
                                 <td data-label="@langg('Email Verified')">
                                    @if($user->email_verified == 1)
                                        <span class="badge badge-success"><i class="fa-solid fa-check"></i> @langg('Yes')</span>
                                    @else
                                         <span class="badge badge-danger"><i class="fa-solid fa-ban"></i> @langg('No')</span>
                                    @endif
                                 </td>
                                 @if (access('edit user'))
                                 <td data-label="@langg('Action')">
                                     <a class="btn btn-primary btn-sm details" href="{{route('admin.user.details',$user->id)}}"><i class="fa-solid fa-arrow-right"></i> @langg('Modify') </a>
                                 </td>
                                 @else
                                 N/A
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


