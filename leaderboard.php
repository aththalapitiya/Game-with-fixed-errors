<?php
session_start();  //--> Ensure the session is started


if (!isset($_SESSION["username"])) {   //--> checking if the user is logged or not
    header("Location: signin.php");  //--> Redirect to sign-in page
    exit();
}

include "../includes/db.php";   //--> database connection here

$username = $_SESSION["username"];


$sql = "SELECT username, score FROM users ORDER BY score DESC LIMIT 10"; //--> fetching the top 10 players here
$result = $conn->query($sql);

$leaderboard = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $leaderboard[] = $row;
    }
}


$user_rank = "N/A";   //-- finding the logged in user' rank and score
$user_score = "N/A";

$sql_user = "SELECT username, score FROM users ORDER BY score DESC";
$result_user = $conn->query($sql_user);

$rank = 1;
while ($row = $result_user->fetch_assoc()) {
    if ($row["username"] === $username) {
        $user_rank = $rank;
        $user_score = $row["score"];
        break;
    }
    $rank++;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <link rel="stylesheet" href="../assets/css/styles.css">

</head>
<body>
    <div class="background">
        <img src="../assets/images/leaderboard.png" class="leaderboard-title" alt="Leaderboard">
        
        <!-- Leaderboard Table -->
        <div class="leaderboard-container">
            <table>
                <tr>
                    <th>RANK</th>
                    <th>NAME</th>
                    <th>SCORE</th>
                </tr>
                <?php
                $rank = 1;
                foreach ($leaderboard as $row) {
                    echo "<tr>
                            <td>" . $rank . "</td>
                            <td>" . htmlspecialchars($row["username"]) . "</td>
                            <td>" . $row["score"] . "</td>
                          </tr>";
                    $rank++;
                }
                ?>
            </table>
        </div>

        <div class="score-board">
            <!-- Left wooden plank for rank -->
            <div class="wooden-plank-left">
                <p>Your Rank: <?php echo $user_rank; ?></p>
            </div>

            <!-- Right wooden plank for score -->
            <div class="wooden-plank-right">
                <p>Your Score: <?php echo $user_score; ?></p>
            </div>
        </div>


        <!-- Monkey leaderboard -->
        <img src="../assets/images/leaderboard-monkey.png" class="leaderboard-monkey" alt="Monkey">


        <!-- Back Button -->
        <a href="lobby.php">
            <img src="../assets/images/back.png" class="back-button" alt="Back">
        </a>
    </div>
</body>
</html>
