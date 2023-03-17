<?php

// Define the start and end dates
$start_date = '2022-01-01';
$end_date = '2022-12-31';

// Define the list of international holidays
$international_holidays = array(
  '2022-01-01', // New Year's Day
  '2022-03-08', // International Women's Day
  '2022-04-15', // Khmer New Year
  '2022-05-01', // International Labour Day
  '2022-05-09', // King Norodom Sihamoni's Birthday
  '2022-05-13', // Visak Bochea Day
  '2022-05-14', // Royal Ploughing Ceremony
  '2022-06-01', // International Children's Day
  '2022-06-18', // Queen Mother's Birthday
  '2022-09-24', // Constitutional Day
  '2022-10-15', // Pchum Ben Day
  '2022-10-23', // Paris Peace Agreements Day
  '2022-10-29', // King Norodom Sihanouk's Birthday
  '2022-11-09', // Independence Day
);

// Define the list of Cambodian holidays
$cambodian_holidays = array(
  '2022-01-07', // Victory over Genocide Day
  '2022-01-31', // Meak Bochea Day
  '2022-06-03', // Queen's Birthday
  '2022-09-21', // International Day of Peace
  '2022-11-10', // Water Festival Day
);

// Define the number of half-day Saturdays
$half_day_saturdays = 0;
// Loop through each day between the start and end dates
$working_days = 0;

$current_date = strtotime($start_date);
$end_date = strtotime($end_date);
while ($current_date <= $end_date) {
  // Check if the current day is a Sunday
  $day_of_week = date('N', $current_date);
  if ($day_of_week != 7) {
    // Check if the current day is a half-day Saturday
    if ($day_of_week == 6 && $half_day_saturdays < 2) {
      $working_days += 0.5;
      $half_day_saturdays++;
    } else {
      // Check if the current day is a holiday
      $current_date_str = date('Y-m-d', $current_date);
      if (!in_array($current_date_str, $international_holidays) && !in_array($current_date_str, $cambodian_holidays)) {
        $working_days++;
      }
    }
  }
  // Move to the next day
  $current_date = strtotime('+1 day', $current_date);
}

// Print the result
echo "Number of working days: " . $working_days . "\n";