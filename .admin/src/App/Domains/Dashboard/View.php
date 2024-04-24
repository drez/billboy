<?php

namespace App\Domains\Dashboard;

use Psr\Http\Message\ServerRequestInterface as Request;
//use ApiGoat\Views\View;

class View
{
	
	public $request;
	public $args;
	private $entities = [];

	/**
	 * Constructor
	 *
	 * @param Request|null $request
	 * @param array|null $args
	 */
	function __construct(Request|null $request=null, array|null $args=null)
	{
		$this->request = $request;
		$this->args = $args;
		$this->model_name = 'DashboardView';
	}
	public function dashboard()
	{

		# Set the range
		$this->args['query']['Date'] = empty($this->args['query']['Date']) ?date('Y-m-d', strtotime("1 Year ago")): $this->args['query']['Date'];
		$this->args['query']['Interval'] = empty($this->args['query']['Interval']) ?'Month': $this->args['query']['Interval'];
		

		$revenuData = $this->getQuoteBreakdown('Quot', $this->args['query']['Date'], 'Month');
		$chartMonthQuote = $this->generateLineChart($revenuData, 'Quote', "Monthly Quotes", 
			['Cancelled'=>['borderColor' => '#D33D3D', 'backgroundColor' => '#d45e5e'],
			'New'=>['borderColor' => '#D1BF23', 'backgroundColor' => '#D3C95F']
			]
			, $this->args['query']['Interval']);
		
		$revenuData = $this->getRevenuBreakdown('Unpa', $this->args['query']['Date'], 'Month');
		$chartMonthUnpaid = $this->generateBarChart($revenuData[$this->args['query']['Interval']], 'Unpaid', "Monthly UNPAID revenues",['borderColor' => '#D33D3D', 'backgroundColor' => '#d45e5e']);
		
		$revenuData = $this->getRevenuBreakdown('Open', $this->args['query']['Date'], 'Month');
		$chartMonthOpen = $this->generateBarChart($revenuData[$this->args['query']['Interval']], 'Open', "Monthly OPEN revenues", ['borderColor' => '#3C75D8', 'backgroundColor' => '#5E8AD6']);

		$revenuData = $this->getRevenuBreakdown('Paid', $this->args['query']['Date'], 'Month');
		$chartMonth = $this->generateBarChart($revenuData[$this->args['query']['Interval']], 'Paid', "Monthly PAID revenues");
		

		//$unpaidData = $this->getUnpaidBreakdown();

		$return['html'] = swheader() .
			button(span(_("Show search")),'class="trigger-search button-link-blue"')
			.div(
				form(
					div(input('text', 'Date', $this->args['query']['Date'], '  j="date"  placeholder="' . _('Date') . '"', ''), '', "class='ac-search-item'")
					//.div(selectboxCustomArray('Interval', [['Week'], ['Month'], ['Year']], 'Interval' , "v='Interval'  s='d' ", $this->args['query']['Interval'], '', true), '', ' class="ac-search-item "')
					.div(
						button(span(_("Search")),'id="msProjectBt" title="'._('Search').'" class="icon search"')
						.button(span(_("Clear")),' title="'._('Clear search').'" id="msProjectBtClear"')
						.input('hidden', 'Seq')
					,'','class="ac-search-item ac-action-buttons"')
					,
					"id='dashboardSearch'"
				)
				,
				'',"class='msSearchCtnr'"
				)
				. div(
					div(
						$chartMonthQuote['html'] . $chartMonth['html'] . $chartMonthOpen['html'] . $chartMonthUnpaid['html']
					),
					'',
					"class='content form' style='padding-bottom:50px;'"
				)
			;

		$readyJs = <<<JS
$("#formMsProject [j='date']").each(function(){
		$(this).datepicker({dateFormat: 'yy-mm-dd ',changeYear: true, changeMonth: true, yearRange: '1940:2040', showOtherMonths: true, selectOtherMonths: true});
});
$('.msSearchCtnr .js-select-label').SelectBox();
JS;
		
		$return['onReadyJs'] = $chartMonth['onReadyJs'].$chartMonthOpen['onReadyJs'].$chartMonthUnpaid['onReadyJs'].$chartMonthQuote['onReadyJs'].$readyJs;
		return $return;
	}

	private function generateLineChart(array $data, $name, $chartName="", $options=['borderColor' => '#00c4a7', 'backgroundColor' => '#3DDBC3'], $Interval = 'Month')
	{

		foreach($data as $state => $datapoint){
			if ($state == 'labels') {
				$labels = $datapoint;
			} else {	
				$datasets .= "{
					label: '{$state} Quotes values',
					data: ".json_encode($datapoint, true).",
					borderColor:  '".$options[$state]['borderColor']."',
					backgroundColor: '".$options[$state]['backgroundColor']."',
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
		$out['html'] = div("<canvas id='".$name."Chart' class='dashboardChart'></canvas>");
		return $out;
	}

	private function generateBarChart($data, $name, $chartName="", $options=['borderColor' => '#00c4a7', 'backgroundColor' => '#3DDBC3'])
	{

			$labels = json_encode($data['key']);
			$data = json_encode($data['data']);

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
});
JS;
		$out['html'] = div("<canvas id='".$name."Chart' class='dashboardChart'></canvas>");
		return $out;
	}

	private function getQuoteBreakdown($pos = 'Quot', $startdate, $interval = 'Month'){
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

		
		foreach($quotes as $state => $data){
			$next = 0;
			$beakD = [];
			$dataset['labels'] = [];
			for($i=1; $i<13; $i++){
				$date = strtotime("+$i month ", strtotime($startdate));
				$year = date('Y', $date);
				$month = date('F', $date);
				$week = date('W', $date);
				$sum = $data[$next];
				
				if (!empty($sum['Year']) && $sum['Year'] == $year && !empty($sum['Month'])) {
						
						if (!empty($sum['Month']) && $sum['Month'] == $month && empty($sum['Week'])) {
							$beakD[] = $sum['Total'];
							$next++;     
						}else{
							$beakD[] = 0;
						}

				} else {

					$beakD[] = 0;
				}
				$dataset['labels'][] = $year . ' / ' . $month;
			}
			$dataset[$state] = $beakD;
			
		}

		return $dataset;
	}
	private function getRevenuBreakdown($pos = 'Open', $startdate, $interval = 'Month')
	{
		$enddate = date('Y-m-d', strtotime("next year", strtotime($startdate)));

		$beakD = [];
		$sql = "SELECT * FROM `tmp_breakdown_revenue` 
						WHERE `Pos` = '$pos' AND `Date` > '$startdate' AND `Date` < '$enddate' 
						AND `Month` is not null and `Week` is null
						ORDER BY `Date` ASC";

		$conn = \Propel::getConnection(_DATA_SRC);
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		$next = 0;
		for($i=1; $i<13; $i++){
			$date = strtotime("+$i month ", strtotime($startdate));
			$year = date('Y', $date);
			$month = date('F', $date);
			$week = date('W', $date);
			$sum = $data[$next];
		//echo $year . " / ".$month. " / ".$week."\r\n";

			if (!empty($sum['Year']) && $sum['Year'] == $year && !empty($sum['Month'])) {
					$beakD['Month']['key'][] = $year . ' / ' . $month;
					
					if (!empty($sum['Month']) && $sum['Month'] == $month && empty($sum['Week'])) {
						$beakD['Month']['data'][] = $sum['Total'];
						$next++;     
					}else{
						$beakD['Month']['data'][] = 0;
					}

			}elseif(!empty($sum['Year']) && empty($sum['Month'])){
				$beakD['Year']['key'][] = $sum['Year'];
				$beakD['Year']['data'][] = $sum['Total'];
				$next++;
				
			} else {
				$beakD['Month']['key'][] = $year . ' / ' . $month;
				$beakD['Month']['data'][] = 0;
			}
		}
		//}

		return $beakD;
	}

/* private function getIntervalData($interval, $startdate)
{
	if ($interval == 'Month') {
		foreach($i=0;$i<12;$i++){
			$data['Month'][date('Y/M', strtotime("+$i month ", $startdate))] = 0;
			$data['Month'][date('Y/M', strtotime("+$i month ", $startdate))] = 0;
		}
	} else {
		
	}
}*/
	
	/**
			* createBreakdownRevenueTable
			* Cron run function
			*
			* @return void
			*/
	static public function createBreakdownRevenueTable()
	{
		$conn = \Propel::getConnection(_DATA_SRC);

		$sql = "DROP TABLE IF EXISTS `tmp_breakdown_revenue`";
		$stmt = $conn->prepare($sql);
		$stmt->execute();

		$sql = "CREATE TABLE `tmp_breakdown_revenue` (
				SELECT 'Paid' as 'Pos', date_paid as Date, state, DATE_FORMAT(date_paid, '%Y') as 'Year', DATE_FORMAT(date_paid, '%M') as 'Month', DATE_FORMAT(date_paid, '%u') as 'Week', sum(net) as 'Total'
		FROM billing
		WHERE state = 4 OR state = 3 AND type = 1
		GROUP BY DATE_FORMAT(date_paid, '%Y'), DATE_FORMAT(date_paid, '%M'), DATE_FORMAT(date_paid, '%u')
		WITH ROLLUP);";

		$stmt = $conn->prepare($sql);
		$stmt->execute();

		$sql = "INSERT INTO `tmp_breakdown_revenue` (SELECT 'Open' as 'Pos', `date` as Date, state, DATE_FORMAT(`date`, '%Y') as 'Year', DATE_FORMAT(`date`, '%M') as 'Month', DATE_FORMAT(`date`, '%u') as 'Week', sum(gross) as 'Total'
		FROM billing
		WHERE state = 0 OR state = 1 OR state = 6 AND type = 1
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

		$sql = "INSERT INTO `tmp_breakdown_revenue`  (`Pos`, `Date`, `state`, `Year`, `Month`, `Week`, `Total`) VALUES ('Time', now(), NULL, NULL, NULL, NULL, NULL);";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
	}
		
}
