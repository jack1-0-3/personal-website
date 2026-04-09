<header>
    <h1><a href="../php/index.php">Jack Lawrence</a></h1>
    <div id="header__spacer-1"></div>
    <nav>
        <ul>
            <li><a href="./aboutMe.php">About me</a></li>
            <li><a href="./skills.php">Skills</a></li>
            <li><a href="./education.php">Education</a></li>
            <li><a href="./experience.php">Experience</a></li>
            <li><a href="./portfolio.php">Portfolio</a></li>
            <li><a href="./contact.php">Contact</a></li>
            <li><a href="../php/addEntry.php">Blog</a></li>
        </ul>
    </nav>
    <div id="header__spacer-2"></div>
    <div id="header__logout">
        <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="../php/logoutScript.php" id="log-out-btn">Log Out</a></li>
            <?php endif; ?>
    </div>
</header>