$('#pp').change(function() {
    // set the window's location property to the value of the option the user has selected
    window.location = "/list?" + $(this).val();
});
