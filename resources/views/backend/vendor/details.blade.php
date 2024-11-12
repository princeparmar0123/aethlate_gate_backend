@extends('backend.layouts.admin_master')
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <style>
        .image-gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .gallery-image {
            flex: 1 1 45%;
            /* Adjust based on how many images per row you want */
            max-width: 45%;
            cursor: pointer;
        }

        .gallery-image img {
            width: 100%;
            height: auto;
            display: block;
        }
    </style>

    <div class="page-wrapper" style="min-height: 609px;">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Vendor Details</h4>
                    <h6>Full details of a vendor</h6>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 col-sm-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="productdetails">
                                @foreach ($data as $vendor)
                                    <div class="mb-2" style="float: right">
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
                                    </div>


                                    <h3 class="m-2">Personal Details</h3>

                                    <ul class="product-bar">
                                        <li>
                                            <h4>Name</h4>
                                            <h6>{{ $vendor->name }}</h6>
                                        </li>
                                        <li>
                                            <h4>Mobile</h4>
                                            <h6>{{ $vendor->mobile }}</h6>
                                        </li>

                                        <li>
                                            <h4>City</h4>
                                            <h6>{{ $vendor->city }}</h6>
                                        </li>
                                        <li>
                                            <h4>Email</h4>
                                            <h6>{{ $vendor->email }}</h6>
                                        </li>
                                        <li>
                                            <h4>Status</h4>
                                            <h6>
                                                @if($vendor->is_approved == '1')
                                                    Approved
                                                @elseif($vendor->is_approved == '0')
                                                    Rejected
                                                @else
                                                    Pending
                                                @endif
                                            </h6>
                                        </li>

                                    </ul>
                                    <h3 class="m-2">Location Details</h3>
                                    @foreach ($vendor->locations as $location)
                                        <ul class="product-bar">
                                            <li>
                                                <h4>Owner Name</h4>
                                                <h6>{{ $location->owner_name }}</h6>
                                            </li>
                                            <li>
                                                <h4>Address</h4>
                                                <h6>{{ $location->address }}</h6>
                                            </li>

                                            <li>
                                                <h4>Gst Certificate</h4>
                                                <h6>
                                                    <a class="printimg" target="_blank"
                                                        href="{{ asset('images/gst/' . $location->gst_certificate) }}">
                                                        <img src="{{ asset('resources/assets/img/icons/pdf.svg') }}"
                                                            alt="print">
                                                    </a>
                                                </h6>
                                            </li>

                                        </ul>
                                    @endforeach

                                    <h3 class="m-2">Complex Details</h3>
                                    @foreach ($vendor->complexes as $complex)
                                        <ul class="product-bar">
                                            <li>
                                                <h4>Complex Name</h4>
                                                <h6>{{ $complex->complex_name }}</h6>
                                            </li>
                                            <li>
                                                <h4>Start Time</h4>
                                                <h6>{{ $complex->start_time }}</h6>
                                            </li>

                                            <li>
                                                <h4>End Time</h4>
                                                <h6>{{ $complex->end_time }}</h6>
                                            </li>

                                            <li>
                                                <h4>Description</h4>
                                                <h6>{{ $complex->description }}</h6>
                                            </li>
                                        </ul>
                                        <h3 class="m-2">Sport Details</h3>
                                        @if ($complex->sport)
                                            <ul class="product-bar">
                                                <li>
                                                    <h4>Sport Name</h4>
                                                    <h6>{{ $complex->sport->sport_name }}</h6>
                                                </li>
                                            </ul>
                                        @endif
                                    @endforeach

                                    <h3 class="m-2">Package Details</h3>
                                    @foreach ($vendor->packages as $package)
                                        <ul class="product-bar">
                                            <li>
                                                <h4>Package Name</h4>
                                                <h6>{{ $package->package_name }}</h6>
                                            </li>
                                            <li>
                                                <h4>Price</h4>
                                                <h6>{{ $package->price }}</h6>
                                            </li>
                                            <li>
                                                <h4>Validity</h4>
                                                <h6>{{ $package->validity }}</h6>
                                            </li>
                                            <li>
                                                <h4>Description</h4>
                                                <h6>{{ $package->description }}</h6>
                                            </li>
                                        </ul>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image Gallery with Flexbox for Complex Images -->
                <div class="col-lg-4 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h5>Complex Images</h5>
                            <div class="image-gallery d-flex flex-wrap gap-3">
                                <!-- Loop through complexes and their images -->
                                @foreach ($data as $vendor)
                                    @foreach ($vendor->complexes as $complex)
                                        @foreach ($complex->images as $image)
                                            <div class="gallery-image">
                                                <img src="{{ asset('images/complex/' . $image->url) }}" alt="Complex Image"
                                                    class="img-fluid clickable-image"
                                                    data-image="{{ asset('images/complex/' . $image->url) }}"
                                                    data-name="{{ basename($image->url) }}">
                                            </div>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Image Display -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Image Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="Selected Image" class="img-fluid mb-3">
                    <h4 id="modalImageName"></h4>
                    <h6 id="modalImageSize"></h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.clickable-image').on('click', function() {
                // Get image details from data attributes
                const imageUrl = $(this).data('image');
                const imageName = $(this).data('name');

                // Set modal content
                $('#modalImage').attr('src', imageUrl);
                $('#modalImageName').text(imageName);

                // Show the modal
                $('#imageModal').modal('show');
            });
        });
    </script>
@endsection
