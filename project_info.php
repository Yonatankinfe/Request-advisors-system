<?php
include 'php_connection.php'; // Ensure the path to php_connection.php is correct

if (isset($_GET['requestId'])) {
    $requestId = $_GET['requestId'];

    // Fetch the projectId from the request table
    $sql = "SELECT projectId FROM request WHERE requestId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $requestId);
    $stmt->execute();
    $stmt->bind_result($projectId);
    $stmt->fetch();
    $stmt->close();

    if ($projectId) {
        // Fetch the project details from the project table
        $sql = "SELECT title, description, category, startDate, endDate, fundingGoals, currentFunds, status FROM project WHERE projectId = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $projectId);
        $stmt->execute();
        $stmt->bind_result($title, $description, $category, $startDate, $endDate, $fundingGoals, $currentFunds, $status);
        $stmt->fetch();
        $stmt->close();
    } else {
        echo "Project ID not found for the given request ID.";
    }
} else {
    echo "Request ID not provided.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Information</title>
    <link rel="stylesheet" href="style.css"> <!-- Ensure the path to styles.css is correct -->
</head>
<body>
    <div class="container">
        <?php if (isset($title)): ?>
            <h1>Project Title: <?php echo htmlspecialchars($title); ?></h1>
            <p><strong>Description:</strong> <?php echo htmlspecialchars($description); ?></p>
            <p><strong>Category:</strong> <?php echo htmlspecialchars($category); ?></p>
            <p><strong>Start Date:</strong> <?php echo htmlspecialchars($startDate); ?></p>
            <p><strong>End Date:</strong> <?php echo htmlspecialchars($endDate); ?></p>
            <p><strong>Funding Goals:</strong> <?php echo htmlspecialchars($fundingGoals); ?></p>
            <p><strong>Current Funds:</strong> <?php echo htmlspecialchars($currentFunds); ?></p>
            <p><strong>Status:</strong> <?php echo htmlspecialchars($status); ?></p>
        <?php else: ?>
            <p>Project not found.</p>
        <?php endif; ?>
    </div>
    <div class="chat-button">
        <button class="bottom-button"onclick="redirectToChat()">Chat With The Entrepreneur</button>
     </div>
     <script src="scripte.js"></script>
</body>
</html>
