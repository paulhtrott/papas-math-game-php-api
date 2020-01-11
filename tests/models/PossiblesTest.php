<?php
  declare(strict_types=1);

  use PHPUnit\Framework\TestCase;

  final class PossiblesTest extends TestCase {
    public function testConstructorSetsValuesCorrectly(): void {

      $game = new Game('addition', [1,2,3]);

      $possibles = new Possibles($game);

      $this->assertEquals($possibles->userNumbers, array());
      $this->assertEquals($possibles->valuesHash, array());
    }

    public function testCalculatePossibles(): void {

      $game = new Game('addition', [3,11,5,7]);

      $possibles = new Possibles($game);

      $possibles->calculatePossibles();

      $this->assertEquals($possibles->valuesHash['game']['calculatedAnswers'], [8, 10, 12, 14, 15, 16, 18, 19, 21, 23, 26]);
      $this->assertEquals($possibles->valuesHash['game']['randomNumbers'], [3, 5, 7, 11]);
      $this->assertEquals($possibles->userMessage, "Figure out which 4 numbers were used to get the following answers. Options are from {$possibles->lowestNumber} to {$possibles->highestNumber}.");
      $this->assertEquals($possibles->valuesHash['userNumbers'], range($possibles->lowestNumber, $possibles->highestNumber));
    }
  }


