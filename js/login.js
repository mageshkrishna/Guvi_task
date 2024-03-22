$(document).ready(function() {
    $('#loginForm').on('submit', function(e) {
        e.preventDefault(); 
        var formData = $(this).serialize(); 

        $.ajax({
            type: 'POST',
            url: 'php/login.php',
            data: formData,
            success: function(response) {
                if (response.trim() === "success") {
                    var username = $('#username').val(); 
                    localStorage.setItem('username', username); 
                    window.location.href = 'profile.html'; 
                } else {
                    $('#loginResponse').html("<span style='color:red'>" + response + "</span>");
                }
            }
        });
    });
});
