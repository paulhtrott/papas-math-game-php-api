<?php
  declare(strict_types=1);

  include_once __DIR__ . '/../../../models/Game.php';
  include_once __DIR__ . '/../../../models/Possibles.php';
  include_once __DIR__ . '/../../../models/RandomNumbers.php';

  // Generate random numbers.
  $randomNumbers = new RandomNumbers(5, 40);

  $randomNumbers->generate();

  // Setup game from game settings.
  $game = new Game('addition', $randomNumbers->randomNumbers);

  $possibles = new Possibles($game);

  $possibles->calculatePossibles();

  // set response code - 200 OK
  http_response_code(200);

  //// show products data in json format
  echo json_encode($possibles->valuesHash);
