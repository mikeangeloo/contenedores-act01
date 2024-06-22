$(document).ready(function() {
    //capturar evento blur (cuando quite el mouse del input)
    $(".email-input").blur(function() {
        var email = this.value;
        $.ajax({
            url: URL + '/email-test',
            data: {email: email},
            type: 'POST',
            success: function (response) {
                if (response == "used") {
                    $(".email-input").css("border-bottom", "2px solid red");
                } else {
                    $(".email-input").css("border-bottom", "2px solid green");
                }
            }
        });
    });
});