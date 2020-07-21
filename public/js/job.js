var Job = function () {

    var list = function () {

        var dataArr = {};
        var columnWidth = {"width": "10%", "targets": 0};

        var arrList = {
            'tableID': '#jobtable',
            'ajaxURL': baseurl + "job-ajaxaction",
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
                url: baseurl + "job-ajaxaction",
                data: {'action': 'deletejob', 'data': data},
                success: function (data) {
                    handleAjaxResponse(data);
                }
            });
        });
    }

    var adduni = function () {

        var form = $('#addjobform');
        var rules = {
            title: {required: true},
            desc: {required: true},
            date: {required: true},
            contact: {required: true},
            image: {required: true},
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form);
        });

        $('#univercity').click(function () {
            var data = {_token: $('#_token').val()};
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "job-ajaxaction",
                data: {'action': 'getunivercity', 'data': data},
                success: function (data) {
                    var data1 = JSON.parse(data);
                    var div = [];
                    var i;
                    for (i = 0; i < data1.length; i++) {
                        div += '<option value="' + data1[i].id + '">' + data1[i].name + '</option>';
                    }
                    var imagediv = '<div class="form-group ">' +
                            '<select class="form-control" name="selectbox[]" id="selectbox" multiple size="3">' +
                            div +
                            '</select>' +
                            '</div>';

                    $(".addselectdiv").html(imagediv);
                    handleAjaxResponse(data);
                }
            });
        });

        $('#student').click(function () {
            var data = {_token: $('#_token').val()};
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "job-ajaxaction",
                data: {'action': 'getstudent', 'data': data},
                success: function (data) {
                    var data1 = JSON.parse(data);
                    var div = [];
                    var i;
                    for (i = 0; i < data1.length; i++) {
                        div += '<option value="' + data1[i].id + '">' + data1[i].name + '</option>';
                    }
                    var imagediv = '<div class="form-group ">' +
                            '<select class="form-control" name="selectbox[]" id="selectbox" multiple size="3">' +
                            div +
                            '</select>' +
                            '</div>';

                    $(".addselectdiv").html(imagediv);
                    handleAjaxResponse(data);
                }
            });
        });
    }

    var edituni = function () {

        var form = $('#editjobform');
        var rules = {
            title: {required: true},
            desc: {required: true},
            date: {required: true},
            contact: {required: true},
            image: {required: true},
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