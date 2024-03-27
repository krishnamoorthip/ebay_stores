<?php

$app->post('/login', function () use ($app) {
    verifyRequiredParams(array('uname', 'password'));
    $data = array('email' => $app->request->post('uname'), 'password' => $app->request->post('password'));
    $db = new DbHandler();
    $res = $db->loginAdmin($data);
    if ($res['error'] == false) {
        $response['error'] = false;
        $response['data'] = $res['data'];
        $response['message'] = $res['message'];
    } else {
        $response['message'] = $res['message'];
    }
    echoRespnse(201, $response);
});

$app->get('/store/:status/:staff/:category/:nonassigned', function ($status, $staff, $category, $nonassigned) {
    $db = new DbHandler();
    $res = $db->getAllStores($status, $staff, $category, $nonassigned);
    if ($res['error'] === false) {
        $response['error'] = false;
        $response['data'] = $res['data'];
        $response['message'] = $res['message'];
    } else {
        $response = array('error' => true, 'message' => $res['message']);
    }
    echoRespnse(201, $response);
});

$app->put('/store', function () use ($app) {
    verifyRequiredParams(array('update_comment', 'update_is_contacted'));
    $db = new DbHandler();
    $staff_id = 0;
    $cat_id = 0;
    if (!empty($app->request->put('update_staff_id'))) {
        $staff_id = $app->request->put('update_staff_id');
    }
    if (!empty($app->request->put('update_category_id'))) {
        $cat_id = $app->request->put('update_category_id');
    }
    $data = array('ID' => $app->request->put('update_store_id'), 'comment' => $app->request->put('update_comment'), 'email_address' => $app->request->put('update_email_address'), 'phone_number' => $app->request->put('update_phone_number'), 'staff_id' => $staff_id, 'category_id' => $cat_id, 'is_contacted' => $app->request->put('update_is_contacted'));
    $res = $db->updateStore($data);
    if ($res['error'] === false) {
        $response['error'] = false;
        $response['message'] = 'Store updated successfully';
        $staff = $db->getStaffById($staff_id);
        $category = $db->getCategoryById($cat_id);
        if ($staff['error'] == true) {
            $data['staff'] = '';
        } else {
            $data['staff'] = $staff['data']['name'];
        }
        if ($category['error'] == true) {
            $data['category'] = '';
        } else {
            $data['category'] = $category['data']['name'];
        }
        $response['data'] = $data;
    } else {
        $response = array('error' => true, 'message' => $res['message']);
    }
    echoRespnse(201, $response);
});

$app->get('/store/:id', function ($id) {
    $db = new DbHandler();
    $res = $db->getStoreById($id);
    if ($res['error'] === false) {
        $response['error'] = false;
        $response['message'] = $res['message'];
        $response['data'] = $res['data'];
    } else {
        $response = array('error' => true, 'message' => $res['message']);
    }
    echoRespnse(201, $response);
});

$app->get('/keyword', function () {
    $db = new DbHandler();
    $res = $db->getAllKeyword();
    if ($res['error'] === false) {
        $response['error'] = false;
        $response['data'] = $res['data'];
        $response['message'] = $res['message'];
    } else {
        $response = array('error' => true, 'message' => $res['message']);
    }
    echoRespnse(201, $response);
});

$app->post('/keyword', function () use ($app) {
    verifyRequiredParams(array('keyword', 'is_refresh'));
    $db = new DbHandler();
    $data = array('keyword' => $app->request->post('keyword'), 'is_refresh' => $app->request->post('is_refresh'));
    $res = $db->addKeyword($data);
    if ($res['error'] === false) {
        $response['error'] = false;
        $response['message'] = 'Keyword added successfully';
    } else {
        $response = array('error' => true, 'message' => $res['message']);
    }
    echoRespnse(201, $response);
});

$app->put('/keyword', function () use ($app) {
    verifyRequiredParams(array('update_key', 'update_is_refresh'));
    $db = new DbHandler();
    $data = array('ID' => $app->request->put('update_keyword_id'), 'keyword' => $app->request->put('update_key'), 'is_refresh' => $app->request->put('update_is_refresh'));
    $res = $db->updateKeyword($data);
    if ($res['error'] === false) {
        $response['error'] = false;
        $response['message'] = 'Keyword updated successfully';
    } else {
        $response = array('error' => true, 'message' => $res['message']);
    }
    echoRespnse(201, $response);
});

$app->get('/keyword/:id', function ($id) {
    $db = new DbHandler();
    $res = $db->getKeywordById($id);
    if ($res['error'] === false) {
        $response['error'] = false;
        $response['message'] = $res['message'];
        $response['data'] = $res['data'];
    } else {
        $response = array('error' => true, 'message' => $res['message']);
    }
    echoRespnse(201, $response);
});

$app->delete('/keyword/:id', function ($id) {
    $db = new DbHandler();
    $res = $db->deleteKeywordById($id);
    if ($res['error'] === false) {
        $response['error'] = false;
        $response['message'] = $res['message'];
    } else {
        $response = array('error' => true, 'message' => $res['message']);
    }
    echoRespnse(201, $response);
});

$app->get('/staff', function () {
    $db = new DbHandler();
    $res = $db->getAllStaff();
    if ($res['error'] === false) {
        $response['error'] = false;
        $response['data'] = $res['data'];
        $response['message'] = $res['message'];
    } else {
        $response = array('error' => true, 'message' => $res['message']);
    }
    echoRespnse(201, $response);
});

$app->post('/staff', function () use ($app) {
    verifyRequiredParams(array('name'));
    $db = new DbHandler();
    $data = array('name' => $app->request->post('name'));
    $res = $db->addStaff($data);
    if ($res['error'] === false) {
        $response['error'] = false;
        $response['message'] = 'Staff added successfully';
    } else {
        $response = array('error' => true, 'message' => $res['message']);
    }
    echoRespnse(201, $response);
});

$app->put('/staff', function () use ($app) {
    verifyRequiredParams(array('update_name'));
    $db = new DbHandler();
    $data = array('ID' => $app->request->put('update_staff_id'), 'name' => $app->request->put('update_name'));
    $res = $db->updateStaff($data);
    if ($res['error'] === false) {
        $response['error'] = false;
        $response['message'] = 'Staff updated successfully';
    } else {
        $response = array('error' => true, 'message' => $res['message']);
    }
    echoRespnse(201, $response);
});

$app->get('/staff/:id', function ($id) {
    $db = new DbHandler();
    $res = $db->getStaffById($id);
    if ($res['error'] === false) {
        $response['error'] = false;
        $response['message'] = $res['message'];
        $response['data'] = $res['data'];
    } else {
        $response = array('error' => true, 'message' => $res['message']);
    }
    echoRespnse(201, $response);
});

$app->delete('/staff/:id', function ($id) {
    $db = new DbHandler();
    $res = $db->deleteStaffById($id);
    if ($res['error'] === false) {
        $response['error'] = false;
        $response['message'] = $res['message'];
    } else {
        $response = array('error' => true, 'message' => $res['message']);
    }
    echoRespnse(201, $response);
});

$app->get('/category', function () {
    $db = new DbHandler();
    $res = $db->getAllCategory();
    if ($res['error'] === false) {
        $response['error'] = false;
        $response['data'] = $res['data'];
        $response['message'] = $res['message'];
    } else {
        $response = array('error' => true, 'message' => $res['message']);
    }
    echoRespnse(201, $response);
});

$app->post('/category', function () use ($app) {
    verifyRequiredParams(array('name'));
    $db = new DbHandler();
    $data = array('name' => $app->request->post('name'));
    $res = $db->addCategory($data);
    if ($res['error'] === false) {
        $response['error'] = false;
        $response['message'] = 'Category added successfully';
    } else {
        $response = array('error' => true, 'message' => $res['message']);
    }
    echoRespnse(201, $response);
});

$app->put('/category', function () use ($app) {
    verifyRequiredParams(array('update_name'));
    $db = new DbHandler();
    $data = array('ID' => $app->request->put('update_category_id'), 'name' => $app->request->put('update_name'));
    $res = $db->updateCategory($data);
    if ($res['error'] === false) {
        $response['error'] = false;
        $response['message'] = 'Category updated successfully';
    } else {
        $response = array('error' => true, 'message' => $res['message']);
    }
    echoRespnse(201, $response);
});

$app->get('/category/:id', function ($id) {
    $db = new DbHandler();
    $res = $db->getCategoryById($id);
    if ($res['error'] === false) {
        $response['error'] = false;
        $response['message'] = $res['message'];
        $response['data'] = $res['data'];
    } else {
        $response = array('error' => true, 'message' => $res['message']);
    }
    echoRespnse(201, $response);
});

$app->delete('/category/:id', function ($id) {
    $db = new DbHandler();
    $res = $db->deleteCategoryById($id);
    if ($res['error'] === false) {
        $response['error'] = false;
        $response['message'] = $res['message'];
    } else {
        $response = array('error' => true, 'message' => $res['message']);
    }
    echoRespnse(201, $response);
});