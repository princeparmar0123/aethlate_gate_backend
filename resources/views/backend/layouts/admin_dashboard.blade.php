@extends('backend.layouts.admin_master')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
              
                            {{-- @php
                              $totalContacts=App\Models\ContactUs::get()->count();   
                              $totalUnapprovedComments=App\Models\Comment::where('is_approved','0')->get()->count();   
                              $totalBlog=App\Models\Blog::get()->count();   
                              $totalProduct=App\Models\Product::get()->count();   
                            @endphp --}}
                          
                       
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <div class="dash-count das2">
                        <div class="dash-counts">
                            {{-- <h4>{{$totalContacts}}</h4> --}}
                            <h5>Contacts</h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="file-text"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <div class="dash-count das1">
                        <div class="dash-counts">
                            {{-- <h4>{{$totalUnapprovedComments}}</h4> --}}
                            <h5>Unapproved Comments</h5>
                        </div>
                        <div class="dash-imgs">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <div class="dash-count das3">
                        <div class="dash-counts">
                            {{-- <h4>{{$totalBlog}}</h4> --}}
                            <h5>Total Blogs</h5>
                        </div>
                        <div class="dash-imgs">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-hash"><line x1="4" y1="9" x2="20" y2="9"></line><line x1="4" y1="15" x2="20" y2="15"></line><line x1="10" y1="3" x2="8" y2="21"></line><line x1="16" y1="3" x2="14" y2="21"></line></svg>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <div class="dash-count das3">
                        <div class="dash-counts">
                            {{-- <h4>{{$totalProduct}}</h4> --}}
                            <h5>Total Products</h5>
                        </div>
                        <div class="dash-imgs">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-hash"><line x1="4" y1="9" x2="20" y2="9"></line><line x1="4" y1="15" x2="20" y2="15"></line><line x1="10" y1="3" x2="8" y2="21"></line><line x1="16" y1="3" x2="14" y2="21"></line></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
