<?php
session_start();
include "../includes/db.php"; // Database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Peel 'n' Catch</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Kablammo&display=swap" rel="stylesheet">
</head>
<body>
    <div class="background">
        <div class="signin-container">
            <img src="../assets/images/SIGNIN.png" class="signin-title" alt="Sign In">
            
            <form action="../auth/login.php" method="POST">
                <label for="username">USERNAME</label>
                <input type="text" id="username" name="username" required>

                <label for="password">PASSWORD</label>
                <input type="password" id="password" name="password" required>

                <button type="submit" class="signin-button"></button>
            </form>

            <p class="signup-text">Don't have an account? <a href="signup.php">SIGN-UP</a></p>
        </div>

        <!-- Power Button -->
        <img src="../assets/images/turnoff.png" class="power-button" alt="Power">
        
        <!-- Speaker Icon -->
        <img src="../assets/images/speaker.png" class="speaker-button" alt="Speaker" id="speaker-icon">

        <!-- Background Music -->
        <audio id="background-music" loop>
            <source src="../assets/sounds/background-music.mp3" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>

        <!-- Monkey Pic -->
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
