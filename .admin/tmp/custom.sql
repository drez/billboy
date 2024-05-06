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

INSERT INTO `config` (`id_config`, `category`, `config`, `value`, `system`, `description`, `type`, `date_creation`, `date_modification`, `id_group_creation`, `id_creation`, `id_modification`) VALUES
(17, 2, 'billing_default_unit_amount', '55.00', NULL, 'Amount by default in Billing', NULL, '2024-04-26 10:23:47', '2024-04-26 10:38:04', 2, 2, 2),
(18, 0, 'billing_tax_1', '0', NULL, '', NULL, '2024-05-02 05:37:45', '2024-05-02 05:45:03', 2, 2, 2);

INSERT INTO `authy` (`id_authy`, `validation_key`, `username`, `fullname`, `email`, `passwd_hash`, `expire`, `deactivate`, `is_root`, `id_authy_group`, `is_system`, `rights_all`, `rights_group`, `rights_owner`, `onglet`, `date_creation`, `date_modification`, `id_group_creation`, `id_creation`, `id_modification`) VALUES
(1, NULL, 'apigoat', NULL, 'info@apigoat.com', 'edf0930e4268ba35a05424729f78d305', NULL, 1, 0, 2, 1, NULL, NULL, NULL, NULL, '2023-12-02 08:56:35', NULL, NULL, NULL, NULL);
