@extends('layouts.admin')

@section('title')
   @langg('Login info : '.$user->name)
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header">
        <h1>@langg('Login info : '.$user->name)</h1>
    </div>
</section>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
   
                <div class="card-body text-center">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>@langg('User ID')</th>
                                <th>@langg('User')</th>
                                <th>@langg('IP')</th>
                                <th>@langg('City')</th>
                                <th>@langg('Country')</th>
                            </tr>
                            @forelse ($loginInfo as $key => $item)
                                <tr>
                                    <td data-label="@langg('Sl')">{{$key + $loginInfo->firstItem()}}</td>
                                     <td data-label="@langg('User')">
                                       {{$item->user->email}}
                                     </td>
                                     <td data-label="@langg('IP')">{{$item->ip}}</td>
                                     <td data-label="@langg('City')">{{$item->city}}</td>
                                     <td data-label="@langg('Country')">{{$item->country}}</td>
                                   
                                </tr>
                             @empty
    
                                <tr>
                                    <td class="text-center" colspan="100%">@langg('No Data Found')</td>
                                </tr>
    
                            @endforelse
                        </table>
                    </div>
                </div>
                @if ($loginInfo->hasPages())
                    {{ $loginInfo->links('admin.partials.paginate') }}
                @endif
            </div>
        </div>
    </div>
@endsection