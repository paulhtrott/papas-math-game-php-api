<?php
  declare(strict_types=1);

  final class Sequence {
    public $game;
    public $sequenceAnswers;
    public $valuesHash;

    public function __construct(Game $game) {
      $this->game = $game;
      $this->sequenceAnswers = array();
      $this->valuesHash = array();
    }

    public function calculateSequence() {
      $this->game->calculateValues();

      // Get the answers for the sequence game.
      $answers = $this->game->calculatedAnswers;

      // Unique the answers.
      $answers = array_unique($answers);

      // Sort the answers.
      sort($answers);

      // Hold all the possible sequence answers.
      $fullCollection = array();

      // Hold the answers for each sequence.
      $collectionOfAnswers = array();

      foreach($answers as $number) {
        if (sizeOf($collectionOfAnswers) == 0) {
          array_push($collectionOfAnswers, $number);
        } else if ($collectionOfAnswers[sizeOf($collectionOfAnswers) - 1] + 1 == $number) {
          array_push($collectionOfAnswers, $number);

          // Close the collection when number is the final in the answers.
          if ($number == end($answers)) {
            array_push($fullCollection, $collectionOfAnswers);
          }
        } else {
          array_push($fullCollection, $collectionOfAnswers);

          $collectionOfAnswers = array();

          array_push($collectionOfAnswers, $number);

          // Close the collection when number is the final in the answers.
          if ($number == end($answers)) {
            array_push($fullCollection, $collectionOfAnswers);
          }
        }
      }

      // Size of the biggest array.
      $maxSize = sizeOf(max($fullCollection));

      foreach($fullCollection as $numCollection) {
        // Answers are all the sequences that are the max length.
        if (sizeOf($numCollection) == $maxSize) {
          array_push($this->sequenceAnswers, $numCollection);
        }
      }

      // Gather game values for response.
      $this->valuesHash = array(
        "game" => $this->game->valuesHash,
        "sequenceCollection" => $fullCollection,
        "sequenceAnswers" => $this->sequenceAnswers
      );
    }
  }
