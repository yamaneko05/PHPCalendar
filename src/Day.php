<?php 

namespace app;

class Day
{
  public $timestamp, $today, $schedule;

  public function __construct($timestamp, $today) {
    $this->timestamp = $timestamp;
    $this->today = $today;
  }

  public function setSchedule($schedule) {
    $this->schedule = $schedule;
  }

  public function getSchedule()
  {
    if ($schedule = $this->schedule) {
      return $schedule;
    } else {
      return false;
    }
  }
}