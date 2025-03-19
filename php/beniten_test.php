<?php
function count_working_days($year)
{
  $totalWorkingDays = 0;

  // Define the fixed holidays in the given year
  $holidays = [
    "$year-01-07", // 7th January
    "$year-04-13",
    "$year-04-14",
    "$year-04-15", // Khmer New Year (April 13-15)
    "$year-05-01", // 1st May (Labor Day)
    "$year-06-18", // 18th June
    "$year-11-09", // 9th November (Independence Day)
    "$year-12-10" // 10th December
  ];

  // Set the start and end dates of the year
  $start = strtotime("$year-01-01");
  $end = strtotime("$year-12-31");

  // Loop through each day of the year
  while ($start <= $end) {
    $dayOfWeek = date('N', $start); // Get day of the week (1 = Monday, 7 = Sunday)
    $date = date('Y-m-d', $start); // Get the date in YYYY-MM-DD format

    if (in_array($date, $holidays)) {
      // If the current day is a holiday, skip counting it
    } elseif ($dayOfWeek >= 1 && $dayOfWeek <= 5) {
      // Monday to Friday are full working days
      $totalWorkingDays++;
    } elseif ($dayOfWeek == 6) {
      // If it's Saturday, check if the previous day (Friday) was a holiday
      $friday = date('Y-m-d', strtotime('-1 day', $start));
      if (in_array($friday, $holidays)) {
        // If Friday was a holiday, Saturday is also treated as a full holiday
      } else {
        // Otherwise, Saturday is a half-day working day
        $totalWorkingDays += 0.5;
      }
    }

    // Move to the next day
    $start = strtotime('+1 day', $start);
  }

  // Return the total count of working days in the year
  return $totalWorkingDays;
}

// Example usage
$year = 2025;
echo "Total working days in $year: " . count_working_days($year);
