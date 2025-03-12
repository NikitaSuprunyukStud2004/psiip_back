$('#nameHax').on('input', function() {
    $(this).val($(this).val().replace(/[^a-zа-я]/gi, ''));
});