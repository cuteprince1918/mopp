var Login = function () {
    var register = function () {
        $('#loginform').submit(function () {
            if ($('#selection').val() == '') {
                alert('Please Select Your Batch');
            }
        });

        $('#loginform').validate({
            rules: {
                email: {required: true, email: true},
                password: {required: true},
            },
            messages: {
                email: {required: "Please Enter your Email"},
                password: {required: "Please Enter your Password"}
            },
            submitHandler: function (form) {
                handleAjaxFormSubmit(form);
            }
        });
    }
    var reset = function () {
        $('#forgotpasswordform').submit(function () {
            if ($('#selection').val() == '') {
                alert('Please Select Your Batch');
            }
        });

        $('#forgotpasswordform').validate({
            rules: {
                email: {required: true, email: true},
            },
            messages: {
                email: {required: "Please Enter your Email"},
            },
            submitHandler: function (form) {
                handleAjaxFormSubmit(form);
            }
        });
    }
    var freset = function () {

        $('#resetpasswordform').validate({
            rules: {
                password : {
                    required: true
                },
                cpassword : {
                    required: true,
                    equalTo : "#password"
                }
                
            },
            messages: {
                password: {required: "Please Enter your Password"},
                cpassword: {required: "Please Enter your password", equalTo: "please enter same password"},
            },
            submitHandler: function (form) {
                handleAjaxFormSubmit(form);
            }
        });
    }
    return {
        init: function () {
            register();
        },
        freset: function () {
            reset();
        },
        reset: function () {
            freset();
        }
    }
}();