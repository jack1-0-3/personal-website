<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
<?php include './nav.php'; ?>
<main>
    <section>
        <form action="loginScript.php" method="post">
            <fieldset>
                <legend>Enter your details</legend>
                <?php if (!empty($error_message)): ?>
                    <p class="error-message"><?php echo $error_message; ?></p>
                <?php endif; ?>
                <div class="textboxcontainer">
                    <p class="form__field">
                        <label for="email">Email</label>
                        <input type="email" name="email" placeholder="joebloggs@gmail.com" id="email" required>
                    </p>
                    <p class="form__field">
                        <label for="password">Password</label>
                        <input type="password" name="password" placeholder="**********" id="password" required>
                    </p>
                </div>
                <div class="buttoncontainer">
                    <input type="submit" value="Log In" id="loginbutton" class="button">
                    <a href="../php/create_account.php" class="button">Create Account</a>
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