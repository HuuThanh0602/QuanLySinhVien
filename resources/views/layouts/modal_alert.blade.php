@if (session('success') || session('error'))
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header {{ session('success') ? 'bg-success' : 'bg-danger' }}">
                <h5 class="modal-title text-white" id="messageModalLabel">
                    {{ session('success') ? __('messages.success.alert') : __('messages.error.alert') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ session('success') ?? session('error') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('common.close') }}</button>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
        messageModal.show();
    });
</script>
@endif