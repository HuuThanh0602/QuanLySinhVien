<div id="createRole" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('common.add_new') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="createFormContent">
                    @csrf
                    <input type="hidden" id="studentId">

                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('common.name_role') }} <span div style="color:red">*</span></label>
                        <input type="text" class="form-control" id="name" name="name">
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