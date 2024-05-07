@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">


    <div class="row profile-body">

        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Edit Permission</h6>

                        <form class="forms-sample" method="POST" action="{{ route('update.permission') }}">
                            @csrf

                            <input type="hidden" name="id" value="{{ $permissions->id }}">

                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Permission Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $permissions->name }}" id="name">
                            </div>

                            <div class="form-group mb-3">
                                <label for="group_name" class="form-label">Group Name</label>
                                <select name="group_name" class="form-select" id="group_name">
                                    <option selected="" disabled="">Select Group</option>
                                    <option value="type" {{ $permissions->group_name == 'type' ?
                                        'selected' : '' }}>Property Type</option>
                                    <option value="amenities" {{ $permissions->group_name == 'amenities' ?
                                        'selected' : '' }}>Amenities</option>
                                    <option value="role" {{ $permissions->group_name == 'role' ?
                                        'selected' : '' }}>Role & Permission</option>
                                    <option value="property" {{ $permissions->group_name == 'property' ?
                                        'selected' : '' }}>Property</option>
                                    <option value="state" {{ $permissions->group_name == 'state' ?
                                        'selected' : '' }}>State</option>
                                    <option value="history" {{ $permissions->group_name == 'history' ?
                                        'selected' : '' }}>Package History</option>
                                    <option value="message" {{ $permissions->group_name == 'message' ?
                                        'selected' : '' }}>Property Message</option>
                                    <option value="testimonials" {{ $permissions->group_name == 'testimonials' ?
                                        'selected' : '' }}>Testimonials</option>
                                    <option value="category" {{ $permissions->group_name == 'category' ?
                                        'selected' : '' }}>Blog Category</option>
                                    <option value="post" {{ $permissions->group_name == 'post' ?
                                        'selected' : '' }}>Blog Post</option>
                                    <option value="comment" {{ $permissions->group_name == 'comment' ?
                                        'selected' : '' }}>Blog Comment</option>
                                    <option value="smtp"{{ $permissions->group_name == 'smtp' ?
                                        'selected' : '' }}>SMTP Setting</option>
                                    <option value="site" {{ $permissions->group_name == 'site' ?
                                        'selected' : '' }}>Site Setting</option>

                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>

</div>



@endsection