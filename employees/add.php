<?php
include '../shared/head.php';
include '../shared/navBar.php';
include '../functions/queries.php';


if (isset($_POST["addEmp"])) {
    $name = $_POST["empName"];
    $phone = $_POST["empPhone"];
    $salary = $_POST["empSalary"];
    $deptId = $_POST["deptId"];
    $query = <<<term
    ( null , ' $name ' , $phone , $salary , $deptId)
    term;
    addQuery('employees', $query);
}
?>
<div class="container">
    <div class="row">
        <div class="card bg-secondary text-white col-6 mx-auto mt-5">
            <div class="card-body">
                <h2>Employees</h2>
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="exampleInputname1" class="form-label">Name</label>
                        <input type="text" class="form-control" name="empName" id="exampleInputname1">
                    </div><!-- input name -->
                    <div class="mb-3">
                        <label for="exampleInputphone1" class="form-label">Phone</label>
                        <input type="text" class="form-control" name="empPhone" id=" exampleInputphone1">
                    </div><!-- input  phone-->
                    <div class="mb-3">
                        <label for="exampleInputsalary1" class="form-label">salary</label>
                        <input type="number" class="form-control" name="empSalary" id=" exampleInputsalary1">
                    </div><!-- input  salary-->

                    <div class="mb-3 ">
                        <select class="form-select mt-4 " style="width: 200px;" name="deptId" id="dept_id">
                            <option selected>select department</option>
                            <?php foreach (selectAll('departments') as $department) { ?>
                                <?php echo "<option value=" . $department['id'] . ">" . $department['name'] . " </option>" ?>
                            <?php } ?>
                        </select>
                    </div><!-- select  department id-->
                    <button name="addEmp" class="btn btn-primary">Add Employee</button>
                </form>
            </div><!-- card-body -->
        </div><!-- card #employees-->
    </div><!-- row -->
</div><!-- container -->

<?php
include '../shared/footer.php';
?>