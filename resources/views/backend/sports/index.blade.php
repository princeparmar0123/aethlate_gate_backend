@extends('backend.layouts.admin_master')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Sports list</h4>
                </div>
                <div class="page-btn">
                    <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-added">
                        <img src="{{ asset('resources/assets/img/icons/plus.svg') }}" class="me-1" alt="img">Add Sport
                    </a>
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
                                    <th>Slug</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                    <tr>
                                        <td class="">
                                            {{ $data->sport_name }}
                                        </td>
                                        <td>
                                            {{ $data->sport_slug }}
                                        </td>
                                        <td>
                                            <a class="me-3" href="#" data-bs-toggle="modal"
                                                data-bs-target="#pcat_edit{{ $data->id }}">
                                                <img src="{{ asset('resources/assets/img/icons/edit.svg') }}"
                                                    alt="img">
                                            </a>
                                            <a class="me-3 " onclick="deleteRecord({{ $data->id }})">
                                                <img src="{{ asset('resources/assets/img/icons/delete.svg') }}"
                                                    alt="img">
                                            </a>
                                            <a class="me-3 " hidden id="deleteme{{ $data->id }}"
                                                href="{{ route('sport.delete', $data->id) }}">
                                                <img src="{{ asset('resources/assets/img/icons/delete.svg') }}"
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

    {{-- add model  --}}
    <div class="modal fade" id="exampleModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Sport</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('sport.store') }}" id="parent-Cat">
                        @csrf
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Name:</label>
                            <input type="text" required class="form-control" name="name" id="name">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- edit model  --}}
    @foreach ($datas as $data)
        <div class="modal fade" id="pcat_edit{{ $data->id }}" data-bs-backdrop="static" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Sport</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('sport.edit.store', $data->id) }}"
                            id="parent-cat-edit{{ $data->id }}">
                            @csrf

                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Name:</label>
                                <input required type="text" value="{{ $data->sport_name }}" class="form-control"
                                    name="name" id="nameEdit{{ $data->id }}">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    @endforeach
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="{{ asset('backend/category/category.js') }}"></script>
@endsection
