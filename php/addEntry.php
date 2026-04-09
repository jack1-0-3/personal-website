<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../php/loginPage.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="../css/blog.css">
    <script src="../javascript/addEntry.js" defer></script>
</head>

<body>
    <?php include './nav.php'; ?>

    <main>
        <section>
            <form method="POST" action="./viewBlog.php">
                <fieldset>
                    <legend>Add blog</legend>
                    <div class="textboxcontainer">
                        <p>
                            <input type="text" name="title" placeholder="Title" id="title">
                        </p>
                        <p>
                            <textarea name="blogpost" placeholder="Enter your text here" id="blogpost"></textarea>
                        </p>
                    </div>
                    <div class="buttoncontainer">
                        <input type="submit" value="Post" id="submitbutton" class="button">
                        <input type="reset" value="Clear" id="clearbutton" class="button">
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