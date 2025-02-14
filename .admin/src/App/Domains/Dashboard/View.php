<?php
namespace App\Domains\Dashboard;

use Psr\Http\Message\ServerRequestInterface as Request;

//use ApiGoat\Views\View;

class View
{

    public $request;
    public $override = false;
    public $args;
    private $entities = [];

    /**
     * Constructor
     *
     * @param Request|null $request
     * @param array|null $args
     */
    function __construct(Request | null $request = null, array | null $args = null)
    {
        $this->override    = true;
        $this->request    = $request;
        $this->args       = $args;
        $this->model_name = 'DashboardView';

        //$this::createBreakdownRevenueTable();
    }
    public function dashboard()
    {

        # Set the range
        $this->args['query']['Date']     = empty($this->args['query']['Date']) ? date('Y-m-d', strtotime("1 Year ago")) : $this->args['query']['Date'];
        $this->args['query']['Interval'] = empty($this->args['query']['Interval']) ? 'Month' : $this->args['query']['Interval'];

        $revenuData    = $this->getRevenuCategoryBreakdown();
        $chartCategory = $this->generateBarChart($revenuData, 'Category', "Income categories", ['borderColor' => '#53B56D', 'backgroundColor' => '#5FD37E']);

        $revenuData      = $this->getQuoteBreakdown('Quot', $this->args['query']['Date'], 'Month');
        $chartMonthQuote = $this->generateLineChart($revenuData, 'Quote', "Monthly Quotes",
            ['Cancelled' => ['borderColor' => '#D33D3D', 'backgroundColor' => '#d45e5e'],
                'New'        => ['borderColor' => '#D1BF23', 'backgroundColor' => '#D3C95F'],
            ]
            , $this->args['query']['Interval']);

        $revenuData       = $this->getRevenuBreakdown('Unpa', $this->args['query']['Date'], 'Month');
        $chartMonthUnpaid = $this->generateBarChart($revenuData[$this->args['query']['Interval']], 'Unpaid ', "Monthly UNPAID revenues (" . \number_format($revenuData['Total'], 0) . "$)", ['borderColor' => '#D33D3D', 'backgroundColor' => '#d45e5e']);

        $revenuData        = $this->getExpenseBreakdown($this->args['query']['Date'], 'Month');
        $chartMonthExpense = $this->generateBarChart($revenuData[$this->args['query']['Interval']], 'Expense', "Monthly expenses (" . \number_format($revenuData['Total'], 0) . "$)", ['borderColor' => '#C15838', 'backgroundColor' => '#D3613D']);

        $revenuData     = $this->getRevenuBreakdown('Open', $this->args['query']['Date'], 'Month');
        $chartMonthOpen = $this->generateBarChart($revenuData[$this->args['query']['Interval']], 'Open', "Monthly OPEN revenues (" . \number_format($revenuData['Total'], 0) . "$)", ['borderColor' => '#3C75D8', 'backgroundColor' => '#5E8AD6']);

        $revenuData = $this->getRevenuBreakdown('Paid', $this->args['query']['Date'], 'Month');
        $chartMonth = $this->generateBarChart($revenuData[$this->args['query']['Interval']], 'Paid', "Monthly PAID revenues (" . \number_format($revenuData['Total'], 0) . "$)");

        //$unpaidData = $this->getUnpaidBreakdown();

        $return['html'] = swheader() .
        button(span(_("Show search")), 'class="trigger-search button-link-blue"')
        . div(
            form(
                div(input('date', 'Date', $this->args['query']['Date'], '  j="date"  placeholder="' . _('Date') . '"', ''), '', "class='ac-search-item'")
                //.div(selectboxCustomArray('Interval', [['Week'], ['Month'], ['Year']], 'Interval' , "v='Interval'  s='d' ", $this->args['query']['Interval'], '', true), '', ' class="ac-search-item "')
                . div(
                    button(span(_("Search")), 'id="msProjectBt" title="' . _('Search') . '" class="icon search"')
                    . button(span(_("Clear")), ' title="' . _('Clear search') . '" id="msProjectBtClear"')
                    . input('hidden', 'Seq')
                    , '', 'class="ac-search-item ac-action-buttons"')
                . div(button(span(_("Refresh")), 'id="msRefresh" title="' . _('Refresh') . '" class="icon refresh"'), '', "class='ac-search-item'")
                ,
                "id='dashboardSearch'"
            )
            ,
            '', "class='msSearchCtnr'"
        )
        . div(
            div(
                $chartCategory['html'] . $chartMonthQuote['html'] . $chartMonthUnpaid['html'] . $chartMonthExpense['html'] . $chartMonthOpen['html'] . $chartMonth['html']
            ),
            '',
            "class='content form' style='padding-bottom:50px;'"
        )
        ;

        $readyJs = <<<JS
/*$("#formMsProject [j='date']").each(function(){
		$(this).datepicker({dateFormat: 'yy-mm-dd ',changeYear: true, changeMonth: true, yearRange: '1940:2040', showOtherMonths: true, selectOtherMonths: true});
});*/
$('.msSearchCtnr .js-select-label').SelectBox();
$('#msRefresh').click(()=>{
	$.post(_SITE_URL+'RefreshStats', {}, ()=>{}, 'json');
});
JS;

        $return['onReadyJs'] = $readyJs. $chartCategory['onReadyJs'] . $chartMonth['onReadyJs'] . $chartMonthOpen['onReadyJs'] . $chartMonthExpense['onReadyJs'] . $chartMonthUnpaid['onReadyJs'] . $chartMonthQuote['onReadyJs'];
        return $return;
    }

    private function generateLineChart(array $data, $name, $chartName = "", $options = ['borderColor' => '#00c4a7', 'backgroundColor' => '#3DDBC3'], $Interval = 'Month')
    {

        foreach ($data as $state => $datapoint) {
            if ($state == 'labels') {
                $labels = $datapoint;
            } elseif ($state != 'total') {
                $datasets .= "{
					label: '{$state} Quotes values (" . number_format($data['total'][$state], 0) . "$)',
					data: " . json_encode($datapoint, true) . ",
					borderColor:  '" . $options[$state]['borderColor'] . "',
					backgroundColor: '" . $options[$state]['backgroundColor'] . "',
				},";
            }
        }

        $labelsData = json_encode($labels, true);

        $out['onReadyJs'] = <<<JS
ctx = document.getElementById('{$name}Chart');

new Chart(ctx, {
	type: 'line',
	data: {
		labels: {$labelsData},
		datasets: [{$datasets}]
	},
	options: {
		scales: {
			y: {
				beginAtZero: true
			}
		}
	}
});


JS;
        $out['html'] = div("<canvas id='" . $name . "Chart' class='dashboardChart'></canvas>");
        return $out;
    }

    private function generateBarChart($data, $name, $chartName = "", $options = ['borderColor' => '#00c4a7', 'backgroundColor' => '#3DDBC3'])
    {

        $labels = json_encode($data['key']);
        $data   = json_encode($data['data']);

        $out['onReadyJs'] = <<<JS
ctx = document.getElementById('{$name}Chart');

new Chart(ctx, {
	type: 'bar',
	data: {
		labels: {$labels},
		datasets: [{
			label: '{$chartName}',
			data: {$data},
			borderWidth: 1,
			borderColor: '{$options['borderColor']}',
			backgroundColor: '{$options['backgroundColor']}',
		}]
	},
	options: {
		scales: {
			y: {
				beginAtZero: true
			}
		}
    }
}
);
JS;
        $out['html'] = div("<canvas id='" . $name . "Chart' class='dashboardChart'></canvas>");
        return $out;
    }

    private function getQuoteBreakdown($pos = 'Quot', $startdate, $interval = 'Month')
    {
        $enddate = date('Y-m-d', strtotime("next year", strtotime($startdate)));

        $beakD = [];
        #new
        $sql = "SELECT * FROM `tmp_breakdown_revenue`
				WHERE `Pos` = '$pos' AND `Date` > '$startdate' AND `Date` < '$enddate'
				AND `Month` is not null and `Week` is null
				AND `state` IN (0,1,2,7)
				ORDER BY `Date` ASC";

        $conn = \Propel::getConnection(_DATA_SRC);
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $quotes['New'] = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        #cancelled
        $sql = "SELECT * FROM `tmp_breakdown_revenue`
				WHERE `Pos` = '$pos' AND `Date` > '$startdate' AND `Date` < '$enddate'
				AND `Month` is not null and `Week` is null
				AND `state` IN (5,6)
				ORDER BY `Date` ASC";

        $conn = \Propel::getConnection(_DATA_SRC);
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $quotes['Cancelled'] = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($quotes as $state => $data) {
            $next              = 0;
            $beakD             = [];
            $dataset['labels'] = [];
            $total             = 0;
            for ($i = 1; $i < 13; $i++) {
                $date  = strtotime("+$i month ", strtotime($startdate));
                $year  = date('Y', $date);
                $month = date('F', $date);
                $week  = date('W', $date);
                $sum   = $data[$next];

                if (! empty($sum['Year']) && $sum['Year'] == $year && ! empty($sum['Month'])) {

                    if (! empty($sum['Month']) && $sum['Month'] == $month && empty($sum['Week'])) {
                        $beakD[] = $sum['Total'];
                        $next++;
                        $total += $sum['Total'];
                    } else {
                        $beakD[] = 0;
                    }

                } else {

                    $beakD[] = 0;
                }
                $dataset['labels'][] = $year . ' / ' . $month;
            }
            $dataset[$state]          = $beakD;
            $dataset['total'][$state] = $total;

        }

        return $dataset;
    }

    private function getRevenuCategoryBreakdown()
    {
        $beakD = [];
        $sql   = "SELECT t.*, bc.name FROM `tmp_breakdown_revenue_category` t
		LEFT JOIN billing_category bc ON (Category = bc.id_billing_category)";

        $conn = \Propel::getConnection(_DATA_SRC);
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $data     = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $rowCount = $stmt->rowCount();
        $total    = $data[$rowCount - 1]['Total'];

        $count = 1;
        foreach ($data as $entry) {
            if ($count != $rowCount) {
                $beakD['key'][]  = ((! empty($entry['name'])) ? $entry['name'] : "Uncategorized") . " " . number_format($entry['Total'] / $total * 100, 0) . "%";
                $beakD['data'][] = $entry['Total'];
                $count++;
            }

        }

        return $beakD;
    }

    private function getExpenseBreakdown($startdate, $interval = 'Month')
    {
        $enddate = date('Y-m-d', strtotime("next year", strtotime($startdate)));

        $beakD = [];
        $sql   = "SELECT * FROM `tmp_breakdown_expense`
						WHERE  `Date` > '$startdate' AND `Date` < '$enddate'
						AND `Month` is not null and `Week` is null
						ORDER BY `Date` ASC";

        $conn = \Propel::getConnection(_DATA_SRC);
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $next = 0;
        for ($i = 1; $i < 13; $i++) {
            $date  = strtotime("+$i month ", strtotime($startdate));
            $year  = date('Y', $date);
            $month = date('F', $date);
            $sum   = $data[$next];

            if (! empty($sum['Year']) && $sum['Year'] == $year && ! empty($sum['Month'])) {
                $beakD['Month']['key'][] = $year . ' / ' . $month;

                if (! empty($sum['Month']) && $sum['Month'] == $month && empty($sum['Week'])) {
                    $beakD['Month']['data'][] = $sum['Total'];
                    $beakD['Total'] += $sum['Total'];
                    $next++;
                } else {
                    $beakD['Month']['data'][] = 0;
                }

            } elseif (! empty($sum['Year']) && empty($sum['Month'])) {
                $beakD['Year']['key'][]  = $sum['Year'];
                $beakD['Year']['data'][] = $sum['Total'];
                $next++;

            } else {
                $beakD['Month']['key'][]  = $year . ' / ' . $month;
                $beakD['Month']['data'][] = 0;
            }
        }

        return $beakD;
    }

    private function getRevenuBreakdown($pos = 'Open', $startdate, $interval = 'Month')
    {
        $enddate = date('Y-m-d', strtotime("next year", strtotime($startdate)));

        $beakD = [];

        $totals = $this->getRevenuTotal($pos, $startdate);
        $beakD['Year']['key'][]  = "...";
        $beakD['Year']['data'][] = $totals;
        $beakD['Month']['key'][]  = "...";
        $beakD['Month']['data'][] = $totals;
        
        $sql   = "SELECT * FROM `tmp_breakdown_revenue`
						WHERE `Pos` = '$pos' AND `Date` > '$startdate' AND `Date` < '$enddate'
						AND `Month` is not null and `Week` is null
						ORDER BY `Date` ASC";

        $conn = \Propel::getConnection(_DATA_SRC);
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        
        $next = 0;

        for ($i = 0; $i < 12; $i++) {
            $date  = strtotime("+$i month ", strtotime($startdate));
            $year  = date('Y', $date);
            $month = date('F', $date);

            $sum = $data[$next];

            if (! empty($sum['Year']) && $sum['Year'] == $year && ! empty($sum['Month'])) {
                $beakD['Month']['key'][] = $year . ' / ' . $month;

                if (! empty($sum['Month']) && $sum['Month'] == $month && empty($sum['Week'])) {
                    $beakD['Month']['data'][] = $sum['Total'];
                    $beakD['Total'] += $sum['Total'];
                    $next++;
                } else {
                    $beakD['Month']['data'][] = 0;
                }

            } elseif (! empty($sum['Year']) && empty($sum['Month'])) {
                $beakD['Year']['key'][]  = $sum['Year'];
                $beakD['Year']['data'][] = $sum['Total'];
                $next++;

            } else {
                $beakD['Month']['key'][]  = $year . ' / ' . $month;
                $beakD['Month']['data'][] = 0;
            }
        }

        

        return $beakD;
    }

    private function getRevenuTotal($pos, $startdate){
        $sql   = "SELECT  SUM(`Total`) as 'all' FROM `tmp_breakdown_revenue`
						WHERE `Pos` = '$pos' AND `Date` < '$startdate'
						AND `Month` is not null and `Week` is null
						";

        $conn = \Propel::getConnection(_DATA_SRC);
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        //print_r($data);
        return $data[0]['all'];
    }

    /**
     * createBreakdownRevenueTable
     * Cron run function
     *
     * @return void
     */
    public static function createBreakdownRevenueTable()
    {
        $conn = \Propel::getConnection(_DATA_SRC);

        $sql  = "DROP TABLE IF EXISTS `tmp_breakdown_revenue`";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $sql = "CREATE TABLE `tmp_breakdown_revenue` (
  `Pos` varchar(4) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `Date` date DEFAULT NULL COMMENT 'Paid date',
  `state` tinyint(4) DEFAULT NULL COMMENT 'State',
  `Year` varchar(4) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `Month` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `Week` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `Total` decimal(30,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $sql = "INSERT INTO `tmp_breakdown_revenue` (
				SELECT 'Paid' as 'Pos', date_paid as Date, state, DATE_FORMAT(date_paid, '%Y') as 'Year', DATE_FORMAT(date_paid, '%M') as 'Month', DATE_FORMAT(date_paid, '%u') as 'Week', sum(net) as 'Total'
		FROM billing
		WHERE (state = 4 OR state = 3) AND type = 1
		GROUP BY DATE_FORMAT(date_paid, '%Y'), DATE_FORMAT(date_paid, '%M'), DATE_FORMAT(date_paid, '%u')
		WITH ROLLUP);";

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $sql = "INSERT INTO `tmp_breakdown_revenue` (SELECT 'Open' as 'Pos', `date` as Date, state, DATE_FORMAT(`date`, '%Y') as 'Year', DATE_FORMAT(`date`, '%M') as 'Month', DATE_FORMAT(`date`, '%u') as 'Week', sum(gross) as 'Total'
		FROM billing
		WHERE (state = 0 OR state = 1 OR state = 6) AND type = 1
		GROUP BY state, DATE_FORMAT(`date`, '%Y'), DATE_FORMAT(`date`, '%M'), DATE_FORMAT(`date`, '%u')
		WITH ROLLUP)";

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $sql = "INSERT INTO `tmp_breakdown_revenue` ( SELECT 'Unpa' as 'Pos', date_due as Date, state, DATE_FORMAT(date_due, '%Y') as 'Year', DATE_FORMAT(date_due, '%M') as 'Month', DATE_FORMAT(date_due, '%u') as 'Week', sum(gross) as 'Total'
		FROM billing
		WHERE state = 2 AND type = 1
		GROUP BY state, DATE_FORMAT(date_due, '%Y'), DATE_FORMAT(date_due, '%M'), DATE_FORMAT(date_due, '%u')
		WITH ROLLUP)";

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        # Quote
        $sql = "INSERT INTO `tmp_breakdown_revenue` ( SELECT 'Quot' as 'Pos', `date` as Date, state, DATE_FORMAT(`date`, '%Y') as 'Year', DATE_FORMAT(`date`, '%M') as 'Month', DATE_FORMAT(`date`, '%u') as 'Week', sum(gross) as 'Total'
		FROM billing
		WHERE type = 0
		GROUP BY state, DATE_FORMAT(`date`, '%Y'), DATE_FORMAT(`date`, '%M'), DATE_FORMAT(`date`, '%u')
		WITH ROLLUP)";

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $sql  = "INSERT INTO `tmp_breakdown_revenue`  (`Pos`, `Date`, `state`, `Year`, `Month`, `Week`, `Total`) VALUES ('Time', now(), 0, NULL, NULL, NULL, NULL);";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $sql  = "DROP TABLE IF EXISTS `tmp_breakdown_revenue_category`";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $sql = "CREATE TABLE `tmp_breakdown_revenue_category` (
			SELECT IF(bl.id_billing_category IS NULL, b.id_billing_category, bl.id_billing_category) as 'Category',
				sum(bl.total) as 'Total'
			FROM billing_line bl
			LEFT JOIN billing b ON (bl.id_billing = b.id_billing)
			GROUP BY IF(bl.id_billing_category IS NULL, b.id_billing_category, bl.id_billing_category)
			WITH ROLLUP
		);";

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $sql  = "DROP TABLE IF EXISTS `tmp_breakdown_expense`";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $sql = "CREATE TABLE `tmp_breakdown_expense` (
				SELECT `spend_date` as Date, DATE_FORMAT(`spend_date`, '%Y') as 'Year', DATE_FORMAT(`spend_date`, '%M') as 'Month', DATE_FORMAT(`spend_date`, '%u') as 'Week', sum(total) as 'Total'
		FROM cost_line
		GROUP BY DATE_FORMAT(`spend_date`, '%Y'), DATE_FORMAT(`spend_date`, '%M'), DATE_FORMAT(`spend_date`, '%u')
		WITH ROLLUP
		);";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }

}
