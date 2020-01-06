<?php
  declare(strict_types=1);

  include_once '../../../models/Game.php';
  include_once '../../../models/Sequence.php';

  // Setup game from game settings.
  $game = new Game('addition', 5, 15);

  $sequence = new Sequence($game);

  $sequence->calculateSequence();

  // set response code - 200 OK
  http_response_code(200);

  //// show products data in json format
  echo json_encode($sequence->valuesHash);
