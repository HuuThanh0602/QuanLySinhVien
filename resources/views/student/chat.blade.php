@extends('student.layouts.app')
@section('title',__('common.chat'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Chat') }}</div>

                <div class="card-body">
                    <div class="row p-2">
                        <div class="col-10">
                            <div class="row">
                                <div class="col-12 border rounded-lg p-3">
                                    <ul id="messages" class="list-unstyled overflow-auto" style="min-height: 45vh">
                                    </ul>
                                </div>
                                <form>
                                    <div class="row py-3">
                                        <div class="col-10">
                                            <input type="text" id="message" class="form-control">
                                        </div>
                                        <div class="col-2">
                                            <button id="send" type="submit" class="btn btn-primary w-100">Gửi</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-2">
                            <p><strong>Người dùng</strong></p>
                            <ul
                                id="users"
                                class="list-unstyled overflow-auto text-info"
                                style="min-height: 45vh">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="module">
    const userElement = document.getElementById('users');
    const messagesElement = document.getElementById('messages');

    document.addEventListener("DOMContentLoaded", function() {
        if (typeof window.Echo !== "undefined") {
            console.log("Echo đã sẵn sàng");

            window.Echo.join('chat')
                .here((users) => {
                    users.forEach((user, index) => {
                        const element = document.createElement('li')
                        element.setAttribute('id', user.id)
                        element.innerText = user.name
                        userElement.appendChild(element)
                    })
                    //console.log(users)
                })
                .joining((user) => {
                    const element = document.createElement('li')
                    element.setAttribute('id', user.id)
                    element.innerText = user.name
                    userElement.appendChild(element)
                    // console.log({
                    //    user
                    // }, 'joining');
                })
                .leaving((user) => {
                    const element = document.createElement('li')
                    element.parentNode.removeChild(element);
                    // console.log({
                    //     user
                    // }, 'leaving');
                })
                .listen('MessageSent', (e) => {
                    //console.log(e)
                    const element = document.createElement('li')
                    element.innerText = e.student.full_name + ': ' + e.message;
                    messagesElement.appendChild(element)
                })

        } else {
            console.error(" Echo chưa được khởi tạo!");
        }
    });
</script>
<script type="module">
    const messageElement = document.getElementById('message')
    const sendElement = document.getElementById('send')

    sendElement.addEventListener('click', (e) => {
        e.preventDefault()
        window.axios.post('/chat/message', {
                message: messageElement.value
            })
            .then(response => {
                console.log("Gửi thành công:", response.data)
            })
            .catch(error => {
                console.error("Lỗi khi gửi:", error.response?.data || error.message)
            });
        messageElement.value = ""
    })
</script>

@endsection