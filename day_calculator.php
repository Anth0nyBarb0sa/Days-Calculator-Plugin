<?php

/**
 * Plugin Name: 1031 Exchange Day Calculator
 * Description: Calculator that calculates the 45th and 180th day after the Date the relinquished property was closed.
 * Version: 1.0
 * Author: Anthony Barbosa
 * Author URI: https://anthonybarbosadevelopment.com/
 * Text Domain: days-calculator-form.php
 * 
 */

function day_calculator_function()
{

    //Return Name of Month
    function getMonth($date)
    {
        switch ($date) {
            case 1:
                $month = 'January';
                break;
            case 2:
                $month = 'Febuary';
                break;
            case 3:
                $month = 'March';
                break;
            case 4:
                $month = 'April';
                break;
            case 5:
                $month = 'May';
                break;
            case 6:
                $month = 'June';
                break;
            case 7:
                $month = 'July';
                break;
            case 8:
                $month = 'August';
                break;
            case 9:
                $month = 'September';
                break;
            case 10:
                $month = 'October';
                break;
            case 11:
                $month = 'November';
                break;
            case 12:
                $month = 'December';
                break;
            default:
                $month = 'Not a valid month!';
                break;
        }
        return $month;
    }

    //Initialize years 1 year behind and 4 years in advance
    $yearCurrent = date('Y', time());
    $yearBefore = $yearCurrent - 1;
    $year1 = $yearCurrent + 1;
    $year2 = $yearCurrent + 2;
    $year3 = $yearCurrent + 3;
    $year4 = $yearCurrent + 4;


    //Initalize results
    $dateTimeMSG = "";
    $fourtyfiveMSG = "";
    $oneeightyMSG = "";
    $dateTime = "";
    $fourtyfive = "";
    $oneeighty = "";
    if (isset($_GET['run'])) {

        //initalize selected date
        $month = $_GET['month'];
        $day = $_GET['day'];
        $year = $_GET['year'];

        //Other
        $seconds = 86400;

        try {
            //Convert to unix timestamp
            $dateTime = new DateTime("{$year}-{$month}-{$day}");
            $dateTime = $dateTime->format('U');

            //Add 45 days
            $fourtyfive = $dateTime + ($seconds * 45);
            //Add 180 days
            $oneeighty = $dateTime + ($seconds * 180);

            //Convert to date time
            function getWeekDay($date)
            {
                $weekday = date('N', $date);
                switch ($weekday) {
                    case 1:
                        $weekday = "Monday";
                        break;
                    case 2:
                        $weekday = "Tuesday";
                        break;
                    case 3:
                        $weekday = "Wednesday";
                        break;
                    case 4:
                        $weekday = "Thursday";
                        break;
                    case 5:
                        $weekday = "Friday";
                        break;
                    case 6:
                        $weekday = "Saturday";
                        break;
                    case 7:
                        $weekday = "Sunday";
                        break;
                    default:
                        $weekday = "Not a valid Day!";
                }
                return $weekday;
            }
            function getDateTime($dateTime)
            {
                $weekday = getWeekDay($dateTime); // 1-7
                $month = getMonth(gmdate("m", $dateTime));
                $day = gmdate("d", $dateTime);
                $year = gmdate("Y", $dateTime);
                $dateTime = "{$weekday}, {$month} {$day}, {$year}";
                return $dateTime;
            }

            $dateTime = getDateTime(($dateTime));
            $fourtyfive = getDateTime(($fourtyfive));
            $oneeighty = getDateTime(($oneeighty));

            //Format to Message
            $dateTimeMSG = "For <strong>{$dateTime}</strong>";
            $fourtyfiveMSG = "Your 45-day Identification Period ends on midnight of: <strong>{$fourtyfive}</strong>";
            $oneeightyMSG = "Your 180-day Identification Period ends on midnight of: <strong>{$oneeighty}</strong>";
            $disclaimer1 = "<strong>Always verify your exchange deadlines with your tax advisor.</strong>";
            $disclaimer2 = "<strong>Notice: </strong>The actual deadline for completing an exchange is the earlier of either 180 days from the date on which the Exchanger transfers the relinquished property, or the due date, including extensions filed by the Exchanger, for the Exchanger's tax return for the year of the transfer of the relinquished property. Consult your tax advisor regarding your tax filing requirement dates.";


        } catch (Exception $e) {
            $dateTimeMSG = "";
            $fourtyfiveMSG = "";
            $oneeightyMSG = "";
            $dateTime = "";
            $fourtyfive = "";
            $oneeighty = "";
            $disclaimer1 = "";
            $disclaimer2 = "";
        }
    }


?>

    <html>

    

    <body>
        <div id="calculator">
            <div>
                <p>Date the relinquished property (sale) was closed:</p>
                <form class="days-form" action="<? $_SERVER['PHP_SELF'] ?>" method="get">
                    <div>
                        <label for="month">Month:</label>
                        <select type="select" name="month" id="month">
                            <option value="<?php echo 1; ?>">January</option>
                            <option value="<?php echo 2; ?>">February</option>
                            <option value="<?php echo 3; ?>">March</option>
                            <option value="<?php echo 4; ?>">April</option>
                            <option value="<?php echo 5; ?>">May</option>
                            <option value="<?php echo 6; ?>">June</option>
                            <option value="<?php echo 7; ?>">July</option>
                            <option value="<?php echo 8; ?>">August</option>
                            <option value="<?php echo 9; ?>">September</option>
                            <option value="<?php echo 10; ?>">October</option>
                            <option value="<?php echo 11; ?>">November</option>
                            <option value="<?php echo 12; ?>">December</option>
                        </select>
                        <script type="text/javascript">
                            document.getElementById('month').value = "<?php echo $_GET['month']; ?>";
                        </script>
                    </div>

                    <div>
                        <label for="day">Day:</label>
                        <select type="select" name="day" id="day">
                            <option value="<?php echo 1; ?>">1</option>
                            <option value="<?php echo 2; ?>">2</option>
                            <option value="<?php echo 3; ?>">3</option>
                            <option value="<?php echo 4; ?>">4</option>
                            <option value="<?php echo 5; ?>">5</option>
                            <option value="<?php echo 6; ?>">6</option>
                            <option value="<?php echo 7; ?>">7</option>
                            <option value="<?php echo 8; ?>">8</option>
                            <option value="<?php echo 9; ?>">9</option>
                            <option value="<?php echo 10; ?>">10</option>
                            <option value="<?php echo 11; ?>">11</option>
                            <option value="<?php echo 12; ?>">12</option>
                            <option value="<?php echo 13; ?>">13</option>
                            <option value="<?php echo 14; ?>">14</option>
                            <option value="<?php echo 15; ?>">15</option>
                            <option value="<?php echo 16; ?>">16</option>
                            <option value="<?php echo 17; ?>">17</option>
                            <option value="<?php echo 18; ?>">18</option>
                            <option value="<?php echo 19; ?>">19</option>
                            <option value="<?php echo 20; ?>">20</option>
                            <option value="<?php echo 21; ?>">21</option>
                            <option value="<?php echo 22; ?>">22</option>
                            <option value="<?php echo 23; ?>">23</option>
                            <option value="<?php echo 24; ?>">24</option>
                            <option value="<?php echo 25; ?>">25</option>
                            <option value="<?php echo 26; ?>">26</option>
                            <option value="<?php echo 27; ?>">27</option>
                            <option value="<?php echo 28; ?>">28</option>
                            <option value="<?php echo 29; ?>">29</option>
                            <option value="<?php echo 30; ?>">30</option>
                            <option value="<?php echo 31; ?>">31</option>
                        </select>
                        <script type="text/javascript">
                            document.getElementById('day').value = "<?php echo $_GET['day']; ?>";
                        </script>
                    </div>

                    <div>
                        <label for="year">Year:</label>
                        <select type="select" name="year" id="year">
                            <option value="<?= $yearBefore ?>"><?= $yearBefore ?></option>
                            <option value="<?= $yearCurrent ?>"><?= $yearCurrent ?></option>
                            <option value="<?= $year1 ?>"><?= $year1 ?></option>
                            <option value="<?= $year2 ?>"><?= $year2 ?></option>
                            <option value="<?= $year3 ?>"><?= $year3 ?></option>
                            <option value="<?= $year4 ?>"><?= $year4 ?></option>
                        </select>
                        <script type="text/javascript">
                            document.getElementById('year').value = "<?php echo $_GET['year']; ?>";
                        </script>
                    </div>

                    <button type="submit" name="run">Submit</button>

                    <div>
                        <p><?= $dateTimeMSG ?></p>
                        <p><?= $fourtyfiveMSG ?></p>
                        <p><?= $oneeightyMSG ?></p>
                        <p><?= $disclaimer1 ?></p>
                        <p><?= $disclaimer2 ?></p>
                    </div>
                </form>

            </div>
        </div>
    </body>

    </html>
<?php
}







// Register a new shortcode: [day_calculator]
add_shortcode('day_calculator', 'day_calculator_shortcode');

// The callback function that will replace [book]
function day_calculator_shortcode()
{
    //ob_start();
    day_calculator_function();
    //return ob_get_clean();
}
