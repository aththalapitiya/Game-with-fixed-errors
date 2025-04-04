let lives = 2;
let solution = 0;
let timerInterval = null;
let timeLeft = 20;  // Set the timer to 20 seconds per equation
const bananaApiUrl = 'http://marcconrad.com/uob/banana/api.php?out=json';
let correctAnswer = null;
let currBananaTile;
let currPlantTile;
let score = 0;
let gameOver = false;
let timerPaused = false;  
let gamePaused = false;
let bananaInterval;
let plantInterval;



// document.getElementById("user-rank").textContent = "Your Rank: " + rank;  // Replace 'username' with the actual username variable
// document.getElementById("user-score").textContent = "Your Score: " + score;  // Replace 'score' with the actual score variable


document.addEventListener("DOMContentLoaded", function () {
    const scoreEl = document.getElementById('score');
    const timerEl = document.getElementById('timer');
    const heart1 = document.getElementById('heart1');
    const heart2 = document.getElementById('heart2');
    const backBtn = document.getElementById('backBtn');
    let audio = document.getElementById("background-music");
    let speakerIcon = document.getElementById("speaker-icon");



    // Load mute state from localStorage
    let isMuted = localStorage.getItem("isMuted");
    if (isMuted === "true") {
        audio.muted = true;
    } else {
        audio.play();
    }

    // Toggle sound on icon click
    speakerIcon.addEventListener("click", function () {
        if (audio.muted) {
            audio.muted = false;
            localStorage.setItem("isMuted", "false");
        } else {
            audio.muted = true;
            localStorage.setItem("isMuted", "true");
        }
    });

    // Back button
    backBtn.addEventListener('click', () => {
        window.location.href = 'lobby.php';
    });

    // Start the first equation
    fetchImage();


    // Answer submission
    document.getElementById('submitAnswer').addEventListener('click', () => {
        const answer = document.getElementById('answerInput').value;
        if (answer == solution) {
            score += 10;
            scoreEl.textContent = score;
            fetchImage(); 
            resumeGame(); 
        } else {
            loseLife();
            resetTimer();
            pauseTimer();
            resumeGame();
        }
        document.getElementById('answerInput').value = '';
    });
});

// Function to fetch the image and equation
function fetchImage() {
    // Clear the existing timer interval to avoid multiple timers running
    clearInterval(timerInterval);
    timeLeft = 20;  // Reset the timer to 20 seconds for the new equation
    document.getElementById('timer').textContent = timeLeft + " secs";  // Update the timer UI

    // Fetch the new equation
    fetch('https://marcconrad.com/uob/banana/api.php')
        .then(response => response.json())
        .then(data => {
            solution = data.solution;
            document.getElementById("imgApi").src = data.question;

            // // Start the timer for this equation
            // startTimer();
        })
        .catch(error => {
            console.error('Error fetching image from the API:', error);
        });
}

// Timer function to update the time
function startTimer() {
    // Start the countdown timer for 20 seconds per equation
    timerInterval = setInterval(() => {
        timeLeft--;
        document.getElementById('timer').textContent = timeLeft + " secs";
        if (timeLeft <= 0) {
            clearInterval(timerInterval);  // Stop the timer
            loseLife();  // Penalize for not answering in time
            fetchImage();  // Load a new equation
        }
    }, 1000);
}

// Function to reset the timer
function resetTimer() {
    clearInterval(timerInterval);  // Stop the current timer
    timeLeft = 20;  // Reset the timer to 20 seconds
    document.getElementById('timer').textContent = timeLeft + " secs";  // Update the timer display
    startTimer();  // Start the timer again
}


// Function to pause the timer
function pauseTimer() {
    if (timerPaused) return;  // Prevent pausing if the timer is already paused
    clearInterval(timerInterval);  // Stop the timer
    timerPaused = true;  // Set the flag to true
    console.log('Timer paused');
}


// Life manager - Lose life if the answer is wrong or time runs out
function loseLife() {
    lives--;
    if (lives === 1) {
        document.getElementById('heart2').style.opacity = 0;
    }

    if (lives === 0) {
        document.getElementById('heart1').style.opacity = 0;
        endGame();
    }
}

// End the game when time is up or the player runs out of lives
function endGame() {
    clearInterval(timerInterval);  // Clear the timer when the game ends
    alert("Game Over! Your score: " + score);
    window.location.href = 'lobby.php';  // Redirect to the lobby page
}



// main whack game 3x3
window.onload = function(){
    setGame();
}

function setGame(){                                 //setup the grid for the game board in html
    for (let i=0; i<9; i++){                        //i goes from 0 to 8, stops at 9       
        //<div id="0-8"></div>
        let tile = document.createElement("div");
        tile.id = i.toString();
        tile.addEventListener("click", selectTile);
        document.getElementById("board").appendChild(tile);
    }

    bananaInterval=setInterval(setBanana, 1000); //1000 ms , that means its 1 seconds. So every 1 seconds setBanana is called
    plantInterval=setInterval(setPlant, 2000); //2000 ms , that means its 2 seconds. So every 2 seconds setPlant is called
}

// Pause the game by clearing the intervals
function pauseGame() {
    if (gamePaused) return;  // Prevent pausing if already paused
    clearInterval(bananaInterval);  // Stop the banana interval
    clearInterval(plantInterval);   // Stop the plant interval
    gamePaused = true;
    console.log("Game paused");
}

// Resume the game by restarting the intervals
function resumeGame() {
    if (!gamePaused) return;  // Prevent resuming if the game is already running
    gamePaused = false;

    // Restart intervals for banana and plant spawning
    bananaInterval = setInterval(setBanana, 1000); // Every 1 second
    plantInterval = setInterval(setPlant, 2000); // Every 2 seconds
    console.log("Game resumed");
}



function getRandomTile() {
    //math.random --> (0-1)*9 = (0-9) --> round down to (0-8) integers   
    let num = Math.floor(Math.random() * 9);
    return num.toString();
}


function setBanana() {

    if (gameOver){
        return;
    }

    if (currBananaTile) {
        currBananaTile.innerHTML = "";
    }

    let banana = document.createElement("img");
    banana.src = "/peel-n-catch-game/assets/images/banana.png";


    let num = getRandomTile();
    if(currPlantTile && currPlantTile.id == num){
        return;
    }
    currBananaTile = document.getElementById(num);
    currBananaTile.appendChild(banana);



    // Position the banana correctly on top of the pipe
    banana.style.position = "absolute";  // Set the banana's position as absolute inside the pipe div
    banana.style.top = "30%";  // Center the banana vertically inside the pipe
    banana.style.left = "50%"; // Center the banana horizontally inside the pipe
    banana.style.transform = "translate(-50%, -50%)";  // Ensure the banana is centered perfectly
}


function setPlant(){

    if (gameOver){
        return;
    }

    if (currPlantTile) {
        currPlantTile.innerHTML = "";
    }

    let plant = document.createElement("img");
    plant.src = "/peel-n-catch-game/assets/images/piranha-plant.png";


    let num = getRandomTile();
    if(currBananaTile && currBananaTile.id == num){
        return;
    }
    currPlantTile = document.getElementById(num);
    currPlantTile.appendChild(plant);

    
}

function selectTile() {

    if (gameOver){
        return;
    }

    if(this == currBananaTile) {
        score += 5;
        document.getElementById("score").innerText = score.toString();  //update the score in main game
    }
    else if (this == currPlantTile) {
        document.getElementById("score").innerText = "GAME OVER:" + score.toString();
        gameOver - true;
        startTimer();
        pauseGame();
    }
}





