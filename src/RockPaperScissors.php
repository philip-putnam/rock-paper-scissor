<?php
    class RockPaperScissors
    {
        private $playerChoice;

        function __construct($initial_choice) {
            $this->playerChoice = $initial_choice;
        }

        function getPlayerChoice() {
            return $this->playerChoice;
        }

        function playGame($user1, $user2)
        {
            $result = "";
            if ($user1 == $user2)
            {
                $result = "Draw";
            }
            elseif (($user1 == "rock" && $user2 == "scissors") ||
                    ($user1 == "paper" && $user2 == "rock") ||
                    ($user1 == "scissors" && $user2 == "paper"))
            {
                $result = "Player 1";

            }
            elseif (($user1 == "scissors" && $user2 == "rock") ||
                    ($user1 == "rock" && $user2 == "paper") ||
                    ($user1 == "paper" && $user2 == "scissors"))
            {
                $result = "Player 2";
            }

            return $result;
        }

        function save()
        {
            array_push($_SESSION['games'], $this);
        }

        static function getAll() {
            return $_SESSION['games'];
        }

        static function deleteAll() {
            $_SESSION['games'] = array();
        }
    }
?>
