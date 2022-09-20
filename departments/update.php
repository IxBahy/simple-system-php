<?php
include '../shared/head.php';
include '../shared/navBar.php';
include '../functions/queries.php';


if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $row = searchById('departments', $id);

    if (isset($_POST["updateDept"])) {
        $deptName = $_POST["deptName"];
        $query = <<<term
        `name`='$deptName' 
        term;
        updateQuery('departments', $id, $query);
        header("location:/backend-training/5th-task/departments/view.php");
    }
}
?>
<div class="container">
    <div class="row">
        <div class="card bg-secondary text-white col-6 mx-auto mt-5">
            <div class="card-body">
                <h2>Departments</h2>
                <form method="POST">
                    <div class="mb-3">
                        <label for="exampleInputname1" class="form-label">Name</label>
                        <input type="text" class="form-control" name="deptName" value="<?= $row['name'] ?>" id="exampleInputname1">
                    </div><!-- input name -->
                    <button name="updateDept" class="btn btn-info">update Department</button>
                </form>
            </div><!-- card-body -->
        </div><!-- card #employees-->
    </div><!-- row -->
</div><!-- container -->
<?php
include '../shared/footer.php';
?>