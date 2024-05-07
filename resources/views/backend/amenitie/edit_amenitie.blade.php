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

                        <h6 class="card-title">Edit Amenitie</h6>

                        <form class="forms-sample" method="POST" action="{{ route('update.amenitie') }}">
                            @csrf

                            <input type="hidden" name="id" value="{{ $amenities->id }}">

                            <div class="mb-3">
                                <label for="type_name" class="form-label">Amenitie Name</label>
                                <input type="text" name="amenitie_name" class="form-control @error('amenitie_name') is-invalid @enderror" value="{{ $amenities->amenitie_name }}" id="amenitie_name">
                                @error('amenitie_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
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