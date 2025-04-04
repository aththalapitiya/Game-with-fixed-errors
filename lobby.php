<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lobby - Peel 'n' Catch</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Kablammo&display=swap" rel="stylesheet">
</head>
<body>
    <div class="background">
            <!-- Game Title -->
            <img src="../assets/images/whack-a-banana.png" class="game-title" alt="Whack-a-Banana">

        <div class="lobby-container">

            <!-- Navigation Buttons -->
            <div class="button-group">
                <a href="play.php" class="lobby-button">PLAY</a>
                <a href="leaderboard.php" class="lobby-button">LEADERBOARD</a>
                <a href="howtoplay.php" class="lobby-button">HOW TO PLAY</a>
                <a href="../auth/logout.php" class="lobby-button">SIGN OUT</a>
            </div>
        </div>
        <!-- Power Icon -->
        <img src="../assets/images/turnoff.png" class="power-button" alt="Power">

        <!-- Speaker Button -->
            <img src="../assets/images/speaker.png" id="speaker-icon" class="speaker-button" alt="Speaker">

            <!-- Background Music -->
        <audio id="background-music" loop>
            <source src="../assets/sounds/background-music.mp3" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>

        <!-- Monkey Character -->
        <img src="../assets/images/monkey-character.png" class="monkey-character" alt="Monkey">
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let audio = document.getElementById("background-music");
            let speakerIcon = document.getElementById("speaker-icon");

            // Check if user preference exists
            let isMuted = localStorage.getItem("isMuted");

            if (isMuted === "true") {
                audio.muted = true;
            } else {
                audio.play();
            }

            // Toggle sound on click
            speakerIcon.addEventListener("click", function () {
                if (audio.muted) {
                    audio.muted = false;
                    localStorage.setItem("isMuted", "false");
                } else {
                    audio.muted = true;
                    localStorage.setItem("isMuted", "true");
                }
            });
        });
    </script>
</body>
</html>
