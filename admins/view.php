<?php
include '../shared/head.php';
include '../functions/queries.php';
include '../shared/navBar.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $row = searchById('admins', $id);
    $image = $row['imageName'];
    unlink($image);
    deleteById('admins', $id);
    header("location: /backend-training/5th-task/admins/view.php");
}
?>
<div class="container mt-5">
    <table class="table table-secondary table-striped  mt-5">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">role</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (selectAll('admins') as $admin) { ?>
                <tr>
                    <th scope="row"><?= $admin['id'] ?></th>
                    <td><?= $admin['name'] ?></td>
                    <td><?= selectNameById('roles', $admin['roleId']) ?></td>
                    <td>
                        <div class="dropdown">
                            <i type="button" data-bs-toggle="dropdown" aria-expanded="false" class="fa-solid btn btn-light fa-ellipsis-vertical "></i>
                            <div class="dropdown-menu" style="min-width:50px ;">
                                <a class="dropdown-item text-primary" href="/backend-training/5th-task/admins/profile.php?show=<?= $admin['id'] ?>"><i class="fa-solid fa-user"></i></i></a>
                                <a class="dropdown-item text-danger" href="/backend-training/5th-task/admins/view.php?delete=<?= $admin['id'] ?>"><i class="fa-solid fa-trash-can"></i></a>
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