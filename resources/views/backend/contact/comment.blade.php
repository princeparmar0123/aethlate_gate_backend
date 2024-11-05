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
                    <h4>Comment List</h4>
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
                                        src="{{ asset('public/resources/assets/img/icons/search-white.svg') }}"
                                        alt="img"></a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table datanew">
                            <thead>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Comment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $datas)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $datas->name }}</td>
                                        <td>{{ $datas->email }}</td>
                                        <td>{{ ($datas->is_approved == 1)? "Approved":"Pending" }}</td>
                                        <td>
                                            <a href="#" class="message-link" data-message="{{ $datas->feedback }}">
                                                {{ strlen($datas->feedback) > 60 ? substr($datas->feedback, 0, 60) . '...' : $datas->feedback }}
                                            </a>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                  Action
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                  <li><a class="dropdown-item" href="{{route('comment.approve',$datas->id)}}">Approve</a></li>
                                                </ul>
                                              </div> 
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

    {{-- Message Modal --}}
    <div class="modal fade" id="messageModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel">Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="overflow:auto">
                    <p id="modal-message-content"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var messageLinks = document.querySelectorAll('.message-link');
            messageLinks.forEach(function (link) {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    var message = this.getAttribute('data-message');
                    var modalContent = document.getElementById('modal-message-content');
                    modalContent.textContent = message;
                    var messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
                    messageModal.show();
                });
            });
        });
    </script>
@endsection


