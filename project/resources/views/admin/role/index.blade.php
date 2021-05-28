@extends('layouts.admin')

@section('title')
   @langg('Manage Roles')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header justify-content-between">
        <h1>@langg('Manage Roles')</h1>
        <a href="{{route('admin.role.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> @langg('Add New Role')</a>
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
                            <th>@langg('Action')</th>
                        </tr>
                        @forelse ($roles as $key => $role)
                            @if ($role->name != 'admin')
                                <tr>
                                    <td data-label="@langg('Sl')">{{$key}}</td>
                        
                                    <td data-label="@langg('Name')">
                                    {{$role->name}}
                                    </td>
                                    @if (access('edit permissions'))
                                    <td data-label="@langg('Action')">
                                        <a class="btn btn-primary" href="{{route('admin.role.edit',$role->id)}}">@langg('Permissions')</a>
                                    </td>
                                    @endif
                                
                                </tr>
                                
                            @endif
                         @empty

                            <tr>
                                <td class="text-center" colspan="100%">@langg('No Data Found')</td>
                            </tr>

                        @endforelse
                    </table>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection