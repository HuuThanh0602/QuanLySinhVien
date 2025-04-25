@extends('admin.layouts.app')
@section('title',__('common.management.student'))
@section('content')
<div class="table-wrapper" data-spy="scroll">
    <div class="table-title">
        <h2>{{__('common.management.student')}}</h2>
        <div class="mb-3">
            <a href="{{ route('admin.student.create') }}" class="btn btn-success">
                {{ __('common.add_new') }}
            </a>
        </div>
        <div class="mb-2 d-flex">
            <form action="{{ route('admin.student.index') }}" method="GET">
                <div class="row g-2">

                    <div class="col-md-3">
                        <label class="form-label">{{ __('common.department') }}</label>
                        <select name="department" class="form-select">
                            <option value="">{{ __('common.department') }}</option>
                            @foreach ($departments as $department)
                            <option value="{{ $department->id }}" {{ request('department') == $department->id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>

                            @endforeach

                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="age_from" class="form-label">{{ __('common.age_from') }}</label>
                        <input type="number" name="age_from" id="age_from" class="form-control"
                            value="{{ request('age_from') }}" placeholder="{{ __('common.age_from') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="age_to" class="form-label">{{ __('common.age_to') }}</label>
                        <input type="number" name="age_to" id="age_to" class="form-control"
                            value="{{ request('age_to') }}" placeholder="{{ __('common.age_to') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ __('common.phone_carrier') }}</label>
                        <select name="carrier" class="form-select">
                            <option value="">{{ __('common.all_carriers') }}</option>
                            <option value="viettel" {{ request('carrier') == 'viettel' ? 'selected' : '' }}>Viettel</option>
                            <option value="mobi" {{ request('carrier') == 'mobi' ? 'selected' : '' }}>Mobifone</option>
                            <option value="vina" {{ request('carrier') == 'vina' ? 'selected' : '' }}>Vinaphone</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ __('common.finished_level') }}</label>
                        <select name="finished_level" class="form-select">
                            <option value="">----</option>
                            <option value="finished" {{ request('finished_level') == 'finished' ? 'selected' : '' }}>{{__('common.finished')}}</option>
                            <option value="unfinished" {{ request('finished_level') == 'unfinished' ? 'selected' : '' }}>{{__('common.unfinished')}}</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="score_from" class="form-label">{{ __('common.score_from') }}</label>
                        <input type="number" name="score_from" id="score_from" class="form-control"
                            value="{{ request('score_from') }}" placeholder="{{ __('common.score_from') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="score_to" class="form-label">{{ __('common.score_to') }}</label>
                        <input type="number" name="score_to" id="score_to" class="form-control"
                            value="{{ request('score_to') }}" placeholder="{{ __('common.score_to') }}">
                    </div>
                    <div class="col-md-2 ">
                        <button type="submit" class="btn btn-primary w-100 my-8">{{ __('common.filter') }}</button>
                    </div>
                </div>
               
                <div style="width:100px; margin-top:10px">
                    <select name="paginate" class="form-select" onchange="this.form.submit()">
                        <option value="100" {{ request('paginate') == '100' ? 'selected' : '' }}>100</option>
                        <option value="500" {{ request('paginate') == '500' ? 'selected' : '' }}>500</option>
                        <option value="1000" {{ request('paginate') == '1000' ? 'selected' : '' }}>1000</option>
                        <option value="2000" {{ request('paginate') == '2000' ? 'selected' : '' }}>2000</option>
                        <option value="10000" {{ request('paginate') == '10000' ? 'selected' : '' }}>10000</option>
                        <option value="20000" {{ request('paginate') == '20000' ? 'selected' : '' }}>20000</option>

                    </select>
                </div>
            </form>
        </div>
        <a href="{{ route('admin.student.destroyYearOld') }}">Xoá sinh viên trên 30 tuổi</a>
    </div>
    {{ $students->links('pagination::bootstrap-4') }}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>{{__('common.full_name')}}</th>
                <th>{{__('common.day_of_birth')}}</th>
                <th>{{__('common.gender')}}</th>
                <th>{{__('common.email')}}</th>
                <th>{{__('common.department')}}</th>
                <th>{{__('common.address')}}</th>
                <th>{{__('common.phone')}}</th>
                <th>{{__('common.action')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{$student['id'] }}</td>
                <td>{{$student['full_name'] }}</td>
                <td>{{$student['day_of_birth'] }}</td>
                <td>{{$student['gender']}}</td>
                <td>{{$student['user']['email']}}</td>
                <td>{{$student['department']['name']}}</td>
                <td>{{$student['address']}}</td>
                <td>{{$student['phone']}}</td>

                <td>
                    <button class="btn btn-primary btn-sm SubjectNotStudied" data-id="{{ $student->id }}">
                        {{ __('common.subject_not_studied') }}
                    </button>

                    <button class="btn btn-warning btn-sm editStudent" data-id="{{ $student->id }}">
                        {{ __('common.edit') }}
                    </button>
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="{{ $student->id }}">
                        {{ __('common.delete') }}
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@include('admin.student.modal_edit')

@include('admin.student.subject')

@include('admin.layouts.partials.modal_delete')

@endsection

@section('scripts')
<script>
    var confirmDeleteModal = document.getElementById('confirmDeleteModal');
    confirmDeleteModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var form = document.getElementById('deleteForm');
        form.action = '/admin/student/' + id + '/destroy';
    });
    $(document).ready(function() {
        $('.editStudent').click(function() {
            var studentId = $(this).data('id');
            $.ajax({
                url: '/admin/student/' + studentId + '/edit',
                type: 'GET',
                success: function(response) {
                    $('#studentId').val(response.student.id);
                    $('#full_name').val(response.student.full_name);
                    $('#day_of_birth').val(response.student.day_of_birth);
                    $('#gender').val(response.student.gender);
                    $('#address').val(response.student.address);
                    $('#phone').val(response.student.phone);
                    var departmentSelect = $('#department_id');
                    departmentSelect.empty();
                    $.each(response.departments, function(index, department) {
                        departmentSelect.append(
                            `<option value="${department.id}" ${response.student.department_id == department.id ? 'selected' : ''}>
                                ${department.name}
                            </option>`
                        );
                    });
                    var myModal = new bootstrap.Modal(document.getElementById('editForm'));
                    myModal.show();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                },
            });
        });
    });
    $(document).ready(function() {
        $('#editFormContent').submit(function(e) {
            e.preventDefault();
            $(".is-invalid").removeClass('.is-invalid');
            $(".invalid-feedback").remove();
            let studentId = $('#studentId').val();
            let formData = new FormData(this);
            formData.append('_method', 'PUT');
            $.ajax({
                url: "/admin/student/" + studentId + "/update",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-HTTP-Method-Override': 'PUT',
                },
                success: function(response) {
                    if (response.success == true) {
                        location.reload();
                    }
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


    $(document).ready(function() {
        const modalElement = document.getElementById('tableSubjectNotStudiedModal');
        const myModal = bootstrap.Modal.getOrCreateInstance(modalElement);

        $('.SubjectNotStudied').on('click', function() {
            const studentId = $(this).data('id');

            $.ajax({
                url: '/admin/student/' + studentId + '/subjectNotStudied',
                type: 'GET',
                success: function(response) {
                    let html = '';
                    $.each(response.subjectNotStudieds, function(index, subject) {
                        html += `<tr>
                                <td>${subject.id}</td>
                                <td>${subject.name}</td>
                                <td>${subject.description}</td>
                             </tr>`;
                    });

                    $('#tableSubjectNotStudiedModal table tbody').html(html);
                    myModal.show();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });

        modalElement.addEventListener('hidden.bs.modal', function() {
            modalElement.setAttribute('aria-hidden', 'true');
            modalElement.removeAttribute('style');
        });
    });
</script>
@endsection