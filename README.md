# Adventures of the Dice

## Project Title & Description
Adventures of the Dice is a Snakes and Ladders style board game built with PHP, HTML, and CSS. We built this game because we wanted to create a fun two-player experience that runs fully in the browser without any database. Players log in, pick a difficulty, and take turns rolling a dice to race across a 1-100 board. The game includes snakes that send you back, ladders that move you forward, and special event cells with an AI Narrator that tells the story of what happened each turn.

## Setup Instructions
- PHP 8.0 or higher is required
- Upload all files to your server keeping the same folder structure:
  ```
  Web_Project02/
  ├── login.php
  ├── register.php
  ├── start.php
  ├── game.php
  ├── leaderboard.php
  ├── logout.php
  ├── functions.php
  ├── style.css
  ├── users.json
  └── leaderboard.json
  ```
- Make sure `users.json` and `leaderboard.json` are writable by the server
- Open `login.php` in your browser to start

## Usage Guide
1. Go to `login.php` to log in or click Register to create a new account
2. After login you will be taken to the difficulty screen — choose Easy, Medium, or Hard
3. On the game page, click **Roll Dice** to take your turn
4. The board shows your position (red dot = Player 1, blue dot = Player 2)
5. Snake cells move you down, Ladder cells move you up
6. Special event cells trigger the AI Narrator box with a story message
7. First player to reach cell 100 wins — the result is saved to the leaderboard
8. Click **Leaderboard** to see all results sorted by fewest rolls
9. Click **Logout** in the top right to end your session

## Team Members
| Name | Student ID | Primary Contribution |
|------|------------|----------------------|
| Jinho Moon | 900881415 | Game logic, snakes & ladders, session management, AI narrator |
| Trinh Bui | 002681387 | Login/registration, leaderboard, CSS styling |

## GSU Codd Server Link