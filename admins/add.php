<?php
include '../shared/head.php';
include '../shared/navBar.php';
include '../functions/queries.php';



if (isset($_POST["addAdmin"])) {
    $name = $_POST["adminName"];
    $passwd = $_POST["adminPasswd"];

    $imageName = time() . $_FILES['image']['name'];
    $tmpName = $_FILES['image']['tmp_name'];
    $path = "./uplodes/" . $imageName;
    move_uploaded_file($tmpName, $path);

    $roleId = $_POST["roleId"];

    $query = <<<term
    (null , '$name','$passwd',$roleId,'$imageName')
    term;
    addQuery('admins', $query);
}

?>



<div class="container">
    <div class="row">
        <div class="card bg-secondary text-white col-6 mx-auto mt-5">
            <div class="card-body">
                <h2>Admins</h2>
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="exampleInputname1" class="form-label">Name</label>
                        <input type="text" class="form-control" name="adminName" id="exampleInputname1">
                    </div><!-- input name -->
                    <div class="mb-3">
                        <label for="exampleInputpassword1" class="form-label">password</label>
                        <input type="password" class="form-control" name="adminPasswd" id=" exampleInputpassword1">
                    </div><!-- input  passwd-->
                    <div class="mb-3">
                        <label for="exampleInputimage1" class="form-label">profile image</label>
                        <input type="file" class="form-control" name="image" id=" exampleInputimage1">
                    </div><!-- input  image-->
                    <div class="mb-3 ">
                        <select class="form-select " style="width: 200px;" name="roleId" id="roleId">
                            <option selected>select role</option>
                            <?php foreach (selectAll('roles') as $role) { ?>
                                <?php echo "<option value=" . $role['id'] . ">" . $role['name'] . " </option>" ?>
                            <?php } ?>
                        </select>
                    </div><!-- input  role id-->
                    <button name="addAdmin" class="btn btn-primary">Add admin</button>
                </form>
            </div><!-- card-body -->
        </div><!-- card #employees-->
    </div><!-- row -->
</div><!-- container -->

<?php
include '../shared/footer.php';
?>