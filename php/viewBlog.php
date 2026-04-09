<?php
    session_start();
    
    include './db_connect.php';

    $admin_email = "jack.lawrence103@gmail.com";

    // Inserts data from addEntry into SQL database
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $entry = $_POST['blogpost'];
        $stmt = $conn->prepare("INSERT INTO blog_posts (title, content) VALUES (?, ?)");
        $stmt->bind_param("ss", $title, $entry);
        $stmt->execute();
        $stmt->close();
    }

    // Search for blog posts in SQL database (no ordering)
    $sql = "SELECT * FROM blog_posts";
    $result = $conn->query($sql);

    $blogs = [];
    while ($row = $result->fetch_assoc()) {
        $blogs[] = $row;
    }

    // Fetch all replies grouped by blog_post_id
    $replies = [];
    $replyResult = $conn->query("SELECT * FROM replies ORDER BY posted_at ASC");
    while ($reply = $replyResult->fetch_assoc()) {
        $replies[$reply['blog_post_id']][] = $reply;
    }

    // Sort blogs by posted_at descending (most recent first)
    usort($blogs, function($a, $b) {
        return strtotime($b['posted_at']) - strtotime($a['posted_at']);
    });

    // Redirect to homepage if no blogs posted
    if (count($blogs) === 0) {
        header("Location: index.php");
        exit();
    }

    // Extract unique months from blog posts
    $months = [];
    foreach ($blogs as $row) {
        $timestamp = strtotime($row['posted_at']);
        $monthValue = date('Y-m', $timestamp); // e.g., "2025-08"
        $monthLabel = date('F Y', $timestamp); // e.g., "August 2025"
        $months[$monthValue] = $monthLabel;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="../css/viewBlog.css">
    <script src="../javascript/viewBlog.js" defer></script>
</head>

<body>
    <?php include './nav.php'; ?>

    <main>
        <form method="GET" id="month-filter-form">
            <label for="month-filter">Filter by month:</label>
            <select name="month" id="month-filter" onchange="document.getElementById('month-filter-form').submit();">
                <option value="">All months</option>
                <?php foreach ($months as $value => $label): ?>
                    <option value="<?php echo htmlspecialchars($value); ?>" <?php if (isset($_GET['month']) && $_GET['month'] === $value) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($label); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>

        <?php

        // Filters blogs by month according to dropdown selection
        if (isset($_GET['month']) && $_GET['month'] !== '') {
            $selectedMonth = $_GET['month'];
            $blogs = array_filter($blogs, function($row) use ($selectedMonth) {
                return strpos($row['posted_at'], $selectedMonth) === 0;
            });
        }

        // Display blogs if there are search results
        foreach ($blogs as $row) {
            echo "<section class='page__blogpost' data-blog-id='{$row['id']}'>";

                $timestamp = strtotime($row['posted_at']);
                $date = date('j F Y', $timestamp);
                $time = date('H:i', $timestamp);
            
                // Blog post delete button (admin only)
                $isAdmin = (isset($_SESSION['email']) && $_SESSION['email'] === $admin_email);
                if ($isAdmin) {
                    echo "<button class='delete-blog-btn' data-blog-id='{$row['id']}'>Delete</button>";
                }
            
                echo "<time>" . $date . " @ " . $time . "</time>";
                echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
                echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";

                // Replies
                if (isset($replies[$row['id']])) {
                    foreach ($replies[$row['id']] as $reply) {
                        $isAdmin = (isset($_SESSION['email']) && $_SESSION['email'] === $admin_email);
                        echo "<div class='reply-box'>";
                        echo "<div class='reply-header'>";
                        echo "<span class='reply-email'>" . htmlspecialchars($reply['email']) . "</span>";
                        if ($isAdmin) {
                            echo "<button class='delete-reply-btn' data-reply-id='{$reply['id']}'>Delete</button>";
                        }
                        echo "</div>";
                        echo "<div class='reply-content'>" . nl2br(htmlspecialchars($reply['content'])) . "</div>";
                        echo "</div>";
                    }
                }

            echo "<div class='reply-area'>";
            echo "<button class='reply-btn'>Reply</button>";
            echo "</div>";

            echo "</section>";
            echo "<hr>";
        }

        $conn->close();
        ?>
    </main>

    <footer>
        <p>Copyright © 2025 Jack Lawrence</p>
    </footer>
</body>
</html>