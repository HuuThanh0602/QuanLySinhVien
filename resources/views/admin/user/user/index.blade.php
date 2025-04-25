@extends('admin.layouts.app')

@section('title', __('common.management.user'))

@section('content')
<div class="table-wrapper" data-spy="scroll">
    <h2>{{ __('common.management.user') }}</h2>
    <div class="d-flex">
        <div class="mb-3" style="margin-right: 10px;">
            <a class="btn btn-success createUser" type="button">
                {{ __('common.add_user') }}
            </a>
        </div>
    </div>
    <form action="{{route('admin.user.update')}}" method="POST" id="permissionForm">
        @csrf
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>{{__('common.subject_name')}}</th>
                    <th>{{ __('common.role') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <input type="text" name="model_id" hidden value="{{$user->id}}">
                    <td>{{ $user['id'] }}</td>
                    <td>{{ $user['email'] }}</td>
                    <td>
                        <div class="mb-3">
                            <select class="form-select" name="roles[{{ $user->id }}]" onchange="this.form.submit()">
                                <option value="">
                                    -------
                                </option>
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ $user->roles->contains('id', $role->id) ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </form>
</div>
@include('admin.layouts.partials.modal_delete')
@include('admin.user.user.create')
@endsection
@section('scripts')
<script>
    var confirmDeleteModal = document.getElementById('confirmDeleteModal');
    confirmDeleteModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var form = document.getElementById('deleteForm');
        form.action = '/admin/user/' + id + '/destroy';
    });
    $(document).ready(function() {
        $('.createUser').click(function() {
            var myModal = new bootstrap.Modal(document.getElementById('createUser'));
            myModal.show();
        });
    });

    $(document).ready(function() {
        $('#createFormContent').submit(function(e) {
            e.preventDefault();
            $(".is-invalid").removeClass('.is-invalid');
            $(".invalid-feedback").remove();
            let formData = new FormData(this);
            formData.append('_method', 'POST');
            console.log(formData);
            $.ajax({
                url: "/admin/user/store",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-HTTP-Method-Override': 'POST',
                },
                success: function(response) {
                    if (response.success == true) {
                        location.reload();
                    }
                    console.log(response);
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            let input = $("#" + key);
                            input.addClass("is-invalid");
                            input.after(`<div class="invalid-feedback">${value[0]}</div>`);
                        });
                    }
                }
            });
        });
    });
</script>
@endsection