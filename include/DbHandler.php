<?php
session_start();
class DbHandler {

    private $conn;

    function __construct() {
        require_once dirname(__FILE__) . '/DbConnect.php';
// opening db connection
        $db = new DbConnect();
        $this->conn = $db->connect();
    }

    public function loginAdmin($data) {
        $res = array('error' => true, 'message' => 'No user found!!');
        $result = $this->conn->query('SELECT ID, status, name FROM `staffs` WHERE `email` = \'' . $data['email'] . '\' AND password = \'' . $data['password'] . '\'');
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            if ($data['status'] == 1) {
                $_SESSION['name'] = $data['name'];
                $_SESSION['session'] = $data['ID'];
                $res = array('error' => false, 'message' => 'Login success', 'data' => array('ID' => $data['ID'], 'name' => $data['name']));
            } else {
                $res = array('error' => true, 'message' => 'Your account is inactive! Please contact admin!!');
            }
        }
        return $res;
    }

    public function getAllStores($status, $staff) {
        $res = array('error' => true, 'message' => 'No store found');
        $data = [];
        $staff_query = '';
        $status_query = '';
        if ($status != 'null') {
            $status_query = ' AND `s`.`is_contacted` = ' . $status;
        }
        if ($staff != 'null') {
            $staff_query = ' AND `s`.`staff_id` = ' . $staff;
        }
        $result = $this->conn->query('SELECT `s`.`ID`, `s`.`store_identity`, `s`.`email_address`, `s`.`phone_number`, `s`.`store_link`, `st`.`name` AS staff, `s`.`comment`, `s`.`is_contacted`, `s`.`created_at`, `s`.`updated_at`  FROM `stores` AS `s` LEFT JOIN `staffs` AS st ON `st`.`ID` = `s`.`staff_id` WHERE `s`.`ID` > 0 ' . $status_query . $staff_query . ' ORDER BY `s`.`ID` DESC');
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $res = array('error' => false, 'message' => 'Stores found', 'data' => $data);
        }
        return $res;
    }

    public function updateStore($data) {
        $res = array('error' => true, 'message' => 'No update found');
        $this->conn->query('UPDATE `stores` SET `comment` = \'' . $this->conn->real_escape_string($data['comment']) . '\', `is_contacted` = \'' . $data['is_contacted'] . '\', `email_address` = \'' . $data['email_address'] . '\', `phone_number` = \'' . $data['phone_number'] . '\', `staff_id` = \'' . $data['staff_id'] . '\', `updated_at` = \'' . date('Y-m-d H:i:s') . '\' WHERE `ID` = ' . $data['ID']);
        if ($this->conn->affected_rows > 0) {
            $res = array('error' => false, 'message' => 'Store updated successfully');
        }
        return $res;
    }

    public function getStoreById($id) {
        $res = array('error' => true, 'message' => 'Unable to get store');
        $result = $this->conn->query('SELECT * FROM `stores` WHERE `ID` = ' . $id);
        if ($result->num_rows > 0) {
            $res = array('error' => false, 'message' => 'Store fetched successfully', 'data' => $result->fetch_assoc());
        }
        return $res;
    }

    public function getAllKeyword() {
        $res = array('error' => true, 'message' => 'No keyword found');
        $data = [];
        $result = $this->conn->query('SELECT `ID`, `keyword`, `is_refresh` FROM `keywords` ORDER BY `ID` DESC');
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $res = array('error' => false, 'message' => 'Keyword found', 'data' => $data);
        }
        return $res;
    }

    public function addKeyword($data) {
        date_default_timezone_set('Asia/Kolkata');
        $res = array('error' => true, 'message' => 'Unable to insert keyword');
        $this->conn->query('INSERT INTO `keywords` (`keyword`, `is_refresh`, `created_at`, `updated_at`) VALUES (\'' . $data['keyword'] . '\', \'' . $data['is_refresh'] . '\', \'' . date('Y-m-d H:i:s') . '\', \'' . date('Y-m-d H:i:s') . '\')');
        if ($this->conn->affected_rows > 0) {
            $res = array('error' => false, 'message' => 'Keyword added successfully');
        }
        return $res;
    }

    public function updateKeyword($data) {
        $res = array('error' => true, 'message' => 'No update found');
        $this->conn->query('UPDATE `keywords` SET `keyword` = \'' . $data['keyword'] . '\', `is_refresh` = \'' . $data['is_refresh'] . '\', `updated_at` = \'' . date('Y-m-d H:i:s') . '\' WHERE `ID` = ' . $data['ID']);
        if ($this->conn->affected_rows > 0) {
            $res = array('error' => false, 'message' => 'Keyword updated successfully');
        }
        return $res;
    }

    public function getKeywordById($id) {
        $res = array('error' => true, 'message' => 'Unable to get keyword');
        $result = $this->conn->query('SELECT * FROM `keywords` WHERE `ID` = ' . $id);
        if ($result->num_rows > 0) {
            $res = array('error' => false, 'message' => 'Keyword fetched successfully', 'data' => $result->fetch_assoc());
        }
        return $res;
    }

    public function deleteKeywordById($id) {
        $res = array('error' => true, 'message' => 'Unable to delete keyword');
        $this->conn->query('DELETE FROM `keywords` WHERE `ID` = ' . $id);
        if ($this->conn->affected_rows > 0) {
            $res = array('error' => false, 'message' => 'Keyword deleted successfully');
        }
        return $res;
    }

    public function getAllStaff() {
        $res = array('error' => true, 'message' => 'No staff found');
        $data = [];
        $result = $this->conn->query('SELECT `ID`, `name` FROM `staffs` ORDER BY `ID` DESC');
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $res = array('error' => false, 'message' => 'Staff found', 'data' => $data);
        }
        return $res;
    }

    public function addStaff($data) {
        date_default_timezone_set('Asia/Kolkata');
        $res = array('error' => true, 'message' => 'Unable to insert keyword');
        $this->conn->query('INSERT INTO `staffs` (`name`, `created_at`, `updated_at`) VALUES (\'' . $data['name'] . '\', \'' . date('Y-m-d H:i:s') . '\', \'' . date('Y-m-d H:i:s') . '\')');
        if ($this->conn->affected_rows > 0) {
            $res = array('error' => false, 'message' => 'Staff added successfully');
        }
        return $res;
    }

    public function updateStaff($data) {
        $res = array('error' => true, 'message' => 'No update found');
        $this->conn->query('UPDATE `staffs` SET `name` = \'' . $data['name'] . '\', `updated_at` = \'' . date('Y-m-d H:i:s') . '\' WHERE `ID` = ' . $data['ID']);
        if ($this->conn->affected_rows > 0) {
            $res = array('error' => false, 'message' => 'Staff updated successfully');
        }
        return $res;
    }

    public function getStaffById($id) {
        $res = array('error' => true, 'message' => 'Unable to get staff');
        $result = $this->conn->query('SELECT name, ID FROM `staffs` WHERE `ID` = ' . $id);
        if ($result->num_rows > 0) {
            $res = array('error' => false, 'message' => 'Staff fetched successfully', 'data' => $result->fetch_assoc());
        }
        return $res;
    }

    public function deleteStaffById($id) {
        $res = array('error' => true, 'message' => 'Unable to delete staff');
        $this->conn->query('DELETE FROM `staffs` WHERE `ID` = ' . $id);
        if ($this->conn->affected_rows > 0) {
            $res = array('error' => false, 'message' => 'Staff deleted successfully');
        }
        return $res;
    }
}
