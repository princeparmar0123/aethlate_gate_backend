@extends('backend.layouts.admin_master')
@section('content')
    <link rel="stylesheet" href="{{ asset('public/backend/shayari/add.css') }}">

    <div class="page-wrapper">
        <div class="content">
            <form action="{{ route('blog.update',$data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">   

                            <div class="col-lg-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="thumbnail">Thumbnail:*</label>
                                    <input type="file" name="thumbnail" id="thumbnail" 
                                        accept="image/png,image/jpeg" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-lg-12 col-sm-12 col-12">
                                <div>
                                    <label class="col-form-label">Title:*</label>
                                    <input type="text" id="name" value="{{$data->title}}" class="form-control" name="title"></input>
                                </div>
                            </div>

                            <div class="col-lg-12 col-sm-12 col-12">
                                <div>
                                    <label class="col-form-label">Description:*</label>
                                    <textarea id="tiny_11" rows="50" class="description" name="blog" >{{$data->blog}}</textarea>
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
          selector: 'textarea',
          plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
          toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });
      </script>


    <script src="{{ asset('public/resources/assets/plugins/select2/js/custom-select.js') }}">
    </script>
    
@endsection
