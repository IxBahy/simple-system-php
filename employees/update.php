<?php
include '../shared/head.php';
include '../shared/navBar.php';
include '../functions/queries.php';
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $row = searchById('employees', $id);
    if (isset($_POST["updateEmp"])) {
        $empName = $_POST["empName"];
        $empPhone = $_POST["empPhone"];
        $empSalary = $_POST["empSalary"];
        $deptId = $_POST["deptId"];
        $query = <<<term
        `name`='$empName' , phone ='$empPhone' , salary ='$empSalary' , deptId =$deptId 
        term;
        echo $query;
        updateQuery('employees', $id, $query);
        header("location:/backend-training/5th-task/departments/view.php");
    }
}
?>
<div class="container">
    <div class="row">
        <div class="card bg-secondary text-white col-6 mx-auto mt-5">
            <div class="card-body">
                <h2>Employees</h2>
                <form method="POST">
                    <div class="mb-3">
                        <label for="exampleInputname1" class="form-label">Name</label>
                        <input type="text" class="form-control" name="empName" value="<?= $row['name'] ?>" id="exampleInputname1">
                    </div><!-- input name -->
                    <div class="mb-3">
                        <label for="exampleInputphone1" class="form-label">Phone</label>
                        <input type="text" class="form-control" name="empPhone" value="<?= $row['phone'] ?>" id=" exampleInputphone1">
                    </div><!-- input  phone-->
                    <div class="mb-3">
                        <label for="exampleInputsalary1" class="form-label">salary</label>
                        <input type="number" class="form-control" name="empSalary" value="<?= $row['salary'] ?>" id=" exampleInputsalary1">
                    </div><!-- input  salary-->

                    <div class="mb-3 ">
                        <select class="form-select mt-4 " style="width: 200px;" name="deptId" id="dept_id">
                            <option selected>select department</option>
                            <?php foreach (selectAll('departments') as $department) { ?>
                                <?php echo "<option value=" . $department['id'] . ">" . $department['name'] . " </option>" ?>
                            <?php } ?>
                        </select>
                    </div><!-- select  department id-->
                    <button name="updateEmp" class="btn btn-info">update Employee</button>
                </form>
            </div><!-- card-body -->
        </div><!-- card #employees-->
    </div><!-- row -->
</div><!-- container -->

<?php
include '../shared/footer.php';
?>