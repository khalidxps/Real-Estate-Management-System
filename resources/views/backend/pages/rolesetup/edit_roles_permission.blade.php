@extends('admin.admin_dashboard')
@section('admin')


<style>
    .form-check-label {
        text-transform: capitalize;
    }
</style>
<div class="page-content">


    <div class="row profile-body">

        <!-- middle wrapper start -->
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Edit Roles in Permission</h6>

                        <form id="myForm" class="forms-sample" method="post" action="{{ route('admin.roles.update', $roles->id)}}">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="" class="form-label">Roles Name</label>
                                <h3>{{ $roles->name }}</h3>
                            </div>

                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" id="checkDefaultmain">
                                <label class="form-check-label" for="checkDefaultmain">
                                    All Permission
                                </label>
                            </div>
                            <br>
                            @foreach($permission_groups as $group)
                            <div class="row">
                                <div class="col-3">
                                    @php
                                    $permissions = App\Models\User::getpermissionByGroupName($group->group_name)
                                    @endphp

                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="checkDefault{{ $group->group_name }}" {{ App\Models\User::roleHasPermissions($roles, $permissions) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="checkDefault">
                                            {{ $group->group_name}}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-9">

                                    @foreach($permissions as $permission)
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" name="permission[]" id="checkDefault{{ $permission->id }}" value="{{ $permission->id}}" {{ $roles->hasPermissionTo($permission->name) ? 'checked' : '' }} >
                                        <label class="form-check-label" for="checkDefault{{ $permission->id }}">
                                            {{ $permission->name}}
                                        </label>
                                    </div>
                                    @endforeach
                                    <hr>
                                </div>
                            </div>
                            @endforeach
                            <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#checkDefaultmain').click(function() {
            if ($(this).is(':checked')) {
                $('input[type=checkbox]').prop('checked', true);
            } else {
                $('input[type=checkbox]').prop('checked', false);
            }
        });
    });
</script>

@endsection