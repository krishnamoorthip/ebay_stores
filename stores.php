<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <?php include "basic_css.php"; ?>
    <body class="no-skin" onload="buildStaffDropdown();showStoresPage();">
        <?php include "header.php"; ?>
        <div class="main-container ace-save-state" id="main-container">
            <div id="sidebar" class="sidebar responsive ace-save-state">
                <?php
                $active = "Stores";
                include "menu.php";
                ?>
            </div>
            <div class="main-content">
                <div class="main-content-inner">
                    <div class="page-content">
                        <div class="page-header">
                            <h1>Stores management</h1>
                        </div><!-- /.page-header -->

                        <div class="row">
                            <div class="col-xs-12">
                                <!-- PAGE CONTENT BEGINS -->
                                <div class="tabbable">
                                    <ul class="nav nav-tabs" id="myTab">
                                        <li class="active">
                                            <a data-toggle="tab" href="#tab1">
                                                Stores
                                                <span class="badge badge-danger" id="tab1_count"></span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="tab1" class="tab-pane fade in active">
                                            <div class="clearfix">
                                                <div class="pull-left">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="filter_status">Status:</label>
                                                                <select id="filter_status" name="filter_status" class="form-control" onchange="showStoresPage();">
                                                                    <option value="">--All--</option>
                                                                    <option value="0">New</option>
                                                                    <option value="1">Contacted</option>
                                                                    <option value="2">Follow-up</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="filter_staff_id">Lead By:</label>
                                                                <select id="filter_staff_id" name="filter_staff_id" class="form-control" onchange="showStoresPage();">
                                                                    <option value="">--All--</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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

        <div id="update_store" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 class="smaller lighter blue no-margin">Store - <span id="sotre_name"></span></h3>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" id="update_store_form">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="update_email_address">Email:</label>
                                        <input type="text" name="update_email_address" id="update_email_address" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="update_phone_number">Phone:</label>
                                        <input type="text" name="update_phone_number" id="update_phone_number" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="update_staff_id">Lead By:</label>
                                        <select name="update_staff_id" id="update_staff_id" class="form-control" data-placeholder="Click to Choose...">
                                            <option value="">--Select one--</option>
                                            <option value="1">Staff one</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="update_is_contacted">Is Contacted?:</label>
                                        <select id="update_is_contacted" name="update_is_contacted" class="form-control" data-placeholder="Click to Choose...">
                                            <option value="">--Select Option--</option>
                                            <option value="1">Contacted</option>
                                            <option value="2">Follow-up</option>
                                            <option value="0">New</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="update_comment">Comment:</label>
                                        <textarea id="update_comment" name="update_comment" class="form-control" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="update_store_id" name="update_store_id" value="0" />
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
