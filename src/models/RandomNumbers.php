<?php
  declare(strict_types=1);

  final class RandomNumbers {
    public $randomNumbers;
    public $howManyNumbers;
    public $maxNumber;

    public function __construct(int $howManyNumbers, int $maxNumber) {
      $this->howManyNumbers = $howManyNumbers;
      $this->maxNumber = $maxNumber;
      $this->randomNumbers = array();
    }

    public function generate() {
      // Fill randomNumbers with howManyNumbers of random numbers.
      for($numberCount = 1; $numberCount <= $this->howManyNumbers; $numberCount++) {
        $randomNumber = mt_rand(1, $this->maxNumber);

        // Make sure random is unique before storing.
        while (in_array($randomNumber, $this->randomNumbers)) {
          $randomNumber = mt_rand(1, $this->maxNumber);
        }

        // Store random number.
        array_push($this->randomNumbers, $randomNumber);
      }
    }
  }
