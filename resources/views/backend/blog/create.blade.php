@extends('backend.layouts.admin_master')
@section('content')
    <link rel="stylesheet" href="{{ asset('public/backend/shayari/add.css') }}">

    <div class="page-wrapper">
        <div class="content">
            <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-lg-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="thumbnail">Thumbnail</label>
                                    <input type="file" name="thumbnail" id="thumbnail" 
                                        accept="image/png,image/jpeg" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-lg-12 col-sm-12 col-12">
                                <div>
                                    <label class="col-form-label">Title:*</label>
                                    <input type="text" id="name" class="form-control" name="title"
                                        ></input>
                                </div>
                            </div>

                            <div class="col-lg-12 col-sm-12 col-12">
                                <div>
                                    <label class="col-form-label">Description:*</label>
                                    <textarea rows="50" id="tiny_11" class="description" name="blog" ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12" style="margin-top:23px;">
                    <button type="submit" class="btn btn-submit me-2">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/7pv2wg1oyw5qzamwhw3eeexd2g1doq7uis3ka7cd8jnnrf3u/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#tiny_11',
            menubar: false,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap',
                'preview', 'anchor', 'searchreplace', 'visualblocks', 'fullscreen',
                'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
                "See docs to implement AI Assistant")),
            toolbar: 'undo redo | blocks | bold italic backcolor | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | removeformat | image | help'
        });
    </script>

    <script src="{{ asset('public/resources/assets/plugins/select2/js/custom-select.js') }}">
    </script>

@endsection
