<?php
function auth($num1 = "", $num2 = "", $num3 = "")
{
    if ($_SESSION['admin']) {
        if (
            $_SESSION['roleId'] == $num1 || $_SESSION['roleId'] == $num2
            || $_SESSION['roleId'] == $num3

        ) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
};


session_start();
if (isset($_GET['logOut'])) {
    session_unset();
    session_destroy();
    header('location: /backend-training/5th-task/');
} ?>
<nav class="navbar navbar-expand-lg navbar-secondary bg-secondary bg-gradient">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/backend-training/5th-task/welcome.php">Home</a>
                </li>
                <li class="nav-item">
                    <?php if (auth(1, 2)) : ?>
                        <a class="nav-link active" aria-current="page" href="/backend-training/5th-task/admins/profile.php?show=<?= $_SESSION['adminId'] ?>">profile</a>
                    <?php else : ?>
                        <a class=" nav-link disabled" aria-current="page" href="#">profile</a>
                    <?php endif; ?>
                </li>
                <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                employees
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="/backend-training/5th-task/employees/view.php">View All</a></li>
                                <?php if (auth(1, 2)) : ?>
                                    <li><a class="dropdown-item" href="/backend-training/5th-task/employees/add.php">Add a new Employee</a></li>
                                <?php else : ?>
                                    <li><a class="dropdown-item disabled" href="/backend-training/5th-task/employees/add.php">Add a new Employee</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                departments
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="/backend-training/5th-task/departments/view.php">View All</a></li>
                                <?php if (auth(1, 2)) { ?>
                                    <li><a class="dropdown-item" href="/backend-training/5th-task/departments/add.php">Add a new department</a></li>
                                <?php } else { ?>
                                    <li><a class="dropdown-item disabled" href="/backend-training/5th-task/departments/add.php">Add a new department</a></li>
                                <?php }; ?>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <?php if (auth(1)) { ?>
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    admin Controls
                                </a>
                            <?php } else {  ?>
                                <a class="nav-link dropdown-toggle disabled" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    admin Controls
                                </a>
                            <?php }; ?>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="/backend-training/5th-task/admins/view.php">View All</a></li>
                                <li><a class="dropdown-item" href="/backend-training/5th-task/admins/add.php">Add a new admine</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </ul>
            <form method="GET">
                <button class="btn btn-outline-danger" name="logOut">log out</button>
            </form>
        </div>
    </div>
</nav>