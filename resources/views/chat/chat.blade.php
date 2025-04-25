
@php
    $layout = Auth()->user()->role == 'admin' ? 'admin.layouts.app' : 'student.layouts.app';
@endphp
@extends($layout)
@section('title',__('common.chat'))
@section('content')
<style>
    html, body {
        height: 100%;
    }

    .chat-container {
        height: 100vh;
    }

    .chat-sidebar {
        overflow-y: auto;
        height: 100%;
    }

    .chat-messages {
        overflow-y: auto;
        flex: 1;
    }
    .chat-right {
        display: flex;
        flex-direction: column;
        height: 100%;
    }
</style>
<div class="container-fluid chat-container">
    <div class="row h-100">
        <div class="col-md-3 border-end bg-white chat-sidebar">
            <div class="list-group list-group-flush">
                @foreach($users as $user)
                <a class="list-group-item list-group-item-action user-item showMessages"
                   data-id="{{ $user->id }}">
                    {{ $user->student->full_name ?? $user->email }}
                </a>
                @endforeach
            </div>
        </div>
        <div class="col-md-9 p-0 chat-right bg-light">
            <div id="messages" class="chat-messages p-3">
            </div>
            <div class="p-3 border-top d-flex">
                <input type="text" id="messageInput" class="form-control me-2" placeholder="Nhập tin nhắn...">
                <button class="btn btn-primary">Gửi</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    const currentUserId = @json(auth()->id());
    let currentToId = null;
    let currentChannel = null; 

    function generateRoomId(id1, id2) {
        const [minId, maxId] = [id1, id2].sort((a, b) => a - b);
        return `room_${minId}_${maxId}`;
    }

    $(document).ready(function () {
        const messagesElement = document.getElementById('messages');

        $('.showMessages').on('click', function () {
            $('.showMessages').removeClass('active');

            $(this).addClass('active');
            const to_Id = $(this).data('id');
            currentToId = to_Id;

            if (currentChannel) {
                    Echo.leave(`chat.room.${generateRoomId(currentUserId, currentToId)}`);
                }

            const roomId = generateRoomId(currentUserId, currentToId);
            console.log(roomId);
            
            currentChannel = Echo.private(`chat.room.${roomId}`)
                .listen('.PrivateMessageSent', (e) => {
                    console.log('Nhận sự kiện:', e);
                    const message = e.message;
                    const senderName = message.from_id === currentUserId ? 'You'
                        : (message.from_student ? message.from_student.full_name : 'Admin');

                    const html = `
                        <div class="d-flex mb-2 ${message.from_id === currentUserId ? 'justify-content-end' : ''}">
                            <div class="p-2 rounded-3 ${message.from_id === currentUserId ? 'bg-primary text-white' : 'bg-secondary text-white'} w-auto">
                                <strong>${senderName}</strong><br>
                                ${message.content}<br>
                                <small class="text-light">${new Date(message.created_at).toLocaleTimeString([], {hour: '2-digit', minute: '2-digit'})}</small>
                            </div>
                        </div>`;
                    messagesElement.innerHTML += html;
                }).error((err) => console.error('Lỗi khi subscribe:', err));

            $.ajax({
                url: 'chat/getMessage/' + currentToId,
                type: 'GET',
                success: function (response) {
                    let html = '';
                    $.each(response.messages, function (index, message) {
                        const senderName = message.from_id === currentUserId ? 'You'
                            : (message.from_student ? message.from_student.full_name : 'Admin');
                        html += `
                            <div class="d-flex mb-2 ${message.from_id === currentUserId ? 'justify-content-end' : ''}">
                                <div class="p-2 rounded-3 ${message.from_id === currentUserId ? 'bg-primary text-white' : 'bg-secondary text-white'} w-auto">
                                    <strong>${senderName}</strong><br>
                                    ${message.content}<br>
                                    <small class="text-light">${new Date(message.created_at).toLocaleTimeString([], {hour: '2-digit', minute: '2-digit'})}</small>
                                </div>
                            </div>`;
                    });
                    messagesElement.innerHTML = html;
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        });

        $('.btn.btn-primary').on('click', function () {
            const content = $('#messageInput').val();
            if (!content || !currentToId) return;
            $.ajax({
                url: '/chat/sendMessage',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    to_id: currentToId,
                    content: content
                },
                success: function (response) {
                    $('#messageInput').val('');
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
    $('#messageInput').on('keypress', function (e) {
    if (e.which === 13 && !e.shiftKey) {
        e.preventDefault();
        $('.btn.btn-primary').click();
    }
});
</script>
@endsection