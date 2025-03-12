document.addEventListener('DOMContentLoaded', function () {
    document.documentElement.style.overflow = 'hidden';

    setTimeout(function() {
        document.getElementById('preloader').style.display = 'none';
        document.documentElement.style.overflow = '';
    }, 4000);
});
