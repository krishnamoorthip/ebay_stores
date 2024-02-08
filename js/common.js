function dataTable(id, btn, cols, title) {
    if (typeof title === 'undeined') {
        title = btn;
    }
    var myTable =
            $('#' + id)
            //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
            .DataTable({
                bAutoWidth: false,
                "aoColumns": cols,
                "aaSorting": [],
                //"bProcessing": true,
                //"bServerSide": true,
                //"sAjaxSource": "http://127.0.0.1/table.php"	,

                //,
                //"sScrollY": "200px",
                //"bPaginate": false,

                //"sScrollX": "100%",
                //"sScrollXInner": "120%",
                //"bScrollCollapse": true,
                //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
                //you may want to wrap the table inside a "div.dataTables_borderWrap" element

                //"iDisplayLength": 50


                select: {
                    style: 'multi'
                }
            });

    $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';

    new $.fn.dataTable.Buttons(myTable, {
        buttons: [
            {
                "extend": "csv",
                title: title,
                "text": "<i class='fa fa-database bigger-110 orange'></i> <span>Export to CSV</span>",
                "className": "btn btn-white btn-primary btn-bold",
                exportOptions: {
                    columns: ':not(:last-child)',
                }
            },
            {
                "extend": "excelHtml5",
                title: title,
                "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span>Export to Excel</span>",
                "className": "btn btn-white btn-primary btn-bold"
            },
            /*{
             "extend": "pdfHtml5",
             title: title,
             "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
             "className": "btn btn-white btn-primary btn-bold"
             },*/
            {
                "extend": "print",
                "text": "<i class='fa fa-print bigger-110 grey'></i> <span>Print</span>",
                "className": "btn btn-white btn-primary btn-bold",
                autoPrint: false,
                message: 'This print was produced using the Print button for DataTables',
                exportOptions: {
                    columns: ':not(:last-child)',
                }
            }
        ]
    });
    $('#' + btn + ' .tableTools-container').empty();
    myTable.buttons().container().appendTo($('#' + btn + ' .tableTools-container'));
}

$(function () {
    $('.modal.aside').ace_aside();
    $('#product_unit_sizes').addClass('aside').ace_aside({container: '#add_product > .modal-dialog'});
    //$('#product_unit_sizes').addClass('in').removeClass('aside-hidden');
});

function showErrorAlert(reason, detail) {
    var msg = '';
    if (reason === 'unsupported-file-type') {
        msg = "Unsupported format " + detail;
    } else {
        //console.log("error uploading file", reason, detail);
    }
    $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
            '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
}

function bindShowDetailClick() {
    $('.show-details-btn').on('click', function (e) {
        e.preventDefault();
        $(this).closest('tr').next().toggleClass('open');
        $(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
    });
}

function bindDetailClickByTbl(tbl) {
    $('#' + tbl + ' .show-details-btn').on('click', function (e) {
        e.preventDefault();
        $(this).closest('tr').next().toggleClass('open');
        $(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
    });
}

var $overflow = '';
function modalColorbox() {
    var colorbox_params = {
        rel: 'colorbox',
        reposition: true,
        scalePhotos: true,
        scrolling: false,
        previous: '<i class="ace-icon fa fa-arrow-left"></i>',
        next: '<i class="ace-icon fa fa-arrow-right"></i>',
        close: '&times;',
        current: '{current} of {total}',
        maxWidth: '100%',
        maxHeight: '100%',
        onOpen: function () {
            $overflow = document.body.style.overflow;
            document.body.style.overflow = 'hidden';
        },
        onClosed: function () {
            document.body.style.overflow = $overflow;
        },
        onComplete: function () {
            $.colorbox.resize();
        }
    };

    $('.ace-thumbnails [data-rel="colorbox"]').colorbox(colorbox_params);
    $("#cboxLoadingGraphic").html("<i class='ace-icon fa fa-spinner orange fa-spin'></i>");//let's add a custom loading icon

}

function bindMultiSelect(id) {
    $('#' + id).multiselect({
        enableFiltering: true,
        enableHTML: true,
        enableCaseInsensitiveFiltering: true,
        buttonClass: 'btn btn-white btn-primary',
        templates: {
            button: '<button type="button" class="multiselect dropdown-toggle" data-toggle="dropdown"><span class="multiselect-selected-text"></span> &nbsp;<b class="fa fa-caret-down"></b></button>',
            ul: '<ul class="multiselect-container dropdown-menu"></ul>',
            filter: '<li class="multiselect-item filter"><div class="input-group"><span class="input-group-addon"><i class="fa fa-search"></i></span><input class="form-control multiselect-search" type="text"></div></li>',
            filterClearBtn: '<span class="input-group-btn"><button class="btn btn-default btn-white btn-grey multiselect-clear-filter" type="button"><i class="fa fa-times-circle red2"></i></button></span>',
            li: '<li><a tabindex="0"><label></label></a></li>',
            divider: '<li class="multiselect-item divider"></li>',
            liGroup: '<li class="multiselect-item multiselect-group"><label></label></li>'
        }
    });
}

function bindMultiSelectCls(cls) {
    $('.' + cls).multiselect({
        enableFiltering: true,
        enableHTML: true,
        enableCaseInsensitiveFiltering: true,
        buttonClass: 'btn btn-white btn-primary',
        templates: {
            button: '<button type="button" class="multiselect dropdown-toggle" data-toggle="dropdown"><span class="multiselect-selected-text"></span> &nbsp;<b class="fa fa-caret-down"></b></button>',
            ul: '<ul class="multiselect-container dropdown-menu"></ul>',
            filter: '<li class="multiselect-item filter"><div class="input-group"><span class="input-group-addon"><i class="fa fa-search"></i></span><input class="form-control multiselect-search" type="text"></div></li>',
            filterClearBtn: '<span class="input-group-btn"><button class="btn btn-default btn-white btn-grey multiselect-clear-filter" type="button"><i class="fa fa-times-circle red2"></i></button></span>',
            li: '<li><a tabindex="0"><label></label></a></li>',
            divider: '<li class="multiselect-item divider"></li>',
            liGroup: '<li class="multiselect-item multiselect-group"><label></label></li>'
        }
    });
}