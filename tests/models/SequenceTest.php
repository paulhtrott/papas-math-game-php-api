<?php
  declare(strict_types=1);

  use PHPUnit\Framework\TestCase;

  final class SequenceTest extends TestCase {
    public function testConstructorSetsValuesCorrectly(): void {

      $game = new Game('addition', [1,2,3]);

      $sequence = new Sequence($game);

      $this->assertEquals($sequence->sequenceAnswers, array());
      $this->assertEquals($sequence->valuesHash, array());
    }

    public function testCalculateSequence(): void {

      $game = new Game('addition', [3,11,5,7]);

      $sequence = new Sequence($game);

      $sequence->calculateSequence();

      $this->assertEquals($sequence->valuesHash['game']['calculatedAnswers'], [8, 10, 12, 14, 15, 16, 18, 19, 21, 23, 26]);
      $this->assertEquals($sequence->valuesHash['game']['randomNumbers'], [3, 5, 7, 11]);
      $this->assertEquals($sequence->sequenceAnswers, [[14,15,16]]);
      $this->assertEquals($sequence->valuesHash['sequenceCollection'], [[8], [10], [12], [14, 15, 16], [18, 19], [21], [23], [26]]);
      $this->assertEquals($sequence->valuesHash['sequenceAnswers'], [[14,15,16]]);
    }
  }

