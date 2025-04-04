<?php 
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peel 'n' Catch - Game</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Kablammo&display=swap" rel="stylesheet">
</head>
<body>
    <div class="background">
        <!-- Game UI -->
        <div class="game-container">
            <!-- Background Music -->
            <audio id="background-music" src="../assets/sounds/background-music.mp3" loop autoplay></audio>
            <!-- Speaker Button -->
            <button id="speaker-icon" class="btn sound-btn"></button>

            <!-- Game Layout -->
            <button id="backBtn" class="btn back-btn"></button>


            <!-- Left Panel -->
            <div class="left-panel">
                    <div class="score-container">
                        <div class="score">Score: <span id="score">0</span></div>
                        <div class="heart">
                            <img src="../assets/images/heart.png" class="heart-icon" id="heart1" alt="Heart 1">
                            <img src="../assets/images/heart.png" class="heart-icon" id="heart2" alt="Heart 2">
                        </div>
                    </div>

                <!-- Play Banana Image -->
                <img src="../assets/images/play-banana.png" class="play-banana-image" alt="Play Banana Image" />
                
                <img src="../assets/images/speaker.png" id="speaker-icon" class="speaker-button" alt="Speaker">

            </div>

            <div id="board"></div>
            
            <div class="right-panel">
                <!-- API Image -->
                <div id="image-container">
                    <img id="imgApi" alt="Banana Image" />
                </div>

                <!-- Input for missing digit -->
                <div class="input-wrapper">
                    <input type="number" id="answerInput" placeholder="Enter digit">
                    <button id="submitAnswer">Submit</button>
                </div>

                <!-- Timer Section -->
                <div id="timer-container" class="timer-container">
                    <div class="timer-text">Time Left:</div>
                    <div id="timer" class="timer-number">100 secs</div>
                </div>

                <!-- Game Monkey Image positioned at bottom right -->
                <img id="game-monkey-image" src="../assets/images/game-monkey-2.png" alt="Monkey Image">

            </div>


            <!-- Back & Speaker Icons -->
            <a href="lobby.php">
                <img src="../assets/images/back.png" class="back-button" alt="Back">
            </a>
        </div>
    </div>

    <script src="../assets/js/main.js"></script>
</body>
</html>
