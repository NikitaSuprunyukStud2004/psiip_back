document.addEventListener('DOMContentLoaded', (event) => {
    const modal = document.getElementById("myModal");
    const btn = document.getElementById("openModal");
    const span = document.getElementsByClassName("close")[0];
    const messageTextarea = document.getElementById("message");
    const submitMessageButton = document.getElementById("submitMessage");

    btn.addEventListener('click', () => {
        modal.style.display = "block";
    });

    span.addEventListener('click', () => {
        modal.style.display = "none";
    });

    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });

    submitMessageButton.addEventListener('click', () => {
        const message = messageTextarea.value.trim();
        if (message) {
            alert('Сообщение отправлено!');
            modal.style.display = "none";
        } else {
            alert('Пожалуйста, введите сообщение.');
        }
    });
});