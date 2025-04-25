@extends('admin.layouts.app')
@section('title',__('common.result'))
@section('content')
<style>
    .input-group {
        border: 1px solid #ccc;
        padding: 10px;
        margin: 10px 0;
        border-radius: 5px;
        display: flex;
        gap: 10px;
        align-items: center;
    }
</style>
<div class="table-wrapper">
    <h2>{{ __('common.enter_point') }}</h2>
    <form id="formEnterScore">
        @csrf
        <input type="text" name="student_id" hidden value="{{$id}}">
        <div id="input-container"></div>
        <button type="submit" class="btn btn-success">
            {{ __('common.enter_point') }}
        </button>
    </form>
    <table class="table table-bordered mt-2">
        <thead>
            <tr>
                <th>ID</th>
                <th>{{ __('common.department_name') }}</th>
                <th>{{ __('common.status') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $result)
            <tr>
                <td>{{ $result['subject_id'] }}</td>
                <td>{{ $result['subject_name'] }}</td>
                <td>{{ $result['score'] !== null ? $result['score'] : __('common.no_point') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <span><strong>GPA:</strong> {{$gpa}}</span>
</div>
@endsection
@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let inputCount = 0;
        const container = document.getElementById("input-container");

        function updateOptions() {
            let selects = document.querySelectorAll(".subject_id");
            let selectedValues = new Set(
                Array.from(selects)
                .map(select => select.value)
                .filter(value => value)
            );

            selects.forEach(select => {
                Array.from(select.options).forEach(option => {
                    if (option.value === "") return;
                    option.hidden = selectedValues.has(option.value) && option.value !== select.value;
                });
            });
        }

        function addInputGroup(subjectId = "", score = "") {
            inputCount++;
            const newDiv = document.createElement("div");
            newDiv.className = "input-group mb-2 d-flex gap-2 align-items-end";

            newDiv.innerHTML = `
        <div class="form-group" style="width:50%">
            <label for="subject_id-${inputCount}">Môn học</label>
            <select name="subject_id[]" class="form-control subject_id" id="subject_id-${inputCount}">
                <option value="">Chọn môn học</option>
                <?php foreach ($results as $result): ?>
                    <option value="<?= $result['subject_id'] ?>"><?= $result['subject_name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group" style="width:40%">
            <label for="score-${inputCount}">Điểm</label>
            <input type="number" step="0.001" id="score-${inputCount}" name="score[]" class="form-control" value="${score}">
        </div>
        <button type="button" class="btn btn-success add-btn">+</button>
        <button type="button" class="btn btn-danger remove-btn">-</button>
    `;

            container.appendChild(newDiv);

            const select = newDiv.querySelector(".subject_id");
            select.value = subjectId;
            select.addEventListener("change", updateOptions);

            newDiv.querySelector(".add-btn").addEventListener("click", () => addInputGroup());
            newDiv.querySelector(".remove-btn").addEventListener("click", () => {
                newDiv.remove();
                updateOptions();
            });
            updateOptions();
        }

        let scoreDefault = <?= json_encode($results->where('score', '!=', null)->values()); ?>;
        scoreDefault.forEach(item => addInputGroup(item.subject_id, item.score));

        $("#formEnterScore").submit(function(e) {
            e.preventDefault();
            $(".is-invalid").removeClass("is-invalid");
            $(".invalid-feedback").remove();

            let formData = new FormData(this);

            $.ajax({
                url: "/admin/result/store",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();
                        console.log(response.result);
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;

                        $.each(errors, function(key, messages) {
                            let inputName = key.replace(/\.\d+$/, "[]");
                            let inputIndex = parseInt(key.match(/\d+/)[0]);
                            let input = $(`[name="${inputName}"]`).eq(inputIndex);
                            input.addClass("is-invalid ");
                            if (!input.next(".invalid-feedback").length) {
                                input.after(`<div class="invalid-feedback"">${messages[0]}</div>`);
                            }
                        });
                    }
                }
            });
        });

        if (inputCount == 0) {
            addInputGroup();
        }
    });
</script>

@endsection