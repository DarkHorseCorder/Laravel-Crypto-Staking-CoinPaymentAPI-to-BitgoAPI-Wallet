@extends('layouts.admin')

@section('title')
   @langg('Manage Staff')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header justify-content-between">
        <h1> @langg('Manage Staff')</h1>
        @if(access('add staff'))
            <a href="javascript:void(0)" data-toggle="modal" data-target="#addModal" class="btn btn-primary add"><i class="fas fa-plus"></i> @langg('Add New Staff')</a>
        @endif
    </div>
</section>
@endsection

@section('content')
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <form action="" class="card-header justify-content-end">
                    <div class="row flex-grow-1 flex-sm-grow-0">
                        <div class="col-sm-6 my-2">
                            <select class="form-control" id="" onChange="window.location.href=this.value">
                                <option value="{{url('admin/manage/staff'.'?status=all')}}" {{request('status') == 'all'?'selected':''}}>@langg('All')</option>
                                <option value="{{url('admin/manage/staff'.'?status=active')}}" {{request('status') == 'active'?'selected':''}}>@langg('Active')</option>
                                <option value="{{url('admin/manage/staff'.'?status=banned')}}" {{request('status') == 'banned'?'selected':''}}>@langg('Banned')</option>
                            </select>
                        </div>
                        <div class="col-sm-6 my-2">
                            <div class="input-group has_append ">
                              <input type="text" class="form-control" placeholder="@langg('email')" name="search" value="{{$search ?? ''}}"/>
                              <div class="input-group-append">
                                  <button class="input-group-text bg-primary border-0"><i class="fas fa-search text-white"></i></button>
                              </div>
                            </div>
                        </div>
                        
                    </div>
                </form>
   
            <div class="card-body text-center">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>@langg('Sl')</th>
                            <th>@langg('Name')</th>
                            <th>@langg('Email')</th>
                            <th>@langg('Role')</th>
                            <th>@langg('Status')</th>
                            <th>@langg('Action')</th>
                        </tr>
                        @forelse ($staffs as $key => $user)
                          
                            <tr>
                                <td data-label="@langg('Sl')">{{$key + $staffs->firstItem()}}</td>
                    
                                 <td data-label="@langg('Name')">
                                   {{$user->name}}
                                 </td>
                                 <td data-label="@langg('Email')">{{$user->email}}</td>
                                 <td data-label="@langg('Role')">
                                     <span class="badge badge-dark">{{strtoupper($user->role)}}</span>
                                 </td>
                                 <td data-label="@langg('Status')">
                                    @if($user->status == 1)
                                        <span class="badge badge-success">@langg('active')</span>
                                    @elseif($user->status == 2)
                                         <span class="badge badge-danger">@langg('banned')</span>
                                    @endif
                                 </td>

                                <td data-label="@langg('Action')">
                                    <a class="btn btn-primary details" data-staff="{{$user}}" href="javascript:void(0)" data-route="{{route('admin.staff.update',$user->id)}}">@langg('Details')</a>
                                </td>
                               
                            </tr>
                         @empty

                            <tr>
                                <td class="text-center" colspan="100%">@langg('No Data Found')</td>
                            </tr>

                        @endforelse
                    </table>
                </div>
            </div>
            @if ($staffs->hasPages())
                {{ $staffs->links('admin.partials.paginate') }}
            @endif
        </div>
    </div>
</div>

<!-- Modal -->
@if (access('add staff'))
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{route('admin.staff.add')}}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@langg('Add New Staff')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>@langg('Name')</label>
                        <input class="form-control" type="text" name="name" required value="{{old('name')}}">
                    </div>
                    <div class="form-group">
                        <label>@langg('Email')</label>
                        <input class="form-control" type="email" name="email" required value="{{old('email')}}">
                    </div>
                    <div class="form-group">
                        <label>@langg('Password')</label>
                        <input class="form-control" type="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label>@langg('Confirm Password')</label>
                        <input class="form-control" type="password" name="password_confirmation" required>
                    </div>
                    <div class="append"></div>
                    <div class="form-group">
                        <label>@langg('Select Role')</label>
                        <select name="role" class="form-control">
                            <option value="">Select</option>
                            @foreach ($roles as $item)
                              <option value="{{$item}}">{{$item}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">@langg('Close')</button>
                    <button type="submit" class="btn btn-primary">@langg('Submit')</button>
                </div>
            </div>
        </form>
    </div>
</div>
    
@endif
@endsection

@push('script')
    <script>
        'use strict';
        $('.add').on('click',function () { 
            $('#addModal').find('.append').children().remove()
            $('#addModal').find('form')[0].reset();
        })
        $('.details').on('click',function () { 
            $('#addModal').find('.modal-title').text("@langg('Edit staff')")
            $('#addModal').find('input[name=name]').val($(this).data('staff').name)
            $('#addModal').find('input[name=email]').val($(this).data('staff').email)
            $('#addModal').find('input[name=password]').attr('required',false)
            $('#addModal').find('input[name=password_confirmation]').attr('required',false)
            $('#addModal').find('select[name=role]').val($(this).data('staff').role)

            $('#addModal').find('.append').html(`
                   <div class="form-group">
                        <label>@langg('Status')</label>
                        <select name="status" class="form-control">
                            <option value="1">@langg('Active')</option>
                            <option value="2">@langg('Banned')</option>
                        </select>
                    </div>
            `)
            $(document).find('select[name=status]').val($(this).data('staff').status)
            $('#addModal').find('form').attr('action',$(this).data('route'))
            $('#addModal').modal('show')
        })
    </script>
@endpush