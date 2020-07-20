var Company = function () {

    var list = function () {

        var dataArr = {};
        var columnWidth = {"width": "10%", "targets": 0};

        var arrList = {
            'tableID': '#companytable',
            'ajaxURL': baseurl + "company-ajaxaction",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSearchApply': [0],
            'noSortingApply': [0, 2],
            'defaultSortColumn': 0,
            'defaultSortOrder': 'ASC',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);

        $('body').on("click", ".deletelogo", function () {
            var id = $(this).attr("data-id");
            setTimeout(function () {
                $('.yes-sure:visible').attr('data-id', id);
            }, 500);
        });

        $('body').on('click', '.yes-sure', function () {
            var id = $(this).attr('data-id');
            var data = {id: id, _token: $('#_token').val()};
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "company-ajaxaction",
                data: {'action': 'deletecompany', 'data': data},
                success: function (data) {
                    handleAjaxResponse(data);
                }
            });
        });
    }

    var adduni = function () {

        var form = $('#addcompanyform');
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

        var form = $('#editcompanyform');
        var rules = {
            name: {required: true},
            username: {required: true},
            email: {required: true, email: true},
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form);
        });
    }

    return{
        add: function () {
            adduni();
        },
        edit: function () {
            edituni();
        },
        init: function () {
            list();
        }
    }
}();