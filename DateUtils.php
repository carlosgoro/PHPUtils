<?php
namespace PHPUtils;

/**
 * Class DateUtils
 *
 * Static methods to handle dates
 *
 * @package PHPUtils
 * @author Carlos Gómez <carlos.go.rod@gmail.com>
 */
class DateUtils
{

    /**
     * Default date format
     * @var string
     */
    private static $dateFormat = 'Y-m-d';
    
    /**
     * Default datetime format
     * @var string
     */
    private static $datetimeFormat = 'Y-m-d H:i:s';
    

    // =============================================================================================
    //                                     Time methods
    // =============================================================================================


    /**
     * Get the timestamp of a week/year.
     * You can use $daysToAdd parameter to get the timestamp of a future week.
     * If you need to subtract days you can use a negative value for $daysToAdd parameter.
     *
     * @param int $weekNumber
     * @param int $year
     * @param int $daysToAdd
     *
     * @return int
     */
    private static function timeFromWeek ($weekNumber, $year, $daysToAdd = 0) {
        return strtotime($year."W".str_pad($weekNumber, 2, '0', STR_PAD_LEFT))+($daysToAdd*24*60*60);
    }

    /**
     * Get the timestamp of a date.
     * You can use $daysToAdd parameter to get the timestamp of a future date.
     * If you need to subtract you can use a negative value for $daysToAdd parameter.
     *
     * @param \Datetime $date
     * @param int $daysToAdd
     *
     * @return int
     */
    private static function timeFromDate ($date, $daysToAdd = 0) {
        return $date->getTimestamp()+($daysToAdd*24*60*60);
    }
    
    /**
     * Get the number of hours between to dates
     *
     * @param \Datetime $startDate
     * @param \Datetime $endDate
     *
     * @return float
     */
    public static function hoursBetweenDates ($startDate, $endDate) {
        return ( self::timeFromDate($endDate, 0) - self::timeFromDate($startDate, 0) ) / (60*60);
    }





    // =============================================================================================
    //                                     Day methods
    // =============================================================================================


    /**
     * Get an array with the days between two dates as datetime objects
     *
     * @param \Datetime $startDate
     * @param \Datetime $endDate
     *
     * @return array[\Datetime]
     */
    public static function getDaysBetweenDates ($startDate, $endDate) {
        $numDays = $startDate->diff($endDate)->days;
        $days    = array();
        for ($i=0; $i<=$numDays+1; $i++) {
            $days[] = new \Datetime(date(self::$dateFormat, self::timeFromDate($startDate, $i) ));
        }
        return $days;
    }

    /**
     * Get an array with the days between two dates as strings
     *
     * @param \Datetime $startDate
     * @param \Datetime $endDate
     *
     * @return array[string]
     */
    public static function getDaysBetweenDatesAsString ($startDate, $endDate) {
        $numDays = $startDate->diff($endDate)->days;
        $days    = array();
        for ($i=0; $i<=$numDays+1; $i++) {
            $days[] = date(self::$dateFormat, self::timeFromDate($startDate, $i));
        }
        return $days;
    }

    /**
     * Get an array with the days between two dates as timestamp
     *
     * @param \Datetime $startDate
     * @param \Datetime $endDate
     *
     * @return array[int]
     */
    public static function getDaysBetweenDatesAsTimestamp ($startDate, $endDate) {
        $numDays = $startDate->diff($endDate)->days+1;
        $days    = array();
        for ($i=0; $i<=$numDays; $i++) {
            $days[] = self::timeFromDate($startDate, $i);
        }
        return $days;
    }

    /**
     * Get the number of days between to dates
     *
     * @param \Datetime $startDate
     * @param \Datetime $endDate
     *
     * @return int
     */
    public static function daysBetweenDates ($startDate, $endDate) {
        return $startDate->diff($endDate)->days;
    }





    // =============================================================================================
    //                                     Week methods
    // =============================================================================================


    /**
     * Get the first day of a week as string
     *
     * @param int $weekNumber
     * @param int $year
     *
     * @return bool|string
     */
    public static function firstDayOfWeekAsString ($weekNumber, $year) {
        return date(self::$dateFormat, self::timeFromWeek($weekNumber, $year));
    }

    /**
     * Get the first day of a week as timestamp
     *
     * @param int $weekNumber
     * @param int $year
     *
     * @return int
     */
    public static function firstDayOfWeekAsTimestamp ($weekNumber, $year) {
        return self::timeFromWeek($weekNumber, $year);
    }

    /**
     * Get the first day of a week as datetime object
     *
     * @param int $weekNumber
     * @param int $year
     *
     * @return \Datetime
     */
    public static function firstDayOfWeek ($weekNumber, $year) {
        return new \Datetime(self::firstDayOfWeekAsString($weekNumber, $year));
    }

    /**
     * Get the last day of a week as string
     *
     * @param int $weekNumber
     * @param int $year
     *
     * @return bool|string
     */
    public static function lastDayOfWeekAsString ($weekNumber, $year) {
        return date(self::$dateFormat, self::timeFromWeek($weekNumber, $year, 6));
    }

    /**
     * Get the last day of a week as timestamp
     *
     * @param int $weekNumber
     * @param int $year
     *
     * @return int
     */
    public static function lastDayOfWeekAsTimestamp ($weekNumber, $year) {
        return self::timeFromWeek($weekNumber, $year, 6);
    }

    /**
     * Get the last day of a week as datetime object
     *
     * @param int $weekNumber
     * @param int $year
     *
     * @return \Datetime
     */
    public static function lastDayOfWeek ($weekNumber, $year) {
        return new \Datetime(self::lastDayOfWeekAsString($weekNumber, $year));
    }

    /**
     * Get an array with the days of a week as strings
     *
     * @param int $weekNumber
     * @param int $year
     *
     * @return array[string]
     */
    public static function getDaysOfWeekAsString ($weekNumber, $year) {
        $daysOfWeek = array();
        for ($i=0; $i<=6 ; $i++) {
            $daysOfWeek[] = date(self::$dateFormat, self::timeFromWeek($weekNumber, $year, $i));
        }
        return $daysOfWeek;
    }

    /**
     * Get an array with the days of a week as timestamp
     *
     * @param int $weekNumber
     * @param int $year
     *
     * @return array[int]
     */
    public static function getDaysOfWeekAsTimestamp ($weekNumber, $year) {
        $daysOfWeek = array();
        for ($i=0; $i<=6 ; $i++) {
            $daysOfWeek[] = self::timeFromWeek($weekNumber, $year, $i);
        }
        return $daysOfWeek;
    }

    /**
     * Get an array with the days of a week as datetime objects
     *
     * @param int $weekNumber
     * @param int $year
     *
     * @return array[\Datetime]
     */
    public static function getDaysOfWeek ($weekNumber, $year) {
        $daysOfWeek = array();
        for ($i=0; $i<=6 ; $i++) {
            $daysOfWeek[] = new \Datetime(date(self::$dateFormat, self::timeFromWeek($weekNumber, $year, $i) ));
        }
        return $daysOfWeek;
    }

    /**
     * Get the number of weeks between to dates
     *
     * @param \Datetime $startDate
     * @param \Datetime $endDate
     *
     * @return int
     */
    public static function weeksBetweenDates ($startDate, $endDate) {
        return floor(self::daysBetweenDates($startDate, $endDate)/7);
    }

    /**
     * Get an array with the weeks between two dates grouped by years.
     * The array format depends on the $format parameter
     *
     * @param \Datetime $startDate
     * @param \Datetime $endDate
     * @param int $format
     *
     * @return array
     */
    public static function getWeeksBetweenDatesByYear($startDate, $endDate, $format = 0) {
        $startYear  = date('Y', self::timeFromDate($startDate, 0));
        $startWeek  = (int)date('W', self::timeFromDate($startDate, 0));
        $endYear    = date('Y', self::timeFromDate($endDate, 0));
        $endWeek    = (int)date('W', self::timeFromDate($endDate, 0));
        $startMonth = date('n', self::timeFromDate($startDate, 0));

        // If the last week of a year is 1, in fact is the first week of the next year
        if ($startWeek == 1 && $startMonth == 12) {
            $startYear = $startYear++;
        }

        switch ($format) {
            case 0:
                $weeks = self::getWeeksBetweenDatesByYear0($startYear, $startWeek, $endYear, $endWeek);
                break;
            case 1:
                $weeks = self::getWeeksBetweenDatesByYear1($startYear, $startWeek, $endYear, $endWeek);
                break;
            case 2:
                $weeks = self::getWeeksBetweenDatesByYear2($startYear, $startWeek, $endYear, $endWeek);
                break;
            default:
                $weeks = self::getWeeksBetweenDatesByYear0($startYear, $startWeek, $endYear, $endWeek);
        }

        return $weeks;
    }

    /**
     * Get an array with the weeks between two weeks/years grouped by years as array[year][week]
     *
     * @param int $startYear
     * @param int $startWeek
     * @param int $endYear
     * @param int $endWeek
     *
     * @return array[int][int]
     */
    private static function getWeeksBetweenDatesByYear0 ($startYear, $startWeek, $endYear, $endWeek) {
        $startDate = self::firstDayOfWeek($startWeek, $startYear);
        $endDate   = self::lastDayOfWeek($endWeek, $endYear);
        $weeks     = array();
        while ($startDate < $endDate) {
            $year  = date('Y', self::timeFromDate($startDate, 0));
            $week  = (int)date('W', self::timeFromDate($startDate, 0));
            $month = (int)date('n', self::timeFromDate($startDate, 0));

            $yearPatch = 0;
            if ($week == 1 && $month == 12) {
                $yearPatch = 1;
            }
            $weeks[$year+$yearPatch][$week] = null;
            $startDate->setTimestamp(self::timeFromDate($startDate, 7));
        }
        return $weeks;
    }

    /**
     * Get an array with the weeks between two weeks/years grouped by years as array[year][0..n] = week
     *
     * @param int $startYear
     * @param int $startWeek
     * @param int $endYear
     * @param int $endWeek
     *
     * @return array[int][int]
     */
    private static function getWeeksBetweenDatesByYear1 ($startYear, $startWeek, $endYear, $endWeek) {
        $startDate = self::firstDayOfWeek($startWeek, $startYear);
        $endDate   = self::lastDayOfWeek($endWeek, $endYear);
        $weeks     = array();
        while ($startDate < $endDate) {
            $year  = date('Y', self::timeFromDate($startDate, 0));
            $week  = (int)date('W', self::timeFromDate($startDate, 0));
            $month = (int)date('n', self::timeFromDate($startDate, 0));

            $yearPatch = 0;
            if ($week == 1 && $month == 12) {
                $yearPatch = 1;
            }
            $weeks[$year+$yearPatch][] = $week;
            $startDate->setTimestamp(self::timeFromDate($startDate, 7));
        }
        return $weeks;
    }

    /**
     * Get an array with the weeks between two weeks/years grouped by years as array[0..n]([year][week][firstDay][lastDay][data])
     *
     * @param int $startYear
     * @param int $startWeek
     * @param int $endYear
     * @param int $endWeek
     *
     * @return array[int][mixed]
     */
    private static function getWeeksBetweenDatesByYear2 ($startYear, $startWeek, $endYear, $endWeek) {
        $startDate = self::firstDayOfWeek($startWeek, $startYear);
        $endDate   = self::lastDayOfWeek($endWeek, $endYear);
        $weeks     = array();
        while ($startDate < $endDate) {
            $year  = date('Y', self::timeFromDate($startDate, 0));
            $week  = (int)date('W', self::timeFromDate($startDate, 0));
            $month = (int)date('n', self::timeFromDate($startDate, 0));

            $yearPatch = 0;
            if ($week == 1 && $month == 12) {
                $yearPatch = 1;
            }
            $weeks[] = array(
                'year'     => $year+$yearPatch,
                'week'     => $week,
                'firstDay' => self::firstDayOfWeek($week, $year),
                'lastDay'  => self::lastDayOfWeek($week, $year),
                'data'     => null
            );
            $startDate->setTimestamp(self::timeFromDate($startDate, 7));
        }
        return $weeks;
    }





    // =============================================================================================
    //                                     Fornight methods
    // =============================================================================================


    /**
     * Get the year fortnight of a date
     *
     * @param \Datetime $date
     *
     * @return int
     */
    public static function dateFortnight ($date) {
        $yearDay = date('z', self::timeFromDate($date, 0));
        return floor($yearDay/15);
    }
    
    /**
     * Get an array with the fortnights between two dates grouped by years.
     * The array format depends on the $format parameter:
     *      0 : month fortnight
     *      1 : year fortnight
     *
     * @param \Datetime $startDate
     * @param \Datetime $endDate
     * @param int $format
     *
     * @return array
     */
    public static function getFortnightsBetweenDatesByYear($startDate, $endDate, $format = 0) {
        switch ($format) {
            case 0:
                $fortnights = self::getFortnightsBetweenDatesByYear0($startDate, $endDate);
                break;
            case 1:
                $fortnights = self::getFortnightsBetweenDatesByYear1($startDate, $endDate);
                break;
            default:
                $fortnights = self::getFortnightsBetweenDatesByYear0($startDate, $endDate);
        }
        return $fortnights;
    }

    /**
     * Get an array with the fortnights between two dates grouped by years as array[0..n]([year][month][fortnight]([firstDay][lastDay][data]))
     *
     * @param \Datetime $startDate
     * @param \Datetime $endDate
     *
     * @return array[int][mixed]
     */
    private static function getFortnightsBetweenDatesByYear0 ($startDate, $endDate) {
        $startYear  = date('Y', self::timeFromDate($startDate, 0));
        $startMonth = date('n', self::timeFromDate($startDate, 0));
        $endYear    = date('Y', self::timeFromDate($endDate, 0));
        $endMonth   = date('n', self::timeFromDate($endDate, 0));

        $fortnights = array();
        while ( ($startYear < $endYear) || ($startYear == $endYear && $startMonth <= $endMonth) ) {
            $fortnights[] = array(
                'year'      => $startYear,
                'month'     => $startMonth,
                'fortnight' => array(
                    1 => array(
                        'firstDay' => self::firstDayOfMonth($startMonth, $startYear),
                        'lastDay'  => self::dayOfMonth(15, $startMonth, $startYear),
                        'data'     => null
                    ),
                    2 => array(
                        'firstDay' => self::dayOfMonth(16, $startMonth, $startYear),
                        'lastDay'  => self::lastDayOfMonth($startMonth, $startYear),
                        'data'     => null
                    )
                )
            );
            $startMonth++;
            if ($startMonth >= 13) {
                $startMonth = 1;
                $startYear++;
            }
        }

        return $fortnights;
    }

    /**
     * Get an array with the year fortnights between two dates grouped by years as array[0..n]([year]([fortnight]([firstDay][lastDay][data]))
     *
     * @param \Datetime $startDate
     * @param \Datetime $endDate
     *
     * @return array[int][mixed]
     */
    private static function getFortnightsBetweenDatesByYear1($startDate, $endDate) {
        $startYear      = date('Y', self::timeFromDate($startDate, 0));
        $startYearDay   = date('z', self::timeFromDate($startDate, 0));
        $startFortnight = floor($startYearDay/15);
        
        $endYear      = date('Y', self::timeFromDate($endDate, 0));
        $endYearDay   = date('z', self::timeFromDate($endDate, 0));
        $endFortnight = floor($endYearDay/15);

        $fortnights = array();
        while ( ($startYear < $endYear) || ($startYear == $endYear && $startFortnight <= $endFortnight) ) {
            $fortnights[] = array(
                'year'      => $startYear,
                'fortnight' => $startFortnight,
                'firstDay'  => self::dayOfYear( ($startFortnight*15)+1, $startYear),
                'lastDay'   => self::dayOfYear( ($startFortnight+1)*15, $startYear),
                'data'      => null
            );
            $startFortnight++;
            if ($startFortnight >= 25) {
                $startFortnight = 1;
                $startYear++;
            }
        }

        return $fortnights;
    }





    // =============================================================================================
    //                                     Month methods
    // =============================================================================================


    /**
     * Get the first day of a month as string
     *
     * @param int $month
     * @param int $year
     *
     * @return bool|string
     */
    public static function firstDayOfMonthAsString ($month, $year) {
        return date(self::$dateFormat, self::firstDayOfMonthAsTimestamp($month, $year));
    }

    /**
     * Get the first day of a month as timestamp
     *
     * @param int $month
     * @param int $year
     *
     * @return int
     */
    public static function firstDayOfMonthAsTimestamp ($month, $year) {
        return self::firstDayOfMonth($month, $year)->getTimestamp();
    }

    /**
     * Get the first day of a month as datetime object
     *
     * @param int $month
     * @param int $year
     *
     * @return \Datetime
     */
    public static function firstDayOfMonth ($month, $year) {
        return new \Datetime($year.'-'.$month.'-01');
    }

    /**
     * Get the last day of a month as string
     *
     * @param int $month
     * @param int $year
     *
     * @return bool|string
     */
    public static function lastDayOfMonthAsString ($month, $year) {
        return date(self::$dateFormat, self::lastDayOfMonthAsTimestamp($month, $year));
    }

    /**
     * Get the last day of a month as timestamp
     *
     * @param int $month
     * @param int $year
     *
     * @return int
     */
    public static function lastDayOfMonthAsTimestamp ($month, $year) {
        return self::lastDayOfMonth($month, $year)->getTimestamp();
    }

    /**
     * Get the last day of a month as datetime object
     *
     * @param int $month
     * @param int $year
     *
     * @return \Datetime
     */
    public static function lastDayOfMonth ($month, $year) {
        $date = new \Datetime($year.'-'.$month.'-01');
        return $date->modify('last day of this month');
    }

    /**
     * Get a day of a month as string
     *
     * @param int $day
     * @param int $month
     * @param int $year
     *
     * @return bool|string
     */
    public static function dayOfMonthAsString ($day, $month, $year) {
        return date(self::$dateFormat, self::dayOfMonthAsTimestamp($day, $month, $year));
    }

    /**
     * Get a day of a month as timestamp
     *
     * @param int $day
     * @param int $month
     * @param int $year
     *
     * @return int
     */
    public static function dayOfMonthAsTimestamp ($day, $month, $year) {
        return self::dayOfMonth($day, $month, $year)->getTimestamp();
    }

    /**
     * Get a day of a month as datetime object
     *
     * @param int $day
     * @param int $month
     * @param int $year
     *
     * @return \Datetime
     */
    public static function dayOfMonth ($day, $month, $year) {
        return new \Datetime($year.'-'.$month.'-'.$day);
    }

    /**
     * Get a day of a year as datetime object
     *
     * @param int $yearDay
     * @param int $year
     *
     * @return \Datetime
     */
    public static function dayOfYear ($yearDay, $year) {
        $date = new \Datetime($year.'-01-01');
        return $date->modify('+'.($yearDay-1).' day');
    }

    /**
     * Get an array with the months between two dates grouped by years.
     * The array format depends on the $format parameter
     *
     * @param \Datetime $startDate
     * @param \Datetime $endDate
     * @param int $format
     *
     * @return array
     */
    public static function getMonthsBetweenDatesByYear ($startDate, $endDate, $format = 0) {
        $startYear  = date('Y', self::timeFromDate($startDate, 0));
        $startMonth = date('n', self::timeFromDate($startDate, 0));
        $endYear    = date('Y', self::timeFromDate($endDate, 0));
        $endMonth   = date('n', self::timeFromDate($endDate, 0));

        switch ($format) {
            case 0:
                $months = self::getMonthsBetweenDatesByYear0($startYear, $startMonth, $endYear, $endMonth);
                break;
            case 1:
                $months = self::getMonthsBetweenDatesByYear1($startYear, $startMonth, $endYear, $endMonth);
                break;
            case 2:
                $months = self::getMonthsBetweenDatesByYear2($startYear, $startMonth, $endYear, $endMonth);
                break;
            default:
                $months = self::getMonthsBetweenDatesByYear0($startYear, $startMonth, $endYear, $endMonth);
        }
        return $months;
    }

    /**
     * Get an array with the months between two months/years grouped by years as array[year][month]
     *
     * @param int $startYear
     * @param int $startMonth
     * @param int $endYear
     * @param int $endMonth
     *
     * @return array[int][int]
     */
    private static function getMonthsBetweenDatesByYear0 ($startYear, $startMonth, $endYear, $endMonth) {
        $months = array();
        while ( ($startYear < $endYear) || ($startYear == $endYear && $startMonth <= $endMonth) ) {
            $months[$startYear][$startMonth] = null;
            $startMonth++;
            if ($startMonth >= 13) {
                $startMonth = 1;
                $startYear++;
            }
        }
        return $months;
    }

    /**
     * Get an array with the months between two months/years grouped by years as array[year][0..n] = month
     *
     * @param int $startYear
     * @param int $startMonth
     * @param int $endYear
     * @param int $endMonth
     *
     * @return array[int][int]
     */
    private static function getMonthsBetweenDatesByYear1 ($startYear, $startMonth, $endYear, $endMonth) {
        $months = array();
        while ( ($startYear < $endYear) || ($startYear == $endYear && $startMonth <= $endMonth) ) {
            $months[$startYear][] = $startMonth;
            $startMonth++;
            if ($startMonth >= 13) {
                $startMonth = 1;
                $startYear++;
            }
        }
        return $months;
    }

    /**
     * Get an array with the months between two months/years grouped by years as array[0..n]([year][month][firstDay][lastDay][data])
     *
     * @param int $startYear
     * @param int $startMonth
     * @param int $endYear
     * @param int $endMonth
     *
     * @return array[int][mixed]
     */
    private static function getMonthsBetweenDatesByYear2 ($startYear, $startMonth, $endYear, $endMonth) {
        $months = array();
        while ( ($startYear < $endYear) || ($startYear == $endYear && $startMonth <= $endMonth) ) {
            $months[] = array(
                'year'     => $startYear,
                'month'    => $startMonth,
                'firstDay' => self::firstDayOfMonth($startMonth, $startYear),
                'lastDay'  => self::lastDayOfMonth($startMonth, $startYear),
                'data'     => null
            );
            $startMonth++;
            if ($startMonth >= 13) {
                $startMonth = 1;
                $startYear++;
            }
        }
        return $months;
    }





    // =============================================================================================
    //                                     Quarter methods
    // =============================================================================================


    /**
     * Get the year quarter of a date
     *
     * @param \Datetime $date
     *
     * @return int
     */
    public static function dateQuarter ($date) {
        $month =  date('n', self::timeFromDate($date, 0));
        switch ($month) {
            case ($month >= 1 && $month <=3):
                return 1;
                break;
            case ($month >= 4 && $month <=6):
                return 2;
                break;
            case ($month >= 7 && $month <=9):
                return 3;
                break;
            case ($month >= 10 && $month <=12):
                return 4;
                break;
            default:
                return 0;
        }
    }


}