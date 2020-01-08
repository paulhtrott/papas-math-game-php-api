<?php
  declare(strict_types=1);

  use PHPUnit\Framework\TestCase;

  final class RandomNumbersTest extends TestCase {
    public function testConstructorSetsValuesCorrectly(): void {

      $randomNumbers = new RandomNumbers(6, 100);

      $this->assertEquals($randomNumbers->randomNumbers, array());
      $this->assertEquals($randomNumbers->howManyNumbers, 6);
      $this->assertEquals($randomNumbers->maxNumber, 100);
    }

    public function testGenerateSetsRandomNumbers(): void {

      $randomNumbers = new RandomNumbers(6, 12);

      $randomNumbers->generate();

      $this->assertEquals(sizeOf($randomNumbers->randomNumbers), 6);
      $this->assertEquals($randomNumbers->howManyNumbers, 6);
      $this->assertEquals($randomNumbers->maxNumber, 12);
      $this->assertEquals(max($randomNumbers->randomNumbers) <= 12, true);
    }
  }

