@extends('admin.layouts.app')

@section('title', __('common.management.user'))

@section('content')
<div class="table-wrapper" data-spy="scroll">
    <h2>{{ __('common.management.user') }}</h2>
    <div class="d-flex">
        <div class="mb-3" style="margin-right: 10px;">
            <a class="btn btn-success createRole" type="button">
                {{ __('common.add_new_role') }}
            </a>
        </div>
    </div>

    <form action="{{route('admin.role.updatePermission')}}" method="POST">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>{{ __('common.role') }}</th>
                    @foreach($permissions as $permission)
                    <th>{{ __('common.'.$permission->name) }}</th>
                    @endforeach
                    <th>{{ __('common.action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td><strong>{{$role->name}}</strong></td>
                    @foreach($permissions as $permission)
                    <td>
                        <input type="checkbox" name="permission[{{ $role->id }}][]"
                            value="{{ $permission->id }}"
                            {{ $role->permissions->contains('id', $permission->id) ? 'checked' : '' }}
                            onchange="this.form.submit();">
                    </td>
                    @endforeach
                    <td>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="{{ $role->id }}">
                            Xóa
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </form>
</div>
@include('admin.user.role.create')
@include('admin.layouts.partials.modal_delete')
@endsection

@section('scripts')
<script>
    var confirmDeleteModal = document.getElementById('confirmDeleteModal');
    confirmDeleteModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var form = document.getElementById('deleteForm');
        form.action = '/admin/role/' + id + '/destroy';
    });
    $(document).ready(function() {
        $('.createRole').click(function() {
            var myModal = new bootstrap.Modal(document.getElementById('createRole'));
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
            $.ajax({
                url: "/admin/role/storeRole",
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