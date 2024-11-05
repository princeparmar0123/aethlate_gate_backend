@extends('backend.layouts.admin_master')
@section('content')
    <link rel="stylesheet" href="{{ asset('public/backend/shayari/add.css') }}">

    <div class="page-wrapper">
        <div class="content">
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="images">Images</label>
                                    <input type="file" name="images[]" id="images" multiple
                                        accept="image/png,image/jpeg" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-lg-12 col-sm-12 col-12">
                                <div>
                                    <label class="col-form-label">Category:*</label>
                                    <select class="select parent_class" name="cat_id" id="parent-cat-id" >
                                        <option value="">Choose Category</option>
                                        @foreach ($category as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-12 col-sm-12 col-12">
                                <div>
                                    <label class="col-form-label">Name:*</label>
                                    <input type="text" id="name" class="form-control" name="name"
                                        ></input>
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-12 col-12">
                                <div>
                                    <label class="col-form-label">HSN Code:</label>
                                    <input type="text" id="hsn_code" class="form-control" name="hsn_code"
                                        ></input>
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-12 col-12">
                                <div>
                                    <label class="col-form-label">Description:*</label>
                                    <textarea id="tiny_11" class="description" name="description" ></textarea>
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
    {{-- <script>
        $(document).ready(function() {
            function collectCardData() {
                var cardData = [];
                $(".card.image-display-card").each(function() {
                    var card = $(this);
                    var nameInput = card.find('input[name="image_name[]"]').val();
                    var descriptionInput = tinymce.get(card.find('textarea[name="image_description[]"]')
                        .attr('id')).getContent();
                    
                    var altTextInput = card.find('input[name="image_alt[]"]').val();
                    var subCategorySelect = card.find('.subCategory_class').val();
                    var cardObj = {
                        name: nameInput,
                        description: descriptionInput,
                    
                        altText: altTextInput,
                        subCategory: subCategorySelect,
                    };
                    cardData.push(cardObj);
                });
                return JSON.stringify(cardData);
            }
            $("#parent-cat-add").submit(function(event) {
                var cardData = collectCardData();
                $("#card_data").val(cardData);
                return true;
            });
            
            $('.parent_class').on('change', function() {
            var catId = this.value;
            $.ajax({
                url: "{{ route('shayari.tags.fetch') }}",
                type: "GET",
                data: {
                    catId: catId,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    $(".common-slug-class").empty();
                    $.each(result.subcat, function(key, value) {
                        $(".common-slug-class").append('<option>' + value.name + '</option>');
                    });
                }
            });
        });
        });
    </script> --}}
@endsection
