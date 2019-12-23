<?php
  declare(strict_types=1);

  include_once '../../../models/Game.php';

  // Setup game from game settings.
  $game = new Game('addition', 5, 15);

  $game->calculateValues();

  // set response code - 200 OK
  http_response_code(200);

  //// show products data in json format
  echo json_encode($game->valuesHash);
