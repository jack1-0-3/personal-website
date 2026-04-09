<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="../css/homepage.css">
</head>

<body>
    <?php include './nav.php'; ?>

    <main>
        <section>
            <figure>
                <img src="../images/headshot_cropped.jpeg" alt="">
                <figcaption>
                    <hgroup>
                        <h2>Hello, I'm Jack</h2>
                        <br>
                        <p>This is my portfolio website</p>
                        <p>Click the button below to log in!</p>
                    </hgroup>
                </figcaption>
            </figure>

            <a href="../php/loginPage.php"><button>Login</button></a>
        </section>
    </main>

    <footer>
        <p>Copyright © 2025 Jack Lawrence</p>
    </footer>
</body>
</html>