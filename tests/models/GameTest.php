<?php
  declare(strict_types=1);

  use PHPUnit\Framework\TestCase;

  final class GameTest extends TestCase {
    public function testConstructorSetsValuesCorrectly(): void {

      $game = new Game('addition', 6, 50);

      $this->assertEquals($game->operation, 'addition');
      $this->assertEquals($game->howManyNumbers, 6);
      $this->assertEquals($game->maxNumber, 50);
      $this->assertEquals($game->valuesHash, array());
      $this->assertEquals($game->userNumbers, array());
      $this->assertEquals($game->randomNumbers, array());
      $this->assertEquals($game->combinationsUsed, array());
      $this->assertEquals($game->calculatedAnswers, array());
      $this->assertEquals($game->operationSymbol, '+');
    }
  }
