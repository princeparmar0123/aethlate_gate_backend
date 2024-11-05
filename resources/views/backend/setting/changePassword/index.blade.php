@extends('backend.layouts.admin_master')
@section('content')
    <div class="page-wrapper" style="min-height: 522px;">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Setting</h4>
                    <h6>Change-Password</h6>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.update.password') }}" method="POST" id="ChangePassword">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Old Password</label>
                                    <div class="pass-group">
                                        <input id="old_password" type="password"
                                            class="pass-inputo form-control pe-5 password-input @error('password') is-invalid @enderror"
                                            name="old_password" required autocomplete="current-password">
                                        <button
                                            class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                            type="button" id="password-addon"><i
                                                class="ri-eye-fill align-middle"></i></button>
                                        <span class="fas toggle-passwords fa-eye-slash"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>New Password</label>
                                    <div class="pass-group">
                                        <input id="new_password" type="password"
                                            class="pass-inputs form-control pe-5 password-input" name="new_password"
                                            required>
                                        <button
                                            class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                            type="button" id="password-addon"><i
                                                class="ri-eye-fill align-middle"></i></button>
                                        <span class="fas toggle-passworda fa-eye-slash"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Confirm Password <span class="manitory">*</span></label>
                                    <div class="pass-group">
                                        <input id="confirm_password" type="password"
                                            class=" pass-input form-control pe-5 password-input @error('password') is-invalid @enderror"
                                            name="confirm_password" required autocomplete="current-password">
                                        <button
                                            class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                            type="button" id="password-addon"><i
                                                class="ri-eye-fill align-middle"></i></button>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        <span class="fas toggle-password fa-eye-slash"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-submit me-2">Submit</button>
                                    <a href="javascript:void(0);" class="btn btn-cancel">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script>
        $.validator.addMethod("notEqual", function(value, element, param) {
            return this.optional(element) || value !== $(param).val();
        }, "Old password and new password must be different");
        $.validator.addMethod("password", function(value, element) {
            if (/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()+=-\?;,./{}|\":<>\[\]\\\' ~_]).{8,}/.test(value)) {
                return true;
            } else {
                return false;
            }
        }, "Use at least 8 characters. Use a mix of letters (uppercase and lowercase), numbers, and symbols.");

        $('#ChangePassword').validate({
            rules: {
                old_password: {
                    required: true,
                },
                new_password: {
                    required: true,
                    minlength: 8,
                    notEqual: "#old_password"
                },
                confirm_password: {
                    required: true,
                    minlength: 8,
                    equalTo: "#new_password",
                },
            },
            messages: {
                old_password: {
                    required: "This old Password field is required",
                },
                new_password: {
                    required: "This new password field is required",
                    minlength: "Enter at least 8 characters",
                },
                confirm_password: {
                    required: "This confirm password field is required",
                    minlength: "Enter at least 8 characters",
                    equalTo: "The password and its confirm are not the same",
                },
            },
        });
    </script>
@endsection
