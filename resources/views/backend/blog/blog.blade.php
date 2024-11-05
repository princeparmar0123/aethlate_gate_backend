@extends('backend.layouts.admin_master')
@section('content')
    <style>
        .fa-eye {
            font-size: 16px;
        }
    </style>
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Blog List</h4>
                </div>
                <div class="page-btn">
                    <a href="{{ route('blog.create') }}" class="btn btn-added">
                        <img src="{{ asset('public/resources/assets/img/icons/plus.svg') }}" class="me-1" alt="img">Add
                        Blog
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-path">
                                <a class="btn btn-filter" id="filter_search">
                                    <img src="{{ asset('public/resources/assets/img/icons/filter.svg') }}" alt="img">
                                    <span><img src="{{ asset('public/resources/assets/img/icons/closes.svg') }}"
                                            alt="img"></span>
                                </a>
                            </div>
                            <div class="search-input">
                                <a class="btn btn-searchset"><img
                                        src="{{ asset('public/resources/assets/img/icons/search-white.svg') }}" alt="img"></a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table  datanew">
                            <thead>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Title</th>
                                    <th >Blog</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $key=>$data)
                                    <tr>
                                        <td class="">{{ $key+1}}</td>
                                       
                                        <td class="">{{ $data->title }}</td>
                                        <td class="">
                                            {{ strlen($data->blog) > 100 ? substr($data->blog, 0, 100) . '...' : $data->blog }}
                                        </td>
                                        <td>
                                            <a class="me-3" href="{{route('blog.edit',$data->id)}}">
                                                <img src="{{ asset('public/resources/assets/img/icons/edit.svg') }}"
                                                    data-bs-toggle="tooltip" data-bs-original-title="Edit" alt="img">
                                            </a>
                                            <a class="me-3 " onclick="deleteRecord({{ $data->id }})">
                                                <img src="{{ asset('public/resources/assets/img/icons/delete.svg') }}"
                                                    data-bs-toggle="tooltip" data-bs-original-title="Delete" alt="img">
                                            </a>
                                            <a class="me-3 " hidden id="deleteme{{ $data->id }}"
                                                href="{{ route('blog.delete', $data->id) }}">
                                                <img src="{{ asset('public/resources/assets/img/icons/delete.svg') }}"
                                                    alt="img">
                                            </a>
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
    <script>
        function deleteRecord(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
                confirmButtonClass: "btn btn-primary",
                cancelButtonClass: "btn btn-danger ml-1",
                buttonsStyling: !1,
            }).then(function(t) {
                if (t.isConfirmed) {
                    document.getElementById('deleteme' + id).click();
                } else
                    return false;
            });
        }
    </script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

@endsection
