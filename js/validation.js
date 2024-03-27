$(function () {
    var errorPlacement = function (error, element) {
        if (element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
            var controls = element.closest('div[class*="col-"]');
            if (controls.find(':checkbox,:radio').length > 1)
                controls.append(error);
            else
                error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
        } else if (element.is('.select2')) {
            error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
        } else if (element.is('.chosen-select')) {
            error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
        } else
            error.insertAfter(element.parent());
    };

    $('#login_form').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        rules: {
            uname: {
                required: {
                    depends: function () {
                        $(this).val($(this).val());
                        return true;
                    }
                }
            },
            password: {
                required: {
                    depends: function () {
                        $(this).val($(this).val());
                        return true;
                    }
                }
            }
        },
        messages: {
            uname: {
                required: 'Please provide a valid username.'
            },
            password: {
                required: 'Please specify a password.'
            }
        },
        submitHandler: function (form) {
            var data = {uname: $('#uname').val(), password: $('#password').val()};
            var api = new $.RestClient('v1/index.php/');
            api.add('login', {url: 'login', stripTrailingSlash: true});
            var result = api.login.create(data);
            result.done(function (rs) {
                if (rs.result.error === false) {
                    window.sessionStorage.setItem('session', rs.result.data.ID);
                    window.sessionStorage.setItem('name', rs.result.data.name);
                    window.location = 'stores.php';
                } else {
                    swal('Error', rs.result.message, 'error');
                }
            });
            result.fail(function (err) {
                swal('Error', err.responseJSON.result.message, 'error');
            });
        }
    });

    $('#update_store_form').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        rules: {
            update_comment: {
                required: {
                    depends: function () {
                        $(this).val($(this).val());
                        return true;
                    }
                }
            },
            update_is_contacted: {
                required: {
                    depends: function () {
                        $(this).val($(this).val());
                        return true;
                    }
                }
            }
        },
        messages: {
            update_comment: {
                required: 'Please fill this field.'
            },
            update_is_contacted: {
                required: 'Please fill this field.'
            }
        },
        highlight: function (e) {
            $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
        },
        success: function (e) {
            $(e).closest('.form-group').removeClass('has-error'); //.addClass('has-info');
            $(e).remove();
        },
        errorPlacement: errorPlacement,
        submitHandler: function (form) {
            var data = new FormData(form);
            var api = new $.RestClient('v1/index.php/');
            api.add('master', {url: 'store', stripTrailingSlash: true, multipart: true, methodOverride: true});
            var result = api.master.update(data);
            result.done(function (rs) {
                if (rs.result.error === false) {
                    $('#update_store').modal('hide');
                    swal('Success', rs.result.message, 'success');
                    var status = 'N/A';
                    switch (rs.result.data.is_contacted) {
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
                        case '3':
                        case 3:
                            status = 'Unreachable';
                            break;
                        case '4':
                        case 4:
                            status = 'Not live';
                            break;
                        default:
                            break;
                    }
                    $('#email_address_' + rs.result.data.ID).html(rs.result.data.email_address);
                    $('#phone_number_' + rs.result.data.ID).html(rs.result.data.phone_number);
                    $('#comment_' + rs.result.data.ID).html((removeTags(rs.result.data.comment) && (removeTags(rs.result.data.comment)).length > 200 ? (removeTags(rs.result.data.comment).substring(0, 197) + '...&nbsp;<a class="pointer" onclick="openModal(\'update_store\', ' + rs.result.data.ID + ');">Read more</a>') : removeTags(rs.result.data.comment)));
                    $('#status_' + rs.result.data.ID).html(status);
                    $('#lead_by_' + rs.result.data.ID).html((rs.result.data.staff ? rs.result.data.staff : '-'));
                    $('#category_' + rs.result.data.ID).html((rs.result.data.category ? rs.result.data.category : '-'));
                } else {
                    swal('Error', rs.result.message, 'error');
                }
            });
            result.fail(function (err) {
                swal('Error', err.responseJSON.result.message, 'error');
            });
            return false;
        }
    });

    $('#keyword_form').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        rules: {
            keyword: {
                required: {
                    depends: function () {
                        $(this).val($(this).val());
                        return true;
                    }
                }
            }
        },
        messages: {
            keyword: {
                required: 'Please fill this field.'
            }
        },
        highlight: function (e) {
            $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
        },
        success: function (e) {
            $(e).closest('.form-group').removeClass('has-error'); //.addClass('has-info');
            $(e).remove();
        },
        errorPlacement: errorPlacement,
        submitHandler: function (form) {
            var data = new FormData(form);
            var api = new $.RestClient('v1/index.php/');
            api.add('master', {url: 'keyword', stripTrailingSlash: true, multipart: true, methodOverride: true});
            var result = api.master.create(data);
            result.done(function (rs) {
                if (rs.result.error === false) {
                    $('#add_keyword').modal('hide');
                    swal('Success', rs.result.message, 'success');
                    showKeywordsPage();
                } else {
                    swal('Error', rs.result.message, 'error');
                }
            });
            result.fail(function (err) {
                swal('Error', err.responseJSON.result.message, 'error');
            });
            return false;
        }
    });

    $('#update_keyword_form').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        rules: {
            update_keyword: {
                required: {
                    depends: function () {
                        $(this).val($(this).val());
                        return true;
                    }
                }
            }
        },
        messages: {
            update_keyword: {
                required: 'Please fill this field.'
            }
        },
        highlight: function (e) {
            $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
        },
        success: function (e) {
            $(e).closest('.form-group').removeClass('has-error'); //.addClass('has-info');
            $(e).remove();
        },
        errorPlacement: errorPlacement,
        submitHandler: function (form) {
            var data = new FormData(form);
            data.append('update_keyword_id', $('#update_keyword_id').val());
            var api = new $.RestClient('v1/index.php/');
            api.add('master', {url: 'keyword', stripTrailingSlash: true, multipart: true, methodOverride: true});
            var result = api.master.update(data);
            result.done(function (rs) {
                if (rs.result.error === false) {
                    $('#update_keyword').modal('hide');
                    swal('Success', rs.result.message, 'success');
                    showKeywordsPage();
                } else {
                    swal('Error', rs.result.message, 'error');
                }
            });
            result.fail(function (err) {
                swal('Error', err.responseJSON.result.message, 'error');
            });
            return false;
        }
    });

    $('#staff_form').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        rules: {
            keyword: {
                required: {
                    depends: function () {
                        $(this).val($(this).val());
                        return true;
                    }
                }
            }
        },
        messages: {
            keyword: {
                required: 'Please fill this field.'
            }
        },
        highlight: function (e) {
            $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
        },
        success: function (e) {
            $(e).closest('.form-group').removeClass('has-error'); //.addClass('has-info');
            $(e).remove();
        },
        errorPlacement: errorPlacement,
        submitHandler: function (form) {
            var data = new FormData(form);
            var api = new $.RestClient('v1/index.php/');
            api.add('master', {url: 'staff', stripTrailingSlash: true, multipart: true, methodOverride: true});
            var result = api.master.create(data);
            result.done(function (rs) {
                if (rs.result.error === false) {
                    $('#add_staff').modal('hide');
                    swal('Success', rs.result.message, 'success');
                    showStaffsPage();
                } else {
                    swal('Error', rs.result.message, 'error');
                }
            });
            result.fail(function (err) {
                swal('Error', err.responseJSON.result.message, 'error');
            });
            return false;
        }
    });

    $('#update_staff_form').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        rules: {
            update_keyword: {
                required: {
                    depends: function () {
                        $(this).val($(this).val());
                        return true;
                    }
                }
            }
        },
        messages: {
            name: {
                required: 'Please fill this field.'
            }
        },
        highlight: function (e) {
            $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
        },
        success: function (e) {
            $(e).closest('.form-group').removeClass('has-error'); //.addClass('has-info');
            $(e).remove();
        },
        errorPlacement: errorPlacement,
        submitHandler: function (form) {
            var data = new FormData(form);
            data.append('update_staff_id', $('#update_staff_id').val());
            var api = new $.RestClient('v1/index.php/');
            api.add('master', {url: 'staff', stripTrailingSlash: true, multipart: true, methodOverride: true});
            var result = api.master.update(data);
            result.done(function (rs) {
                if (rs.result.error === false) {
                    $('#update_staff').modal('hide');
                    swal('Success', rs.result.message, 'success');
                    showStaffsPage();
                } else {
                    swal('Error', rs.result.message, 'error');
                }
            });
            result.fail(function (err) {
                swal('Error', err.responseJSON.result.message, 'error');
            });
            return false;
        }
    });

    $('#category_form').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        rules: {
            name: {
                required: {
                    depends: function () {
                        $(this).val($(this).val());
                        return true;
                    }
                }
            }
        },
        messages: {
            name: {
                required: 'Please fill this field.'
            }
        },
        highlight: function (e) {
            $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
        },
        success: function (e) {
            $(e).closest('.form-group').removeClass('has-error'); //.addClass('has-info');
            $(e).remove();
        },
        errorPlacement: errorPlacement,
        submitHandler: function (form) {
            var data = new FormData(form);
            var api = new $.RestClient('v1/index.php/');
            api.add('master', {url: 'category', stripTrailingSlash: true, multipart: true, methodOverride: true});
            var result = api.master.create(data);
            result.done(function (rs) {
                if (rs.result.error === false) {
                    $('#add_category').modal('hide');
                    swal('Success', rs.result.message, 'success');
                    showCategoriesPage();
                } else {
                    swal('Error', rs.result.message, 'error');
                }
            });
            result.fail(function (err) {
                swal('Error', err.responseJSON.result.message, 'error');
            });
            return false;
        }
    });

    $('#update_category_form').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        rules: {
            update_name: {
                required: {
                    depends: function () {
                        $(this).val($(this).val());
                        return true;
                    }
                }
            }
        },
        messages: {
            update_name: {
                required: 'Please fill this field.'
            }
        },
        highlight: function (e) {
            $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
        },
        success: function (e) {
            $(e).closest('.form-group').removeClass('has-error'); //.addClass('has-info');
            $(e).remove();
        },
        errorPlacement: errorPlacement,
        submitHandler: function (form) {
            var data = new FormData(form);
            data.append('update_name_id', $('#update_name_id').val());
            var api = new $.RestClient('v1/index.php/');
            api.add('master', {url: 'category', stripTrailingSlash: true, multipart: true, methodOverride: true});
            var result = api.master.update(data);
            result.done(function (rs) {
                if (rs.result.error === false) {
                    $('#update_category').modal('hide');
                    swal('Success', rs.result.message, 'success');
                    showCategoriesPage();
                } else {
                    swal('Error', rs.result.message, 'error');
                }
            });
            result.fail(function (err) {
                swal('Error', err.responseJSON.result.message, 'error');
            });
            return false;
        }
    });
});