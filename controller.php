<?php
require_once("model.php");
session_start();

if (!isset($_SESSION['employeelist'])) {
    $_SESSION['employeelist'] = array();
}
if (!isset($_SESSION['officelist'])) {
    $_SESSION['officelist'] = array();
}
if (!isset($_SESSION['relationlist'])) {
    $_SESSION['relationlist'] = array();
}

function e($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function createEmployee() {
    $employee = new Model_Employee();
    $employee->nama = trim($_POST['inputNama']);
    $employee->jabatan = trim($_POST['inputJabatan']);
    $employee->usia = (int)$_POST['inputUsia'];
    array_push($_SESSION['employeelist'], $employee);
}

function deleteEmployee($employeeIndex) {
    unset($_SESSION['employeelist'][$employeeIndex]);
    // relasi yang memakai employee ini ikut dihapus
    foreach ($_SESSION['relationlist'] as $relationIndex => $relation) {
        if ($relation->employeeIndex == $employeeIndex) {
            unset($_SESSION['relationlist'][$relationIndex]);
        }
    }
}

function getAllEmployee() {
    return $_SESSION['employeelist'];
}


function createOffice() {
    $office = new Model_Office();
    $office->namaKantor = trim($_POST['inputNamaKantor']);
    $office->alamat = trim($_POST['inputAlamat']);
    $office->kota = trim($_POST['inputKota']);
    $office->telepon = trim($_POST['inputTelepon']);
    array_push($_SESSION['officelist'], $office);
}

function deleteOffice($officeIndex) {
    unset($_SESSION['officelist'][$officeIndex]);
    // relasi yang memakai office ini ikut dihapus
    foreach ($_SESSION['relationlist'] as $relationIndex => $relation) {
        if ($relation->officeIndex == $officeIndex) {
            unset($_SESSION['relationlist'][$relationIndex]);
        }
    }
}

function getAllOffice() {
    return $_SESSION['officelist'];
}


function createRelation() {
    $employeeIndex = (int)$_POST['inputEmployee'];
    $officeIndex = (int)$_POST['inputOffice'];

   
    if (!isset($_SESSION['employeelist'][$employeeIndex]) ||
        !isset($_SESSION['officelist'][$officeIndex])) {
        return;
    }

   
    foreach ($_SESSION['relationlist'] as $relation) {
        if ($relation->employeeIndex == $employeeIndex &&
            $relation->officeIndex == $officeIndex) {
            return;
        }
    }

    $relation = new Model_OfficeEmployee();
    $relation->employeeIndex = $employeeIndex;
    $relation->officeIndex = $officeIndex;
    array_push($_SESSION['relationlist'], $relation);
}

function deleteRelation($relationIndex) {
    unset($_SESSION['relationlist'][$relationIndex]);
}

function getAllRelation() {
    return $_SESSION['relationlist'];
}


if (isset($_POST['button_submit'])) {
    createEmployee();
    header("Location: viewEmployee.php");
    exit;
}

if (isset($_POST['button_submit_office'])) {
    createOffice();
    header("Location: viewOffice.php");
    exit;
}

if (isset($_POST['button_submit_relation'])) {
    createRelation();
    header("Location: viewRelation.php");
    exit;
}

if (isset($_GET['deleteID'])) {
    deleteEmployee((int)$_GET['deleteID']);
    header("Location: viewEmployee.php");
    exit;
}

if (isset($_GET['deleteOfficeID'])) {
    deleteOffice((int)$_GET['deleteOfficeID']);
    header("Location: viewOffice.php");
    exit;
}

if (isset($_GET['deleteRelationID'])) {
    deleteRelation((int)$_GET['deleteRelationID']);
    header("Location: viewRelation.php");
    exit;
}
?>
