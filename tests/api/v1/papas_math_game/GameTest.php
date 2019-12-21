<?php
  declare(strict_types=1);

  require __DIR__ . '/../../../../src/api/v1/papas_math_game/Game.php';

  use PHPUnit\Framework\TestCase;

  final class GameTest extends TestCase {
    public function testConstructorSetsValuesCorrectly(): void {

      $game = new Game('addition', 6);

      $this->assertEquals($game->operation, 'addition');
      $this->assertEquals($game->howManyNumbers, 6);
    }
  }