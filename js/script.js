function logoutAdmin() {
    window.sessionStorage.removeItem('session');
    window.location = 'index.php';
}

function openModal(modal, id) {
    $('#' + modal + '_id').val(id);
    $('#' + modal + ' div').removeClass('has-error');
    var url = '';
    if (modal === 'update_store') {
        url = 'store';
    }
    if (modal === 'update_keyword') {
        url = 'keyword';
    }
    if (modal === 'update_staff') {
        url = 'staff';
    }
    if (id > 0) {
        var api = new $.RestClient('v1/index.php/');
        api.add('master', {url: url, stripTrailingSlash: true});
        var result = api.master.read(id);
        result.done(function (rs) {
            if (rs.result.error === false) {
                if (modal === 'update_store') {
                    $('#sotre_name').html(rs.result.data.store_identity);
                    $('#update_email_address').val(rs.result.data.email_address);
                    $('#update_phone_number').val(rs.result.data.phone_number);
                    $('#update_staff_id').val(rs.result.data.staff_id);
                    $('#update_is_contacted').val(rs.result.data.is_contacted);
                    $('#update_comment').summernote('code', rs.result.data.comment);
                }
                if (modal === 'update_keyword') {
                    $('#update_key').val(rs.result.data.keyword);
                    $('#update_is_refresh').val(rs.result.data.is_refresh);
                }
                if (modal === 'update_staff') {
                    $('#update_name').val(rs.result.data.name);
                }
                $('#' + modal).modal('show');
            }
        });
        result.fail(function (err) {
            swal('Error', err.responseJSON.result.message, 'error');
        });
    } else {
        $('#' + modal).modal('show');
    }
}

function showStoresPage() {
    var status = null;
    var lead_by = null;
    if ($('#filter_status').val() != '') {
        status = $('#filter_status').val();
    }
    if ($('#filter_staff_id').val() != '') {
        lead_by = $('#filter_staff_id').val();
    }
    var api = new $.RestClient('v1/index.php/');
    api.add('master', {url: 'store/' + status + '/' + lead_by, stripTrailingSlash: true});
    var result = api.master.read();
    result.done(function (rs) {
        $('#tab1_table').empty();
        $('#tab1_count').html(0);
        if (rs.result.error === false) {
            var table = '<table id="tab1_datatable" class="table table-striped table-bordered table-hover">';
            table = table + '<thead><tr><th>SL. No.</th><th>Store ID</th><th>Link</th><th>Email</th><th>Phone</th><th>Comment</th><th>Status</th><th>Lead By</th><th>Updated On</th><th></th></tr></thead><tbody>';
            $.each(rs.result.data, function (index, row) {
                var status = 'N/A';
                switch (row.is_contacted) {
                    case '0':
                    case 0:
                        status = 'New';
                        break;
                    case '1':
                    case 1:
                        status = 'Contacted';
                        break;
                    case '2':
                    case 2:
                        status = 'Follow-up';
                        break;
                    default:
                        break;
                }
                table = table + '<tr><td>' + (index + 1) + '</td><td>' + row.store_identity + '</td><td>' + row.store_link + '&nbsp;<a href="' + row.store_link + '" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a></td><td id="email_address_' + row.ID + '">' + row.email_address + '</td><td id="phone_number_' + row.ID + '">' + row.phone_number + '</td><td id="comment_' + row.ID + '">' + (removeTags(row.comment) && (removeTags(row.comment)).length > 200 ? (removeTags(row.comment).substring(0, 197) + '...&nbsp;<a class="pointer" onclick="openModal(\'update_store\', ' + row.ID + ');">Read more</a>') : removeTags(row.comment)) + '</td><td id="status_' + row.ID + '">' + status + '</td><td id="lead_by_' + row.ID + '">' + (row.staff ? row.staff : '-') + '</td><td>' + row.updated_at + '</td><td><a class="green pointer" onclick="openModal(\'update_store\', ' + row.ID + ');"><i class="ace-icon fa fa-comment bigger-130"></i></a></td></tr>';
            });
            table = table + '</tbody></table>';
            $('#tab1_table').append(table);
            $('#tab1_count').html((rs.result.data).length);
            var cols = [
                {"bSortable": false},
                null, null, null, null, {"bSortable": false}, null, {"bSortable": false},
                {"bSortable": false}, {"bSortable": false}
            ];
            dataTable('tab1_datatable', 'tab1', cols, 'eBay_stores_list');
        } else {
            $('#tab1_table').append(rs.result.message);
        }
    });
    result.fail(function (err) {
        swal('Error', err.responseJSON.result.message, 'error');
    });
}

function showKeywordsPage() {
    var api = new $.RestClient('v1/index.php/');
    api.add('master', {url: 'keyword', stripTrailingSlash: true});
    var result = api.master.read();
    result.done(function (rs) {
        $('#tab1_table').empty();
        $('#tab1_count').html(0);
        if (rs.result.error === false) {
            var table = '<table id="tab1_datatable" class="table table-striped table-bordered table-hover">';
            table = table + '<thead><tr><th>SL. No.</th><th>Keyword</th><th>Is Refresh?</th><th></th></tr></thead><tbody>';
            $.each(rs.result.data, function (index, row) {
                table = table + '<tr><td>' + (index + 1) + '</td><td>' + row.keyword + '</td><td>' + (row.is_refresh == 1 ? 'Yes' : 'No') + '</td><td><a class="green pointer" onclick="openModal(\'update_keyword\', ' + row.ID + ');"><i class="ace-icon fa fa-pencil bigger-130"></i></a>&nbsp;&nbsp;&nbsp;<a class="red pointer" onclick="removeKeyword(' + row.ID + ');"><i class="ace-icon fa fa-trash-o bigger-130"></i></a></td></tr>';
            });
            table = table + '</tbody></table>';
            $('#tab1_table').append(table);
            $('#tab1_count').html((rs.result.data).length);
            var cols = [
                null, null, null, {"bSortable": false}
            ];
            dataTable('tab1_datatable', 'tab1', cols, 'eBay_keywords_list');
        } else {
            $('#tab1_table').append(rs.result.message);
        }
    });
    result.fail(function (err) {
        swal('Error', err.responseJSON.result.message, 'error');
    });
}

function showStaffsPage() {
    var api = new $.RestClient('v1/index.php/');
    api.add('master', {url: 'staff', stripTrailingSlash: true});
    var result = api.master.read();
    result.done(function (rs) {
        $('#tab1_table').empty();
        $('#tab1_count').html(0);
        if (rs.result.error === false) {
            var table = '<table id="tab1_datatable" class="table table-striped table-bordered table-hover">';
            table = table + '<thead><tr><th>SL. No.</th><th>Staff</th><th></th></tr></thead><tbody>';
            $.each(rs.result.data, function (index, row) {
                var delete_staff = '';
                if (row.ID != 1) {
                    delete_staff = '<a class="red pointer" onclick="removeStaff(' + row.ID + ');"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>';
                }
                table = table + '<tr><td>' + (index + 1) + '</td><td>' + row.name + '</td><td><a class="green pointer" onclick="openModal(\'update_staff\', ' + row.ID + ');"><i class="ace-icon fa fa-pencil bigger-130"></i></a>&nbsp;&nbsp;&nbsp;' + delete_staff + '</td></tr>';
            });
            table = table + '</tbody></table>';
            $('#tab1_table').append(table);
            $('#tab1_count').html((rs.result.data).length);
            var cols = [
                null, null, {"bSortable": false}
            ];
            dataTable('tab1_datatable', 'tab1', cols, 'eBay_staffs_list');
        } else {
            $('#tab1_table').append(rs.result.message);
        }
    });
    result.fail(function (err) {
        swal('Error', err.responseJSON.result.message, 'error');
    });
}

function removeKeyword(id) {
    swal({
        title: 'Are you sure?',
        text: 'Do you want to delete this? You can\'t recover this!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Yes, delete it!',
        closeOnConfirm: false,
        showLoaderOnConfirm: true
    }, function () {
        var api = new $.RestClient('v1/index.php/');
        api.add('master', {url: 'keyword', stripTrailingSlash: true});
        var result = api.master.del(id);
        result.done(function (rs) {
            if (rs.result.error === false) {
                showKeywordsPage();
                swal('Success', rs.result.message, 'success');
            } else {
                swal('Error', rs.result.message, 'error');
            }
        });
        result.fail(function (err) {
            swal('Error', err.responseJSON.result.message, 'error');
        });
    });
}

function removeStaff(id) {
    swal({
        title: 'Are you sure?',
        text: 'Do you want to delete this? You can\'t recover this!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Yes, delete it!',
        closeOnConfirm: false,
        showLoaderOnConfirm: true
    }, function () {
        var api = new $.RestClient('v1/index.php/');
        api.add('master', {url: 'staff', stripTrailingSlash: true});
        var result = api.master.del(id);
        result.done(function (rs) {
            if (rs.result.error === false) {
                showStaffsPage();
                swal('Success', rs.result.message, 'success');
            } else {
                swal('Error', rs.result.message, 'error');
            }
        });
        result.fail(function (err) {
            swal('Error', err.responseJSON.result.message, 'error');
        });
    });
}

function removeTags(str) {
    if ((str === null) || (str === ''))
        return '';
    else
        str = str.toString();

    // Regular expression to identify HTML tags in
    // the input string. Replacing the identified
    // HTML tag with a null string.
    return str.replace(/(<([^>]+)>)/ig, '');
}

function buildStaffDropdown() {
    var api = new $.RestClient('v1/index.php/');
    api.add('master', {url: 'staff', stripTrailingSlash: true});
    var result = api.master.read();
    result.done(function (rs) {
        $('#update_staff_id').empty();
        $('#filter_staff_id').empty();
        if (rs.result.error === false) {
            var options = '<option value="">--Select staff--</option>';
            var options_filter = '<option value="">--All--</option>';
            $.each(rs.result.data, function (index, row) {
                options = options + '<option value="' + row.ID + '">' + row.name + '</option>';
                options_filter = options_filter + '<option value="' + row.ID + '">' + row.name + '</option>';
            });
            $('#update_staff_id').append(options);
            $('#filter_staff_id').append(options_filter);
        }
    });
    result.fail(function (err) {
        swal('Error', err.responseJSON.result.message, 'error');
    });
}