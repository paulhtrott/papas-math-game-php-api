<?php
  declare(strict_types=1);

  use PHPUnit\Framework\TestCase;

  final class GameTest extends TestCase {
    public function testConstructorSetsValuesCorrectly(): void {

      $game = new Game('addition', [1,2,3,4,5,6]);

      $this->assertEquals($game->operation, 'addition');
      $this->assertEquals($game->valuesHash, array());
      $this->assertEquals($game->combinationsUsed, array());
      $this->assertEquals($game->calculatedAnswers, array());
      $this->assertEquals($game->operationSymbol, '+');
      $this->assertEquals($game->randomNumbers, [1,2,3,4,5,6]);
    }

    public function testCalculateValues(): void {

      $game = new Game('addition', [1,2,3]);

      $game->calculateValues();

      $this->assertEquals($game->operation, 'addition');
      $this->assertEquals($game->operationSymbol, '+');
      $this->assertEquals($game->randomNumbers, [1,2,3]);
      $this->assertEquals($game->valuesHash['randomNumbers'], [1,2,3]);
      $this->assertEquals($game->valuesHash['combinationsUsed'], ['1 + 2 + 3 = 6', '1 + 2 = 3', '1 + 3 = 4', '2 + 3 = 5']);
      $this->assertEquals($game->valuesHash['calculatedAnswers'], [3, 4, 5, 6]);
    }
  }
