import "./bootstrap";
import 'flowbite/dist/flowbite';
import '../../vendor/kezeneilhou/livewire-tailwind-modal/resources/js/modals.js';

document.addEventListener("DOMContentLoaded", function() {
    document.addEventListener("toast", function(event) {
        showToast(event);
    });
    document.addEventListener("swal", function(event) {
        showSwal(event);
    });
});

function showToast(event) {
    Toastify({
        text: event.detail[0].message,
        className: event.detail[0].type,
        position: "center"
    }).showToast();
}

function showSwal(event) {
    swal.fire({
        title: event.detail[0].type,
        text: event.detail[0].message,
        icon: event.detail[0].type
    });
}

document.getElementById('increaseFont-btn').addEventListener('click', function(event) {
    document.body.style.zoom = '115%';
});
document.getElementById('resetFont-btn').addEventListener('click', function(event) {
    document.body.style.zoom = '100%';
});