<?php
  declare(strict_types=1);

  final class Possibles {
    public $game;
    public $userNumbers;
    public $userMessage;
    public $valuesHash;
    public $lowestNumber;
    public $highestNumber;

    public function __construct(Game $game) {
      $this->game = $game;
      $this->userNumbers = array();
      $this->valuesHash = array();
    }

    public function calculatePossibles() {
      $this->game->calculateValues();

      // Generate numbers for users to use.
      $this->generateUserNumbers();

      // Gather game values for response.
      $this->valuesHash = array(
        "game" => $this->game->valuesHash,
        "userNumbers" => $this->userNumbers,
        "userMessage" => $this->userMessage,
        "lowestNumber" => $this->lowestNumber,
        "highestNumber" => $this->highestNumber
      );
    }

    private function generateUserNumbers() {
      $numbers = $this->game->randomNumbers;

      sort($numbers);

      $lowest = $numbers[0] - mt_rand(1, 10);

      $this->lowestNumber = $lowest < 1 ? 1 : $lowest;

      $this->highestNumber  = $numbers[sizeof($numbers) - 1] + mt_rand(1, 10);

      $this->userMessage = "Figure out which " . sizeof($numbers) . " numbers were used to get the following answers. Options are from {$this->lowestNumber} to {$this->highestNumber}.";

      $this->userNumbers = range($this->lowestNumber, $this->highestNumber);
    }

  }
