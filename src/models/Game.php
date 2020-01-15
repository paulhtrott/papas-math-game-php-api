<?php
  declare(strict_types=1);

  // $operation [String] Type of calculation to do, ie: 'addition' | 'multiplication'.
  // $randomNumbers [Array] Numbers used to calculate answers.
  final class Game {
    public $operation;
    public $operationSymbol;
    public $randomNumbers;
    public $combinationsUsed;
    public $calculatedAnswers;
    public $valuesHash;

    // @param [string] operation The type of calculation. For example, 'addition'.
    // @param [array] randomNumbers The numbers to use for game.
    public function __construct(string $operation, array $randomNumbers) {
      $this->operation = $operation;
      $this->valuesHash = array();
      $this->randomNumbers = $randomNumbers;
      $this->combinationsUsed = array();
      $this->calculatedAnswers = array();
      $this->operationSymbol = array(
        'addition' => '+',
        'multiplication' => 'x'
      )[$this->operation];
    }

    public function calculateValues() {
      // Calculate the numbers for the game.
      $this->calculateAnswers(array(), 0, 0);

      // Sort the random numbers used.
      sort($this->randomNumbers);

      // Sort the calculatedNumbers.
      sort($this->calculatedAnswers);

      // Gather game values for response.
      $this->valuesHash = array(
        "randomNumbers" => $this->randomNumbers,
        "combinationsUsed" => $this->combinationsUsed,
        "calculatedAnswers" => $this->calculatedAnswers
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
