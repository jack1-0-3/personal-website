<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="../css/create_account.css">
</head>

<body>
    <?php include './nav.php'; ?>
    <main>
        <section>
            <form action="../php/createAccount.php" method="post">
                <fieldset>
                    <legend>Enter your details</legend>
                    <div class="text-input">
                        <p class="form__field">
                            <label for="email">Email</label>
                            <input type="email" name="email" placeholder="joebloggs@gmail.com" id="email" required>
                        </p>
                        <p class="form__field">
                            <label for="password">Password</label>
                            <input type="password" name="password" placeholder="**********" id="password" required>
                        </p>
                        <p class="form__field">
                            <label for="confirmpassword">Confirm Password</label>
                            <input type="password" name="confirmpassword" placeholder="**********" id="confirmpassword">
                        </p>
                    </div>
                    <div class="buttoncontainer">
                        <input type="submit" value="Create Account" id="loginbutton" class="button">
                    </div>
                </fieldset>
            </form>
        </section>
    
    </main>

    <footer>
        <p>Copyright © 2025 Jack Lawrence</p>
    </footer>
</body>
</html>