<?php

    session_start();

    include './db_connect.php';

    $user_email = $_POST['email'];
    $user_password = $_POST['password'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $sql = "INSERT INTO USERS (email, password) VALUES ('$user_email', '$user_password')";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="../css/create_account.css">
</head>
<body>
<header>
    <?php include './nav.php' ?>
</header>
    <main>
        <section>
            <form>
                <fieldset>
                    <?php if ($conn->query($sql) === TRUE) {
                            $registration_successful = TRUE;
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                            $registration_successful = FALSE;
                        }
                        $conn->close();
                    ?>

                    <?php if ($registration_successful): ?>
                        <p>
                            Registration Successful
                        </p>
                        <p>
                            <a href="../php/loginScript.php">Sign in</a>
                        </p>
                    
                    <?php else: ?>
                        <p>Registration error</p>
                        <p><a href="../php/create_account.php">Retry</a></p>
                    <?php endif; ?>
                </fieldset>
            </form>
        </section>
    
    </main>

    <footer>
        <p>Copyright © 2025 Jack Lawrence</p>
    </footer>
</body>
</html>