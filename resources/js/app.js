import './bootstrap';
import axios from 'axios';
window.axios = axios

console.log("success");
window.Echo.channel('notifications')
    .listen('UserSessionChanged', (e) => {
        const notiElement = document.getElementById('notification')
        notiElement.innerText = e.message
        notiElement.classList.remove('invisible')
        notiElement.classList.remove('alert-danger')
        notiElement.classList.remove('alert-success')

        notiElement.classList.add('alert-'+e.type);
    });
