@extends('backend.layouts.admin_master')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Vendor list</h4>
                </div>

            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-input">
                                <a class="btn btn-searchset"><img
                                        src="{{ asset('resources/assets/img/icons/search-white.svg') }}" alt="img"></a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table  datanew">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>City</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $vendor)
                                    <tr>
                                        <td class="">
                                            {{ $vendor->name }}
                                        </td>
                                        <td class="">
                                            {{ $vendor->mobile }}
                                        </td>
                                        <td>
                                            {{ $vendor->email }}
                                        </td>
                                        <td>
                                            {{ $vendor->city }}
                                        </td>
                                        <td>

                                            <a href="{{route('vendor.details',$vendor->id)}}" class="btn btn-added"
                                                title="Detail View">
                                                <img src="{{ asset('resources/assets/img/icons/eye.svg') }}" class="me-1"
                                                    alt="img">
                                            </a>
                                            @if ($vendor->is_approved == 'pending')
                                                <a class="btn btn-success text-white"
                                                    href="{{ route('vendor.approval.status', ['status' => 1, 'user' => $vendor->id]) }}"
                                                    style="padding: 4px 10px; font-weight: 600; font-size: 14px; border-radius: 4px; margin-right: 8px;">
                                                    <i class="fas fa-check-circle"></i> Approve
                                                </a>

                                                <a class="btn btn-danger text-white"
                                                    href="{{ route('vendor.approval.status', ['status' => 0, 'user' => $vendor->id]) }}"
                                                    style="padding: 4px 10px; font-weight: 600; font-size: 14px; border-radius: 4px;">
                                                    <i class="fas fa-times-circle"></i> Reject
                                                </a>
                                            @elseif($vendor->is_approved == '1')
                                                <a class="btn btn-success text-white" href="javascript:void(0)"
                                                    style="padding: 4px 10px; font-weight: 600; font-size: 14px; border-radius: 4px; opacity: 0.8; cursor: not-allowed;">
                                                    <i class="fas fa-check-circle"></i> Approved
                                                </a>
                                            @elseif($vendor->is_approved == '0')
                                                <a class="btn btn-danger text-white" href="javascript:void(0)"
                                                    style="padding: 4px 10px; font-weight: 600; font-size: 14px; border-radius: 4px; opacity: 0.8; cursor: not-allowed;">
                                                    <i class="fas fa-times-circle"></i> Rejected
                                                </a>
                                            @endif



                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    {{-- <script src="{{ asset('backend/category/category.js') }}"></script> --}}
@endsection
