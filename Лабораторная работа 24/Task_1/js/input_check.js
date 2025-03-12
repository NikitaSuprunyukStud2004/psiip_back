document.addEventListener('DOMContentLoaded', (event) => {
    const submitButton = document.querySelector('.footer-top-form-button');
    const nameInput = document.getElementById('nameHax');
    const telInput = document.getElementById('telHax');

    submitButton.addEventListener('click', () => {
        const nameValue = nameInput.value.trim();
        const telValue = telInput.value.trim();

        if (!nameValue || !telValue) {
            nameInput.style.border = "1px solid red";
            telInput.style.border = "1px solid red";
            
            setTimeout(() => {
                alert('Пожалуйста, заполните оба поля: Имя и Телефон.');
            }, 0);
        } else {
            alert('Форма успешно отправлена!');
        }
    });

    nameInput.addEventListener('focus', () => {
        nameInput.style.border = "";
    });

    telInput.addEventListener('focus', () => {
        telInput.style.border = "";
    });
});