<?php
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers:*');
$conn = new mysqli("localhost", "id19168690_api", "Y~^+_xhvaHV26+=J", "id19168690_uas");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = array('error' => false);
$action = '';


if (isset($_GET['action'])) {
    $action = $_GET['action'];
}
// read employees
if ($action == 'read') {
    $sql = $conn->query("SELECT * FROM employees");
    $users = array();
    while ($row = $sql->fetch_assoc()) {
        array_push($users, $row);
    }
    $result['users'] = $users;
}
// read jobs
if ($action == 'jobs') {
    $sql = $conn->query("SELECT * FROM jobs");
    $users = array();
    while ($row = $sql->fetch_assoc()) {
        array_push($users, $row);
    }
    $result['users'] = $users;
}
// read dep
if ($action == 'dep') {
    $sql = $conn->query("SELECT * FROM departments");
    $users = array();
    while ($row = $sql->fetch_assoc()) {
        array_push($users, $row);
    }
    $result['users'] = $users;
}
if ($action == 'create') {
    $EMPLOYEE_ID = $_POST['employee_id'];
    $FIRST_NAME = $_POST['first_name'];
    $LAST_NAME = $_POST['last_name'];
    $EMAIL = $_POST['email'];
    $PHONE_NUMBER = $_POST['phone_number'];
    $JOB_ID = $_POST['job_id'];
    $SALARY = $_POST['salary'];
    $DEPARTMENT_ID = $_POST['department_id'];


    $sql = "INSERT INTO `employees`(`employee_id`, `first_name`, `last_name`, `email`, `phone_number`, `job_id`, `salary`,  `department_id`) VALUES ('$EMPLOYEE_ID','$FIRST_NAME', '$LAST_NAME','$EMAIL','$PHONE_NUMBER','$JOB_ID','$SALARY','$DEPARTMENT_ID')";
    $query = $conn->query($sql);

    if ($query) {
        $result['message'] = "Member Added Successfully";
    } else {
        $result['error'] = true;
        $result['message'] = "Could not add Member";
    }
}

if ($action == 'update') {

    $EMPLOYEE_ID = $_POST['employee_id'];
    $FIRST_NAME = $_POST['first_name'];
    $LAST_NAME = $_POST['last_name'];
    $EMAIL = $_POST['email'];
    $PHONE_NUMBER = $_POST['phone_number'];
    $JOB_ID = $_POST['job_id'];
    $SALARY = $_POST['salary'];
    $DEPARTMENT_ID = $_POST['department_id'];

    $sql = "UPDATE `employees` SET `first_name`='$FIRST_NAME',`last_name`='$LAST_NAME',`email`='$EMAIL',`phone_number`='$PHONE_NUMBER',`job_id`='$JOB_ID',`salary`='$SALARY',`department_id`='$DEPARTMENT_ID' WHERE `employee_id`='$EMPLOYEE_ID'";
    $query = $conn->query($sql);

    if ($query) {
        $result['message'] = "Member Updated Successfully";
    } else {
        $result['error'] = true;
        $result['message'] = "Could not update Member";
    }
}

if ($action == 'delete') {

    $EMPLOYEE_ID = $_POST['employee_id'];

    $sql = "DELETE FROM `employees` WHERE employee_id =  '$EMPLOYEE_ID'";
    $query = $conn->query($sql);

    if ($query) {
        $result['message'] = "Member Deleted Successfully";
    } else {
        $result['error'] = true;
        $result['message'] = "Could not delete Member";
    }
}


$conn->close();

header("Content-type: application/json");
echo json_encode($result);
die();
