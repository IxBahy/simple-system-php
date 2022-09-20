<?php
include '../shared/head.php';
include '../shared/navBar.php';
include '../functions/queries.php';

if (isset($_GET['show'])) {
    $id = $_GET['show'];
    $row = searchById('admins', $id);
}

?>

<h1 class="text-center">Your Profile</h1>


<div class="container col-3">
    <div class="card bg-secondary mb-5 ">
        <img src="/backend-training/5th-task/admins/uplodes/<?= $row['imageName'] ?>" style="height:400px;" alt="">
        <div class="card-body">
            <h1> Name : <?= $row['name'] ?> </h1>
            <h1> Role : <?= selectNameById('roles', $row['roleId']) ?> </h1>
        </div>
    </div>
</div>
<?php
include '../shared/footer.php';
?>