<!-- ace settings handler -->
<script src="js/libs/ace-extra.min.js"></script>

<!-- basic scripts -->
<!--[if !IE]> -->
<script src="js/libs/jquery-2.1.4.min.js"></script>

<!-- <![endif]-->

<!--[if IE]>
<script src="js/libs/jquery-1.11.3.min.js"></script>
<![endif]-->

<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

<!--[if lte IE 8]>
<script src="js/libs/html5shiv.min.js"></script>
<script src="js/libs/respond.min.js"></script>
<![endif]-->

<script src="js/libs/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->

<!-- ace scripts -->
<script src="js/libs/jquery-ui.custom.min.js"></script>
<script src="js/libs/jquery.ui.touch-punch.min.js"></script>
<script src="js/libs/markdown.min.js"></script>
<script src="js/libs/bootstrap-markdown.min.js"></script>
<script src="js/libs/jquery.hotkeys.index.min.js"></script>
<script src="js/libs/bootstrap-wysiwyg.min.js"></script>
<script src="js/libs/bootbox.js"></script>
<script src="js/libs/bootstrap-datepicker.min.js"></script>
<script src="js/libs/sweetalert.min.js"></script>
<script src="js/libs/jquery.validate.min.js"></script>
<script src="js/libs/jquery-dateFormat.min.js"></script>
<script src="js/libs/jquery.rest.js"></script>
<script src="js/libs/jquery.colorbox.min.js"></script>
<script src="js/libs/jquery.dataTables.min.js"></script>
<script src="js/libs/jquery.dataTables.bootstrap.min.js"></script>
<script src="js/libs/dataTables.buttons.min.js"></script>
<script src="js/libs/pdfmake.min.js"></script>
<script src="js/libs/vfs_fonts.js"></script>
<script src="js/libs/buttons.flash.min.js"></script>
<script src="js/libs/buttons.html5.min.js"></script>
<script src="js/libs/buttons.print.min.js"></script>
<script src="js/libs/buttons.colVis.min.js"></script>
<script src="js/libs/jquery.isloading.min.js"></script>
<script src="js/libs/ace-elements.min.js"></script>
<script src="js/libs/ace.min.js"></script>
<script src="js/libs/bootstrap-multiselect.min.js"></script>
<script src="js/libs/jquery.easypiechart.min.js" type="text/javascript"></script>
<script src="js/libs/jquery.flot.min.js" type="text/javascript"></script>
<script src="js/libs/jquery.flot.pie.min.js" type="text/javascript"></script>
<script src="js/libs/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="js/libs/jquery-ui.min.js" type="text/javascript"></script>
<script src="js/libs/jquery.loading.min.js"></script>
<script src="js/libs/summernote.min.js"></script>
<script src="js/libs/summernote-bs4.min.js"></script>
<!--<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>-->
<script src="js/validation.js"></script>
<script src="js/common.js"></script>
<script src="js/script.js?v3"></script>

<script type="text/javascript">
    if ('ontouchstart' in document.documentElement) {
        document.write("<script src='js/libs/jquery.mobile.custom.min.js'>" + "<" + "/script>");
    }
    var username = '';
    if (window.sessionStorage.getItem('session') !== null) {
        username = window.sessionStorage.getItem('name');
        $('#logged_in_user').html(username);
    }
    /*new FroalaEditor('#overview, #solution, #benefits, #testimonial_message', {
     // Set custom buttons with separator between them.
     toolbarButtons: ['undo', 'redo', '|', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'formatOL', 'formatUL', 'clearFormatting', 'insertTable', 'html'],
     toolbarButtonsXS: ['undo', 'redo', '-', 'bold', 'italic', 'underline'],
     heightMin: 300,
     });*/
    $('#overview, #solution, #benefits, #update_overview, #update_solution, #update_benefits, #testimonial_message, #update_testimonial_message, #update_home_news').summernote({
        tabsize: 2,
        height: 100
    });
</script>