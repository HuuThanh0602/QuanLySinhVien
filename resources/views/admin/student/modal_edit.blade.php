<div id="editForm" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('common.edit') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editFormContent">
                    @csrf
                    <input type="hidden" id="studentId">

                    <div class="mb-3">
                        <label for="full_name" class="form-label">{{ __('common.full_name') }} <span div style="color:red">*</span></label>
                        <input type="text" class="form-control" id="full_name" name="full_name">
                    </div>

                    <div class="mb-3">
                        <label for="day_of_birth" class="form-label">{{ __('common.day_of_birth') }} <span div style="color:red">*</span></label>
                        <input type="date" class="form-control" id="day_of_birth" name="day_of_birth">
                    </div>

                    <div class="mb-3">
                        <label for="gender" class="form-label">{{ __('common.gender') }} <span div style="color:red">*</span></label>
                        <select class="form-select" name="gender" id="gender">
                            <option value="Male">{{ __('common.male') }}</option>
                            <option value="Female">{{ __('common.female') }}</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">{{ __('common.address') }} <span div style="color:red">*</span></label>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">{{ __('common.phone') }} <span div style="color:red">*</span></label>
                        <input type="text" class="form-control" id="phone" name="phone">
                    </div>

                    <div class="mb-3">
                        <label for="department_id" class="form-label">{{ __('common.department') }} <span div style="color:red">*</span></label>
                        <select class="form-select" name="department_id" id="department_id"></select>
                    </div>

                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('common.cancel') }}</button>
                        <button type="submit" class="btn btn-success">{{ __('common.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>