<?php
session_start();
include "../includes/db.php"; // Include database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Peel 'n' Catch</title>
    <link rel="stylesheet" href="../assets/css/styles.css?v=<?php echo time(); ?>"> <!-- Cache Bypass -->
    <link href="https://fonts.googleapis.com/css2?family=Kablammo&display=swap" rel="stylesheet">
</head>
<body>
    <div class="background">
        <div class="signup-container">
            <img src="../assets/images/SIGNUP.png" class="signup-title" alt="Sign Up">

            <form action="../auth/register.php" method="POST" onsubmit="playSignupSound()">
                <label for="email">E-MAIL</label>
                <input type="email" id="email" name="email" required>

                <label for="username">USERNAME</label>
                <input type="text" id="username" name="username" required>

                <label for="password">PASSWORD</label>
                <input type="password" id="password" name="password" required>

                <!-- Signup Button -->
                    <button type="submit" class="signup-button"></button>
            </form>

        </div>

        <!-- back Button -->
        <img src="../assets/images/back.png" class="back-button" alt="Back">
        
        <!-- Speaker Icon -->
        <img src="../assets/images/speaker.png" id="speaker-icon" class="speaker-button" alt="Speaker">

        <!-- Background Music -->
        <audio id="background-music" loop>
            <source src="../assets/sounds/background-music.mp3" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>

        <!-- Monkey Character -->
        <img src="../assets/images/monkey-character.png" class="monkey-character" alt="Monkey">
    </div>

    <!-- Audio element for the background sound -->
    <audio id="signup-sound" src="../sounds/background-sound.mp3"></audio>

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

