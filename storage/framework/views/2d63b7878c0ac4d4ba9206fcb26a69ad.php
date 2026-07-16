
<script>
$(document).ready(function(){
    // Password toggle - works with both .password-wrapper (frontend) and .input-group (admin)
    $(document).on('click', '.toggle-password-btn', function(){
        var wrapper = $(this).closest('.password-wrapper, .input-group');
        var input = wrapper.find('input[type="password"], input[type="text"]').first();
        var icon = $(this).find('i');
        if(input.attr('type') === 'password'){
            input.attr('type', 'text');
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            input.attr('type', 'password');
            icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });

    // Mobile number: only allow digits and + sign, max 15 chars
    $(document).on('input', '.mobile-input', function(){
        var val = $(this).val();
        val = val.replace(/[^0-9+]/g, '');
        if(val.length > 15) val = val.substring(0, 15);
        $(this).val(val);
    });
    $(document).on('keypress', '.mobile-input', function(e){
        var char = String.fromCharCode(e.which);
        if(!/[0-9+]/.test(char)){
            e.preventDefault();
        }
        if($(this).val().length >= 15){
            e.preventDefault();
        }
    });

    // Email max length 60
    $(document).on('input', '.email-input', function(){
        if($(this).val().length > 60){
            $(this).val($(this).val().substring(0, 60));
        }
    });

    // Price/amount: only positive numbers
    $(document).on('input', '.positive-number-input', function(){
        var val = $(this).val();
        val = val.replace(/[^0-9.]/g, '');
        if(val.indexOf('.') !== val.lastIndexOf('.')){
            val = val.substring(0, val.lastIndexOf('.'));
        }
        $(this).val(val);
    });
    $(document).on('keypress', '.positive-number-input', function(e){
        var char = String.fromCharCode(e.which);
        if(!/[0-9.]/.test(char)){
            e.preventDefault();
        }
    });
});
</script>
<?php /**PATH /Applications/MAMP/htdocs/quickquiz/resources/views/partials/validation-scripts.blade.php ENDPATH**/ ?>