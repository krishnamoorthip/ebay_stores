<?php
session_start();
if (isset($_SESSION) && $_SESSION['name'] != 'Admin') {
    header('Location: stores.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
    <?php include "basic_css.php"; ?>
    <body class="no-skin" onload="showKeywordsPage();">
        <?php include "header.php"; ?>
        <div class="main-container ace-save-state" id="main-container">
            <div id="sidebar" class="sidebar responsive ace-save-state">
                <?php
                $active = "Keywords";
                include "menu.php";
                ?>
            </div>
            <div class="main-content">
                <div class="main-content-inner">
                    <div class="page-content">
                        <div class="ace-settings-container" id="ace-settings-container">
                            <div class="btn btn-app btn-xs btn-warning ace-settings-btn open" id="ace-settings-btn">
                                <i class="ace-icon fa fa-list bigger-130"></i>
                            </div>

                            <div class="ace-settings-box clearfix open" id="ace-settings-box">
                                <div class="pull-left width-50">
                                    <div class="ace-settings-item">
                                        <a onclick="openModal('add_keyword', 0);" class="pointer">Add keyword</a>
                                    </div>
                                </div><!-- /.pull-left -->
                            </div><!-- /.ace-settings-box -->
                        </div><!-- /.ace-settings-container -->

                        <div class="page-header">
                            <h1>Keywords management</h1>
                        </div><!-- /.page-header -->

                        <div class="row">
                            <div class="col-xs-12">
                                <!-- PAGE CONTENT BEGINS -->
                                <div class="tabbable">
                                    <ul class="nav nav-tabs" id="myTab">
                                        <li class="active">
                                            <a data-toggle="tab" href="#tab1">
                                                Keywords
                                                <span class="badge badge-danger" id="tab1_count"></span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="tab1" class="tab-pane fade in active">
                                            <div class="clearfix">
                                                <div class="pull-right tableTools-container"></div>
                                            </div>
                                            <div id="tab1_table"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- PAGE CONTENT ENDS -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.page-content -->
                </div>
            </div><!-- /.main-content -->
            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
            </a>
        </div><!-- /.main-container -->

        <div id="add_keyword" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 class="smaller lighter blue no-margin">Keyword</h3>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" id="keyword_form">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="keyword">Keyword:</label>
                                        <input type="text" name="keyword" id="keyword" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="is_refresh">Is Refresh?:</label>
                                        <select id="is_refresh" name="is_refresh" class="form-control" data-placeholder="Click to Choose...">
                                            <option value="">--Select Option--</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="clearfix align-center">
                                    <button type="submit" class="width-35 btn btn-sm btn-primary">
                                        <span class="bigger-110">Submit</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                            <i class="ace-icon fa fa-times"></i>
                            Close
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

        <div id="update_keyword" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 class="smaller lighter blue no-margin">Keyword</h3>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" id="update_keyword_form">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="update_key">Keyword:</label>
                                        <input type="text" name="update_key" id="update_key" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="update_is_refresh">Is Refresh?:</label>
                                        <select id="update_is_refresh" name="update_is_refresh" class="form-control" data-placeholder="Click to Choose...">
                                            <option value="">--Select Option--</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="update_keyword_id" name="update_keyword_id" value="0" />
                            <div class="form-group">
                                <div class="clearfix align-center">
                                    <button type="submit" class="width-35 btn btn-sm btn-primary">
                                        <span class="bigger-110">Submit</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                            <i class="ace-icon fa fa-times"></i>
                            Close
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <?php include "basic_js.php"; ?>
    </body>
</html>
