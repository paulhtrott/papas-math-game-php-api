<?php
  declare(strict_types=1);

  // $operation [String] Type of calculation to do, ie: 'addition' | 'multiplication'.
  // $howManyNumbers [Integer] How many numbers used to run calculations.
  // $userNumbers [Array] Numbers to be given to user to guess with.
  // $randomNumbers [Array] Numbers used to calculate answers.
  final class Game {
    public $operation;
    public $operationSymbol;
    public $howManyNumbers;
    public $maxNumber;
    public $userNumbers;
    public $randomNumbers;
    public $combinationsUsed;
    public $calculatedAnswers;
    public $valuesHash;

    public function __construct(string $operation, int $howManyNumbers, int $maxNumber) {
      $this->operation = $operation;
      $this->howManyNumbers = $howManyNumbers;
      $this->maxNumber = $maxNumber;
      $this->valuesHash = array();
      $this->userNumbers = array();
      $this->randomNumbers = array();
      $this->combinationsUsed = array();
      $this->calculatedAnswers = array();
      $this->operationSymbol = array(
        'addition' => '+',
        'multiplication' => 'x'
      )[$this->operation];
    }

    public function calculateValues() {
      // Fill randomNumbers with howManyNumbers of random numbers.
      for($numberCount = 1; $numberCount <= $this->howManyNumbers; $numberCount++) {
        array_push($this->randomNumbers, mt_rand(1, $this->maxNumber));
      }

      $this->calculateAnswers(array(), 0, 0);

      // Gather game values for response.
      $this->valuesHash = array(
        "numbers_to_choose_from" => array(),
        "array_of_numbers" => $this->randomNumbers,
        "combinations_used" => $this->combinationsUsed,
        "calculated_values" => $this->calculatedAnswers,
        "message" => "User needs to calculate..."
      );
    }

    private function calculateAnswers($currentCollection, $index, $accumulation) {
      // Only if index is not about length. To avoid out of range.
      if ($index < sizeof($this->randomNumbers)) {
        foreach(range($index, sizeof($this->randomNumbers) - 1) as $num) {
          // Temporary array for holding values.
          $tempArray = array();

          // Add numbers to temp array.
          foreach($currentCollection as $item) {
            array_push($tempArray, $item);
          }

          // Add new value to temporary array.
          array_push($tempArray, $this->randomNumbers[$num]);

          // Call method again.
          $this->calculateAnswers($tempArray, $num + 1, $accumulation + $this->randomNumbers[$num]);
        }
      }

      // Collect/Show how calculations found.
      if (sizeof($currentCollection) > 1) {
        $mathText = join(" {$this->operationSymbol} ", $currentCollection);

        array_push($this->combinationsUsed, "{$mathText} = {$accumulation}");
      }

      // Collect/Show answers.
      if (sizeof($currentCollection) > 1) {
        array_push($this->calculatedAnswers, $accumulation);
      }
    }
  }
