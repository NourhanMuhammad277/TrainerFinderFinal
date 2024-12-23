<?php
include_once '../Controllers/AdminController.php';
if (isset($_GET['page'])) {
    $page = $_GET['page'];

    switch ($page) {
        case 'viewUsers':
            AdminController::viewUsers();
            break;
        case 'editUser':
            if (isset($_GET['id'])) {
                AdminController::editUser($_GET['id']);
            }
            break;
        case 'deleteUser':
            if (isset($_GET['id'])) {
                AdminController::deleteUser($_GET['id']);
            }
            break;
        default:
            AdminController::showDashboard();
            break;
    }
} else {
    AdminController::showDashboard();
}
?>
