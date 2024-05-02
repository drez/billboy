DROP TABLE IF EXISTS `tmp_breakdown_revenue`;
CREATE TABLE `tmp_breakdown_revenue` (
				SELECT 'Paid' as 'Pos', date_paid as Date, state, DATE_FORMAT(date_paid, '%Y') as 'Year', DATE_FORMAT(date_paid, '%M') as 'Month', DATE_FORMAT(date_paid, '%u') as 'Week', sum(net) as 'Total'
		FROM billing
		WHERE state = 4 OR state = 3 AND type = 1
		GROUP BY DATE_FORMAT(date_paid, '%Y'), DATE_FORMAT(date_paid, '%M'), DATE_FORMAT(date_paid, '%u')
		WITH ROLLUP);
DROP TABLE IF EXISTS `tmp_breakdown_revenue_category`;
CREATE TABLE `tmp_breakdown_revenue_category` (
			SELECT IF(bl.id_billing_category IS NULL, b.id_billing_category, bl.id_billing_category) as 'Category', 
				sum(bl.total) as 'Total'
			FROM billing_line bl
			LEFT JOIN billing b ON (bl.id_billing = b.id_billing)
			GROUP BY IF(bl.id_billing_category IS NULL, b.id_billing_category, bl.id_billing_category)
			WITH ROLLUP
		);
DROP TABLE IF EXISTS `tmp_breakdown_expense`;
CREATE TABLE `tmp_breakdown_expense` (
				SELECT `spend_date` as Date, DATE_FORMAT(`spend_date`, '%Y') as 'Year', DATE_FORMAT(`spend_date`, '%M') as 'Month', DATE_FORMAT(`spend_date`, '%u') as 'Week', sum(total) as 'Total'
		FROM cost_line
		GROUP BY DATE_FORMAT(`spend_date`, '%Y'), DATE_FORMAT(`spend_date`, '%M'), DATE_FORMAT(`spend_date`, '%u')
		WITH ROLLUP
		);