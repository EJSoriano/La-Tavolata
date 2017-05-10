<?php

require_once('required.php');

if (isset($_SESSION['UserID'])) {
    header('Location: /index.php');
    return;
}

define('DB_HOST', 'cecs-db01.coe.csulb.edu');
define('DB_NAME', 'cecs470og2');
define('DB_USERNAME', 'cecs470m17');
define('DB_PASSWORD', 'ohbai0');

// initialize variables
$id = "";
$password = "";

$idClass = '';
$idMessage = '';
$passwordMessage = '';
$passwordClass = '';

$validLogin = false;

if (isset($_POST['id'])) {
    if ($_POST['id']) {
        $id = $_POST['id'];
        $idMessage = '';
    } else {
        $id = '';
        $idMessage = "ID is empty";
    }
}
if (isset($_POST['password'])) {
    if ($_POST['password']) {
        $password = $_POST['password'];
        $passwordMessage = '';
    } else {
        $password = '';
        $passwordMessage = "Password is empty";
    }
}

if ($id && $password) {
    // mysqli_report(MYSQLI_REPORT_ALL);
    $connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if (mysqli_connect_errno()) {
        printf("Database connection failed: %s\n", mysqli_connect_error());
        die(mysqli_connect_error());
    }
    $stmt = mysqli_stmt_init($connection);
    $query = "SELECT * FROM users WHERE username = ?";
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 's', $id);
        mysqli_stmt_execute($stmt);

        mysqli_stmt_bind_result($stmt, $sqlID, $sqlId, $sqlPassword);

        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) == 0) {
            $idMessage = "ID not found";
            // $idClass = 'input-error';
        } else {
             while (mysqli_stmt_fetch($stmt)) {
                if (($sqlId == $id) && ($sqlPassword == $password)) {
                    $validLogin = true;
                    $_SESSION['UserID'] = $sqlId;
                } else {
                    $passwordMessage = "Incorrect password";
                    // $passwordClass = 'input-error';
                }
            }
        }
        mysqli_stmt_free_result($stmt);
        mysqli_stmt_close($stmt);
    }

    mysqli_close($connection);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>La Tavolita</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="layout.css">
</head>

<body>
    <?php include 'header.php' ?>
    <main>
        <div class="loginMain">
            <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
              <div class="form-group <?php echo $idClass; ?>">
                <label for="id">ID</label>
                <input type="text" class="form-control" name="id" value="<?php echo $id; ?>">
                <p class="help-block input-error"><?php echo $idMessage; ?></p>
            </div>
            <br />
            <div class="form-group <?php echo $passwordClass; ?>">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" value="<?php echo $password; ?>">
                <p class="help-block input-error"><?php echo $passwordMessage; ?></p>
            </div>
            <br />
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</main>
</body>
</html>
