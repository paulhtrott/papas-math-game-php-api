<?php
  // operation to use: addition, multiplication, etc.
  $operation = 'addition';

  // for showing operation for messages.
  $operation_symbol = array(
    'addition' => '+',
    'multiplication' => 'x'
  );

  // How many numbers to calculate with.
  $how_many_numbers = 3;

  // Numbers to be given to user to guess with.
  $numbers_to_choose_from = array();

  // Random numbers to be used for calculation.
  $array_of_numbers = array();

  // Fill array_of_numbers with how_many_numbers of random numbers.
  for($number_count = 1; $number_count <= $how_many_numbers; $number_count++) {
    array_push($array_of_numbers, mt_rand(1, 5));
  }

  // Store for combinations used.
  $combinations_used = array();

  // Store for answers calculated.
  $calculated_values = array();

  function calculateValues($current_collection, $index, $accumulation) {
    // Access global variables.
    global $array_of_numbers;
    global $combinations_used;
    global $calculated_values;
    global $operation;
    global $operation_symbol;

    // Only if index is not about length. To avoid out of range.
    if ($index < sizeof($array_of_numbers)) {
      foreach(range($index, sizeof($array_of_numbers) - 1) as $num) {
        // Temporary array for holding values.
        $temp_array = array();

        // Add numbers to temp array.
        foreach($current_collection as $item) {
          array_push($temp_array, $item);
        }

        // Add new value to temporary array.
        array_push($temp_array, $array_of_numbers[$num]);

        // Call method again.
        calculateValues($temp_array, $num + 1, $accumulation + $array_of_numbers[$num]);
      }
    }

    // Collect/Show how calculations found.
    if (sizeof($current_collection) > 1) {
      $math_text = join(" {$operation_symbol[$operation]} ", $current_collection);

      array_push($combinations_used, "{$math_text} = {$accumulation}");
    }

    // Collect/Show answers.
    if (sizeof($current_collection) > 1) {
      array_push($calculated_values, $accumulation);
    }
  };

  // Call method to calculate values.
  calculateValues(array(), 0, 0);

  // Gather game values for response.
  $game_values = array(
    "numbers_to_choose_from" => array(),
    "array_of_numbers" => $array_of_numbers,
    "combinations_used" => $combinations_used,
    "calculated_values" => $calculated_values,
    "message" => "User needs to calculate..."
  );

  // set response code - 200 OK
  http_response_code(200);

  // show products data in json format
  echo json_encode($game_values);
