var Dashboard = function () {

    var list = function () {

        var dataArr = {};
        var columnWidth = {"width": "10%", "targets": 0};

        var arrList = {
            'tableID': '#univercitytable',
            'ajaxURL': baseurl + "univercity-ajaxaction",
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
                url: baseurl + "univercity-ajaxaction",
                data: {'action': 'deleteunivercity', 'data': data},
                success: function (data) {
                    handleAjaxResponse(data);
                }
            });
        });
    }

    return{
        init: function () {
            list();
        }
    }
}();