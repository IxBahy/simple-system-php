<?php
//variables
$host = 'localhost';
$user = 'root';
$password = '';
$dbName = 'ocd_second_task';
$showEmpUpdateButtons = false;
$showDeptUpdateButtons = false;
$name = "";
$deptName = "";
$passwd = "";
$dept = "";
$empID = "";
$deptID = "";
$connection = mysqli_connect($host, $user, $password, $dbName);
//form buttons

//employees
if (isset($_POST["submitEmp"])) {
    $name = $_POST["empName"];
    $passwd = $_POST["passwd"];
    $dept = $_POST["dept_id"];
    empAdd($name, $passwd, $dept);
}

//departments
if (isset($_POST["submitDept"])) {
    $deptName = $_POST["deptName"];
    deptAdd($deptName);
}

//navBar buttons
if (isset($_POST["searchBtn"])) {
    $name = $_POST["search"];
    $row = searchByName($name);
    testMessage(true, implode(", ", $row));
}



//table buttons

//employees
if (isset($_GET["deleteEmpID"])) {
    $empID = $_GET["deleteEmpID"];
    empDelete($empID);
    header("location:  index.php?#table ");
}

if (isset($_GET['editEmpID'])) {
    $showEmpUpdateButtons = true;
    $empID = $_GET["editEmpID"];
    $row = empSelect($empID);
    $name = $row['name'];
    $passwd = $row['passwd'];
    $dept = $row['dept_id'];
    //update button after pressing the edit button
    //only work if you put it inside the edit button if condition ._.
    if (isset($_POST["updateEmp"])) {
        $name = $_POST["name"];
        $passwd = $_POST["passwd"];
        $dept = $_POST["dept_id"];
        empUpdate($empID, $name, $passwd, $dept);
        header("location:  index.php?#table ");
    }
}
//departments

if (isset($_GET["editDeptID"])) {
    $showDeptUpdateButtons = true;
    $deptID = $_GET["editDeptID"];
    $deptName = deptName($deptID);
    //update button after pressing the edit button
    //only work if you put it inside the edit button if condition ._.
    if (isset($_POST["updateDept"])) {
        $deptName = $_POST["deptName"];
        deptUpdate($deptID, $deptName);
        header("location:  index.php?#table ");
    }
}

if (isset($_GET["deleteDeptID"])) {
    $empID = $_GET["deleteDeptID"];
    deptDelete($empID);
    header("location:  index.php?#table ");
}

//functions

//general use

function loginCheck($userName, $password)
{
    $check = false;
    $select = "SELECT passwd FROM `admins` WHERE `userName`='$userName' AND `passwd`='$password'";
    $admin = mysqli_query($GLOBALS['connection'], $select);
    $count = mysqli_num_rows($admin);
    if ($count == 1) {
        $check = true;
    }
    return $check;
}

function connectionToDatabase($query, $message)
{
    $preformedQuery = mysqli_query($GLOBALS['connection'], $query);
    testMessage($preformedQuery, $message);
}

function testMessage($conditions, $message)
{
    if ($conditions) {
        echo "<div class='alert alert-Success col-4 mx-auto'>
            $message 
        </div>";
    } else {
        echo "<div class='alert alert-Danger col-4 mx-auto'>
            $message Failed 
        </div>";
    }
}

//employee form and DataBase queries
function searchByName($name)
{
    $search = "SELECT * FROM `employees` WHERE `name` = '%`$name`%'";
    $oneEmployee = mysqli_query($GLOBALS['connection'], $search);
    $row = mysqli_fetch_assoc($oneEmployee);
    return $row;
}
function empAdd($name, $passwd, $dept)
{
    $insert = "INSERT INTO employees VALUES (null,'$name','$passwd',$dept)";
    connectionToDatabase($insert, 'Insert to DataBase');
}


function empUpdate($id, $name, $passwd, $dept)
{
    $update = "UPDATE employees SET `name` = '$name', passwd = '$passwd', dept_id=$dept WHERE id=$id";
    connectionToDatabase($update, 'update row in DataBase');
}

function empDelete($empID)
{
    $delete = "DELETE FROM employees where id = $empID ";
    connectionToDatabase($delete, 'delete row in DataBase');
}
function empSelect($empID)
{
    $select = "SELECT * FROM employees where id =$empID";
    $oneEmployee = mysqli_query($GLOBALS['connection'], $select);
    $row = mysqli_fetch_assoc($oneEmployee);
    return $row;
}
function selectAllEmployees()
{
    $select = "SELECT * FROM `employees`";
    $employees = mysqli_query($GLOBALS['connection'], $select);
    return $employees;
}

//department form and DataBase queries

function deptName($empID)
{
    $select = "SELECT `name` FROM departments WHERE id =$empID";
    $row = mysqli_fetch_assoc(mysqli_query($GLOBALS['connection'], $select));
    return $row['name'];
}
function deptDelete($empID)
{
    $delete = "DELETE FROM departments where id = $empID ";
    connectionToDatabase($delete, ' Department deleted row in DataBase');
}

function deptAdd($deptName)
{
    $insert = "INSERT INTO departments VALUES (null,'$deptName')";
    connectionToDatabase($insert, 'Insert Department to DataBase');
}

function deptUpdate($deptID, $deptName)
{
    $update = "UPDATE departments SET `name` = '$deptName' WHERE id =$deptID";
    connectionToDatabase($update, 'update  Department in DataBase');
}
function selectAllDeptID()
{
    $select = "SELECT id FROM `departments`";
    $departments = mysqli_query($GLOBALS['connection'], $select);
    return $departments;
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="bg-dark text-white">
    <nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <form class="d-flex " method="POST">
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" name="searchBtn" type="submit">Search by name</button>
            </form>
        </div>
        </div>
    </nav>
    <div class="container ">
        <div class="row">
            <div class="card bg-secondary text-white col-6 ">
                <div class="card-body">
                    <h2>Employees</h2>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="exampleInputname1" class="form-label">Name</label>
                            <input type="text" class="form-control" name="empName" value="<?= $name ?>" id="exampleInputname1">
                        </div><!-- input name -->
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" name="passwd" value="<?= $passwd ?>" id=" exampleInputPassword1">
                        </div><!-- input  passwd-->
                        <div class="mb-3">
                            <label for="dept_id">department ID :</label>
                            <select name="dept_id" id="dept_id">
                                <?php foreach (selectAllDeptID() as $department) { ?>
                                    <?php echo "<option value=" . $department['id'] . ">" . $department['id'] . " </option>" ?>
                                <?php } ?>
                            </select>
                        </div><!-- input  department id-->
                        <?php if ($showEmpUpdateButtons) : ?>
                            <button name="updateEmp" class="btn btn-info"> Update Data </button>
                        <?php else : ?>
                            <button name="submitEmp" class="btn btn-primary">Insert Employee</button>
                        <?php endif; ?>
                    </form>
                </div><!-- card-body -->
            </div><!-- card #employees-->

            <div class="card bg-secondary text-white col-4 offset-2">
                <div class="card-body">
                    <h2>Department</h2>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="exampleInputname1" class="form-label">Department Name</label>
                            <input type="text" class="form-control" name="deptName" value="<?= $deptName ?>" id="exampleInputname1">
                        </div><!-- input name -->
                        <div class="mb-3">

                            <?php if ($showDeptUpdateButtons) : ?>
                                <button name="updateDept" class="btn btn-info"> Update Data </button>
                            <?php else : ?>
                                <button name="submitDept" class="btn btn-primary">Insert Department</button>
                            <?php endif; ?>
                    </form><!-- form -->
                </div><!-- card-body -->
            </div><!-- card #departments -->
        </div><!-- row -->
    </div><!-- container =>form -->

    <div class="container">
        <table id="table" class="table text-white">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Password</th>
                    <th scope="col">Department</th>
                    <th scope="col" colspan="4">Actions</th>
                </tr>
            </thead><!-- head -->
            <tbody>
                <?php foreach (selectAllEmployees() as $employee) { ?>
                    <tr>
                        <th scope="row"><?= $employee['id'] ?></th>
                        <td><?= $employee['name'] ?></td>
                        <td><?= $employee['passwd'] ?></td>
                        <td><?= deptName($employee['dept_id']) ?></td>
                        <td>
                            <a class="btn btn-primary ml-3" href="index.php?editEmpID=<?= $employee['id'] ?>"> Edit Employee </a>
                            <a href="index.php?deleteEmpID=<?= $employee['id'] ?>" class="btn btn-danger"> Remove Employee </a>
                            <a class="btn btn-primary ml-3" href="index.php?editDeptID=<?= $employee['dept_id'] ?>"> Edit Department </a>
                            <a href="index.php?deleteDeptID=<?= $employee['dept_id'] ?>" class="btn btn-danger"> Remove Department</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody><!-- body -->
        </table>
    </div><!-- container => table -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
</body><!-- body -->

</html>