<?php
include '../shared/head.php';
include '../shared/navBar.php';
include '../functions/queries.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    deleteById('departments', $id);
    header("location: /backend-training/5th-task/departments/view.php");
}

?>
<div class="container mt-5">
    <table class="table table-secondary table-striped mx-auto mt-5" style="width: 500px;">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (selectAll('departments') as $department) { ?>
                <tr>
                    <th scope="row"><?= $department['id'] ?></th>
                    <td><?= $department['name'] ?></td>
                    <td>
                        <div class="dropdown">
                            <i type="button" data-bs-toggle="dropdown" aria-expanded="false" class="fa-solid btn btn-light fa-ellipsis-vertical "></i>
                            <div class="dropdown-menu" style="min-width:50px ;">
                                <a class="dropdown-item text-primary" href="/backend-training/5th-task/departments/update.php?edit=<?= $department['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a class="dropdown-item text-danger" href="/backend-training/5th-task/departments/view.php?delete=<?= $department['id'] ?>"><i class="fa-solid fa-trash-can"></i></a>
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