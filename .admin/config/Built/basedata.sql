




            -- Default groups
INSERT IGNORE INTO `authy_group` (`id_authy_group`, `name`, `desc`, `default_group`, `admin`, `date_creation`, `date_modification`, `id_group_creation`, `id_creation`, `id_modification`) VALUES
(1, 'User', NULL, 1, 0, '2020-07-15 20:20:19', '2020-07-15 20:20:19', NULL, NULL, NULL),
(2, 'Admin', NULL, 0, 1, '2020-07-15 20:20:24', '2020-07-15 20:20:24', NULL, NULL, NULL);

            -- API settings
INSERT INTO `config` (`id_config`, `id_creation`, `id_modification`, `date_creation`, `date_modification`, `category`, `config`, `value`, `system`, `description`, `type`, `id_group_creation`) VALUES
(1, NULL, NULL, '0000-00-00 00:00:00', '2024-05-06 03:10:08', 0, 'app_status', 'dev', 0, 'Set dev or prod. It will deactivate debug log and set the RBAC to default Deny.', 'string', 2),
(2, NULL, NULL, '0000-00-00 00:00:00', '2024-05-06 03:10:08', 0, 'app_name', 'BillBoy', 0, 'Sets the title.', 'string', 2),
(12, NULL, NULL, '0000-00-00 00:00:00', '2024-05-06 03:10:08', 1, 'vendor_logo', '/public/img/icon.png', 0, 'The url of the vendor small logo icon.', 'string', 2),
(13, NULL, NULL, '0000-00-00 00:00:00', '2024-05-06 03:10:08', 1, 'vendor_logo_login', '/public/img/icon.png', 0, 'The url of the vendor logo.', 'string', 2),
(14, NULL, NULL, '0000-00-00 00:00:00', '2024-05-06 03:10:08', 1, 'vendor_url', 'https://apigoat.com', 0, 'The url for the logo link.', 'string', 2),
(15, NULL, NULL, '2020-08-26 07:56:30', '2024-05-06 03:10:08', 2, 'app_max_per_page', '50', NULL, 'Define the number of item to display per page.', NULL, 2),
(16, NULL, NULL, '2020-08-26 07:57:01', '2024-05-06 03:10:08', 2, 'app_child_max_per_page', '25', NULL, 'Define the number of item to display per page in Child lists.', NULL, 2);

            -- API settings
INSERT INTO `config` (`id_config`, `id_creation`, `id_modification`, `date_creation`, `date_modification`, `category`, `config`, `value`, `system`, `description`, `type`, `id_group_creation`) VALUES
(3, NULL, NULL, '0000-00-00 00:00:00', '2024-05-06 03:10:08', 1, 'api_ips', '[\"192.168.0.10\"]', 0, 'Sets the ip address(es) allowed to access the API. Affect the CORS.', 'json_array', 2),
(4, NULL, NULL, '0000-00-00 00:00:00', '2024-05-06 03:10:08', 0, 'email_host', 'localhost', 0, '', 'string', 2),
(5, NULL, NULL, '0000-00-00 00:00:00', '2024-05-06 03:10:08', 0, 'email_username', '', 0, '', 'string', NULL),
(6, NULL, NULL, '0000-00-00 00:00:00', '2024-05-06 03:10:08', 0, 'email_password', '', 0, '', 'string', NULL),
(7, NULL, NULL, '0000-00-00 00:00:00', '2024-05-06 03:10:08', 0, 'email_port', '', 0, '', 'string', 2),
(8, NULL, NULL, '0000-00-00 00:00:00', '2024-05-06 03:10:08', 0, 'email_protocol', 'SMTPS', 0, 'One of \"STARTTLS, SMTPS, SMTP\"', 'string', NULL),
(9, NULL, NULL, '0000-00-00 00:00:00', '2024-05-06 03:10:08', 0, 'email_from', 'goatcheese@apigoat.com', 0, '', 'string', 2),
(10, NULL, NULL, '0000-00-00 00:00:00', '2024-05-06 03:10:08', 1, 'app_gui_url', 'http://localhost:3000/', 0, 'The url where resides you GUI app ending with slash (/).', 'string', 2);

-- Base API Rbac rules
INSERT INTO `api_rbac` (`id_api_rbac`, `model`, `action`, `body`, `query`, `method`, `scope`, `rule`, `date_creation`, `date_modification`, `id_group_creation`, `id_creation`, `id_modification`) VALUES
(1, 'ApiGoat', 'sendEmail', '{\"Email\":\"*\",\"TemplateName\":\"*\"}', '', 1, 1, 0, '2020-07-23 07:26:30', '2020-07-23 07:26:46', NULL, NULL, NULL),
(2, 'Authy', 'create', '{\"Username\":\"*\",\"Fullname\":\"*\",\"PasswdHash\":\"*\",\"Email\":\"*\",\"IsRoot\":\"*\",\"Expire\":\"*\",\"Deactivate\":\"*\"}', '', 1, 1, 0, '2020-07-23 09:37:11', '2020-07-27 13:01:17', NULL, NULL, NULL),
(3, 'Authy', 'auth', '{\"u\":\"*\",\"pw\":\"*\"}', '', 1, 1, 0, '2020-07-24 09:51:13', '2020-07-25 09:18:54', NULL, NULL, NULL),
(23, 'Authy', 'list', '{
    \"Query\": {
        \"select\": [
            \"IdAuthy\",
            \"ValidationKey\",
            \"Username\",
            \"PasswdHash\",
            \"Language\"
        ],
        \"table\": \"Authy\",
        \"limit\": 1
    },
    \"filter\": {
        \"Authy\": [
            [
                \"Username\",
                \"*\"
            ]
        ]
    },
    \"debug\": \"*\"
}', '', 1, 1, 0, '2020-07-27 13:19:41', '2020-07-27 13:19:48', NULL, NULL, NULL),
(49, 'Authy', 'list', NULL, NULL, 0, 0, 0, '2020-08-02 05:03:05', '2020-08-02 05:03:05', NULL, NULL, NULL),
(85, 'Authy', 'list', '{
    \"Query\": {
        \"select\": [
            \"ValidationKey\",
            \"IdAuthy\",
            \"Email\"
        ],
        \"filter\": {
            \"Authy\": [
                [
                    \"ValidationKey\",
                    \"*\"
                ]
            ]
        },
        \"table\": \"Authy\",
        \"limit\": 1
    },
    \"debug\": \"*\"
}', '', 1, 1, 0, '2020-08-04 12:36:57', '2020-08-04 12:37:08', NULL, NULL, NULL),
(86, 'Authy', 'create', '{
    \"Email\": \"*\",
    \"PasswdHash\": \"*\",
    \"IdAuthyGroup\": \"*\",
    \"ValidationKey\": \"*\"
}', '', 1, 1, 0, '2020-08-04 12:38:24', '2020-08-04 12:38:44', NULL, NULL, NULL),
(87, 'ApiGoat', 'sendEmail', '{
    \"Email\": \"*\",
    \"TemplateName\": \"*\",
    \"debug\": \"*\"
}', '', 1, 1, 0, '2020-08-04 12:38:54', '2020-08-04 12:39:37', NULL, NULL, NULL);

-- Default template
INSERT IGNORE INTO `template` (`id_template`, `name`, `status`, `subject`, `body`, `date_creation`, `date_modification`, `id_group_creation`, `id_creation`, `id_modification`) VALUES
(1, 'Forgotten password email', 0, 'Forgotten password request from APIgoat', '<p>Please <a href=\"[Utils-GuiUrl][Authy-ValidationKey]\">click here</a> to change your password or use this link:&nbsp;[Utils-Url][Authy-ValidationKey]</p>
', '2020-07-22 07:58:29', '2020-07-23 07:41:20', NULL, NULL, NULL),
(2, 'Confirm your email', 0, 'Confirm your APIgoat registration email', '<p>Hi!</p>

<p>Welcome to APIgoat! We hope ypou will enjoy creating new App easily.</p>

<p><a href=\"[Utils-GuiUrl]confirm?validationKey=[Authy-ValidationKey]\">Please click here to confirm your email.</a></p>

<p>If you have any problems, do not hesitate to contact us at beta@apigoat.com</p>

<p>The APIgoat team.</p>
', '2020-08-02 05:35:04', '2020-08-04 12:40:56', NULL, NULL, NULL),
(5, 'ApiGoat header', 'print_billing_header', '', '', '', 0, '<table border=\"0\" cellpadding=\"1\" cellspacing=\"10\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td><img alt=\"\" src=\".admin/public/img/logo-admin.png\" /><img alt=\"\" src=\"/.admin/public/img/logo-admin.png\" /><img alt=\"\" src=\"https://gc.local/myproject1/.admin/public/img/logo-admin.png\" style=\"height:168px; width:375px\" /></td>\r\n			<td style=\"text-align:right; width:30%\">\r\n			<p>ApiGoat Inc.<br />\r\n			121 Legazpi Str., Makati<br />\r\n			Manila, Philippines, 1228</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', '2024-05-08 12:55:53', '2024-05-08 12:58:31', 2, 2, 2);

INSERT INTO `message` (`id_message`, `label`) VALUES
(1, 'delete_row_confirm_msg'),
(2, 'authy_email_required'),
(3, 'client_phone_required'),
(4, 'supplier_phone_required'),
(5, 'CostLine_Title_required'),
(6, 'client_name_required'),
(7, 'client_country_required'),
(8, 'supplier_name_required'),
(9, 'supplier_country_required'),
(10, 'authy_email_required'),
(11, 'authy_password_required'),
(12, 'name_required'),
(13, 'Config_Config_required'),
(14, 'Template_Name_required'),
(15, 'CostLine_Title_required'),
(16, 'project_name__required');

INSERT INTO `message_i18n` (`id_message`, `locale`, `text`, `date_creation`, `date_modification`, `id_group_creation`, `id_creation`, `id_modification`) VALUES
(1, 'en_US', 'Are you sure you want to delete this item?', '2024-05-06 06:19:18', '2024-05-06 06:19:18', 2, 2, 2),
(1, 'fr_CA', NULL, '2024-05-06 06:19:18', '2024-05-06 06:19:18', 2, 2, 2),
(2, 'en_US', 'The email is required.', '2024-02-29 19:42:34', '2024-05-08 13:30:39', 2, 1, 1),
(2, 'fr_CA', NULL, '2024-02-29 19:42:34', '2024-05-08 13:30:39', 2, 1, 1),
(3, 'en_US', 'The phone number is required.', '2024-03-17 22:28:05', '2024-05-08 13:31:01', 2, 2, 2),
(3, 'fr_CA', NULL, '2024-03-17 22:28:05', '2024-05-08 13:31:01', 2, 2, 2),
(4, 'en_US', 'The phone number is required.', '2024-05-01 13:18:03', '2024-05-08 13:30:29', 2, 2, 2),
(4, 'fr_CA', NULL, '2024-05-01 13:18:03', '2024-05-08 13:30:29', 2, 2, 2),
(5, 'en_US', 'The title is required.', '2024-05-06 06:21:28', '2024-05-08 13:30:49', 2, 2, 2),
(5, 'fr_CA', NULL, '2024-05-06 06:21:28', '2024-05-08 13:30:49', 2, 2, 2),
(6, 'en_US', 'The name is required.', '2024-05-07 16:01:41', '2024-05-08 04:18:39', 2, 1, 1),
(6, 'fr_CA', NULL, '2024-05-07 16:01:41', '2024-05-08 04:18:39', 2, 1, 1),
(7, 'en_US', 'The country is required.', '2024-05-07 16:01:41', '2024-05-08 04:18:57', 2, 1, 1),
(7, 'fr_CA', NULL, '2024-05-07 16:01:41', '2024-05-08 04:18:57', 2, 1, 1),
(8, 'en_US', 'The name is required.', '2024-05-07 16:02:26', '2024-05-08 04:19:08', 2, 1, 1),
(8, 'fr_CA', NULL, '2024-05-07 16:02:26', '2024-05-08 04:19:08', 2, 1, 1),
(9, 'en_US', 'The country is required.', '2024-05-07 16:02:26', '2024-05-08 04:19:19', 2, 1, 1),
(9, 'fr_CA', NULL, '2024-05-07 16:02:26', '2024-05-08 04:19:19', 2, 1, 1),
(10, 'en_US', 'The email is required.', '2024-05-07 16:02:34', '2024-05-08 04:19:31', 2, 1, 1),
(10, 'fr_CA', NULL, '2024-05-07 16:02:34', '2024-05-08 04:19:31', 2, 1, 1),
(11, 'en_US', 'The password is required.', '2024-05-07 16:02:34', '2024-05-08 04:19:45', 2, 1, 1),
(11, 'fr_CA', NULL, '2024-05-07 16:02:34', '2024-05-08 04:19:45', 2, 1, 1),
(12, 'en_US', 'The name is required.', '2024-05-07 16:02:42', '2024-05-08 04:19:55', 2, 1, 1),
(12, 'fr_CA', NULL, '2024-05-07 16:02:42', '2024-05-08 04:19:55', 2, 1, 1),
(13, 'en_US', 'The config is required.', '2024-05-07 16:02:56', '2024-05-08 04:20:09', 2, 1, 1),
(13, 'fr_CA', NULL, '2024-05-07 16:02:56', '2024-05-08 04:20:09', 2, 1, 1),
(14, 'en_US', 'The name is required.', '2024-05-07 16:03:03', '2024-05-08 04:20:19', 2, 1, 1),
(14, 'fr_CA', NULL, '2024-05-07 16:03:03', '2024-05-08 04:20:19', 2, 1, 1),
(15, 'en_US', 'The title is required.', '2024-05-07 17:13:15', '2024-05-08 04:20:26', 2, 1, 1),
(15, 'fr_CA', NULL, '2024-05-07 17:13:15', '2024-05-08 04:20:26', 2, 1, 1),
(16, 'en_US', 'The name is required.', '2024-05-08 13:13:41', '2024-05-08 13:31:08', 2, 2, 2),
(16, 'fr_CA', NULL, '2024-05-08 13:13:41', '2024-05-08 13:31:08', 2, 2, 2);
