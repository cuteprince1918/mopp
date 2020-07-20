var Univercity = function () {

    var adduni = function () {

        var form = $('#addunivercityform');
        var rules = {
            name: {required: true},
            username: {required: true},
            email: {required: true, email: true},
            password: {required: true},
            image: {required: true},
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form);
        });
    }
    
    var edituni = function () {

        var form = $('#editunivercityform');
        var rules = {
            name: {required: true},
            username: {required: true},
            email: {required: true, email: true},
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form);
        });
    }

    return {
        add: function () {
            adduni();
        },
        edit: function () {
            edituni();
        }
    }
}();