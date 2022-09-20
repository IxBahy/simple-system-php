<?php
include '../shared/head.php';
include '../functions/queries.php';
include '../shared/navBar.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    deleteById('employees', $id);
    header("location: /backend-training/5th-task/employees/view.php");
}
?>
<div class="container mt-5">
    <table class="table table-secondary table-striped  mt-5">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Salary</th>
                <th scope="col">Department</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (selectAll('employees') as $employee) { ?>
                <tr>
                    <th scope="row"><?= $employee['id'] ?></th>
                    <td><?= $employee['name'] ?></td>
                    <td><?= $employee['phone'] ?></td>
                    <td><?= $employee['salary'] ?></td>
                    <td><?= selectNameById('departments', $employee['deptId']) ?></td>
                    <td>
                        <div class="dropdown">
                            <i type="button" data-bs-toggle="dropdown" aria-expanded="false" class="fa-solid btn btn-light fa-ellipsis-vertical "></i>
                            <div class="dropdown-menu" style="min-width:50px ;">
                                <a class="dropdown-item text-primary" href="/backend-training/5th-task/employees/update.php?edit=<?= $employee['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a class="dropdown-item text-danger" href="/backend-training/5th-task/employees/view.php?delete=<?= $employee['id'] ?>"><i class="fa-solid fa-trash-can"></i></a>
                            </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php
include '../shared/footer.php';
?>