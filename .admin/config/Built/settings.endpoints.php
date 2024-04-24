<?php

namespace App;


$table['client'] = [
    'id_client' => [
        'type' => 'INTEGER',
    ],
    'name' => [
        'type' => 'VARCHAR',
        'description' => 'Name',
    ],
    'id_country' => [
        'type' => 'INTEGER',
        'description' => 'Country',
    ],
    'phone' => [
        'type' => 'VARCHAR',
        'description' => 'Phone',
    ],
    'phone_work' => [
        'type' => 'VARCHAR',
        'description' => 'Phone work',
    ],
    'ext' => [
        'type' => 'VARCHAR',
        'description' => 'Extension',
    ],
    'email' => [
        'type' => 'VARCHAR',
        'description' => 'Email',
    ],
    'contact' => [
        'type' => 'VARCHAR',
        'description' => 'Contact',
    ],
    'email2' => [
        'type' => 'VARCHAR',
        'description' => 'Email (contact)',
    ],
    'phone_mobile' => [
        'type' => 'VARCHAR',
        'description' => 'contact',
    ],
    'website' => [
        'type' => 'VARCHAR',
    ],
    'address_1' => [
        'type' => 'LONGVARCHAR',
        'description' => 'Address 1',
    ],
    'address_2' => [
        'type' => 'LONGVARCHAR',
        'description' => 'Address 2',
    ],
    'address_3' => [
        'type' => 'LONGVARCHAR',
        'description' => 'Address 3',
    ],
    'zip' => [
        'type' => 'VARCHAR',
        'description' => 'Zip',
    ],
    'date_creation' => [
        'type' => 'TIMESTAMP',
    ],
    'date_modification' => [
        'type' => 'TIMESTAMP',
    ],
    'id_group_creation' => [
        'type' => 'INTEGER',
    ],
    'id_creation' => [
        'type' => 'INTEGER',
    ],
    'id_modification' => [
        'type' => 'INTEGER',
    ],
];

$query['client'] = [
    'select' => $table['client'],
    'filter' => [],
    'join' => [],
    'limit' => [],
    'order' => [],
    'page' => [],
];
$table['billing'] = [
    'id_billing' => [
        'type' => 'INTEGER',
    ],
    'calc_id' => [
        'type' => 'VARCHAR',
    ],
    'title' => [
        'type' => 'VARCHAR',
        'description' => 'Title',
    ],
    'id_client' => [
        'type' => 'INTEGER',
        'description' => 'Client',
    ],
    'id_project' => [
        'type' => 'INTEGER',
        'description' => 'Project',
    ],
    'date' => [
        'type' => 'DATE',
        'description' => 'Date',
    ],
    'type' => [
        'type' => 'ENUM',
        'description' => 'Type',
        'valueSet' => null,
    ],
    'state' => [
        'type' => 'ENUM',
        'description' => 'State',
        'valueSet' => null,
    ],
    'gross' => [
        'type' => 'DECIMAL',
        'description' => 'Gross',
    ],
    'date_due' => [
        'type' => 'DATE',
        'description' => 'Due date',
    ],
    'note_billing' => [
        'type' => 'LONGVARCHAR',
        'description' => 'Note',
    ],
    'date_paid' => [
        'type' => 'DATE',
        'description' => 'Paid date',
    ],
    'net' => [
        'type' => 'DECIMAL',
        'description' => 'Net',
    ],
    'reference' => [
        'type' => 'VARCHAR',
        'description' => 'Paiement Reference',
    ],
    'date_creation' => [
        'type' => 'TIMESTAMP',
    ],
    'date_modification' => [
        'type' => 'TIMESTAMP',
    ],
    'id_group_creation' => [
        'type' => 'INTEGER',
    ],
    'id_creation' => [
        'type' => 'INTEGER',
    ],
    'id_modification' => [
        'type' => 'INTEGER',
    ],
];

$query['billing'] = [
    'select' => $table['billing'],
    'filter' => [],
    'join' => [],
    'limit' => [],
    'order' => [],
    'page' => [],
];
$table['billing_line'] = [
    'id_billing_line' => [
        'type' => 'INTEGER',
    ],
    'id_billing' => [
        'type' => 'INTEGER',
    ],
    'calc_id' => [
        'type' => 'VARCHAR',
    ],
    'id_assign' => [
        'type' => 'INTEGER',
        'description' => 'Assigned to',
    ],
    'id_project' => [
        'type' => 'INTEGER',
        'description' => 'Project',
    ],
    'title' => [
        'type' => 'VARCHAR',
        'description' => 'Title',
    ],
    'work_date' => [
        'type' => 'DATE',
        'description' => 'Date',
    ],
    'quantity' => [
        'type' => 'DECIMAL',
        'description' => 'Quantity',
    ],
    'amount' => [
        'type' => 'DECIMAL',
        'description' => 'Amount',
    ],
    'total' => [
        'type' => 'DECIMAL',
        'description' => 'Total',
    ],
    'note_billing_ligne' => [
        'type' => 'LONGVARCHAR',
        'description' => 'Note',
    ],
    'date_creation' => [
        'type' => 'TIMESTAMP',
    ],
    'date_modification' => [
        'type' => 'TIMESTAMP',
    ],
    'id_group_creation' => [
        'type' => 'INTEGER',
    ],
    'id_creation' => [
        'type' => 'INTEGER',
    ],
    'id_modification' => [
        'type' => 'INTEGER',
    ],
];

$query['billing_line'] = [
    'select' => $table['billing_line'],
    'filter' => [],
    'join' => [],
    'limit' => [],
    'order' => [],
    'page' => [],
];
$table['payment_line'] = [
    'id_payment_line' => [
        'type' => 'INTEGER',
    ],
    'id_billing' => [
        'type' => 'INTEGER',
    ],
    'Reference' => [
        'type' => 'VARCHAR',
    ],
    'date' => [
        'type' => 'DATE',
        'description' => 'Date',
    ],
    'note' => [
        'type' => 'LONGVARCHAR',
        'description' => 'Note',
    ],
    'amount' => [
        'type' => 'DECIMAL',
        'description' => 'Amount',
    ],
    'date_creation' => [
        'type' => 'TIMESTAMP',
    ],
    'date_modification' => [
        'type' => 'TIMESTAMP',
    ],
    'id_group_creation' => [
        'type' => 'INTEGER',
    ],
    'id_creation' => [
        'type' => 'INTEGER',
    ],
    'id_modification' => [
        'type' => 'INTEGER',
    ],
];

$query['payment_line'] = [
    'select' => $table['payment_line'],
    'filter' => [],
    'join' => [],
    'limit' => [],
    'order' => [],
    'page' => [],
];
$table['cost_line'] = [
    'id_cost_line' => [
        'type' => 'INTEGER',
    ],
    'id_billing' => [
        'type' => 'INTEGER',
    ],
    'calc_id' => [
        'type' => 'VARCHAR',
    ],
    'title' => [
        'type' => 'VARCHAR',
        'description' => 'Title',
    ],
    'spend_date' => [
        'type' => 'DATE',
        'description' => 'Date',
    ],
    'note_billing_ligne' => [
        'type' => 'LONGVARCHAR',
        'description' => 'Note',
    ],
    'quantity' => [
        'type' => 'DECIMAL',
        'description' => 'Quantity',
    ],
    'amount' => [
        'type' => 'DECIMAL',
        'description' => 'Amount',
    ],
    'total' => [
        'type' => 'DECIMAL',
        'description' => 'Total',
    ],
    'date_creation' => [
        'type' => 'TIMESTAMP',
    ],
    'date_modification' => [
        'type' => 'TIMESTAMP',
    ],
    'id_group_creation' => [
        'type' => 'INTEGER',
    ],
    'id_creation' => [
        'type' => 'INTEGER',
    ],
    'id_modification' => [
        'type' => 'INTEGER',
    ],
];

$query['cost_line'] = [
    'select' => $table['cost_line'],
    'filter' => [],
    'join' => [],
    'limit' => [],
    'order' => [],
    'page' => [],
];
$table['project'] = [
    'id_project' => [
        'type' => 'INTEGER',
    ],
    'calc_id' => [
        'type' => 'VARCHAR',
    ],
    'name' => [
        'type' => 'VARCHAR',
        'description' => 'Name',
    ],
    'id_client' => [
        'type' => 'INTEGER',
        'description' => 'Client',
    ],
    'date' => [
        'type' => 'DATE',
        'description' => 'Start date',
    ],
    'type' => [
        'type' => 'ENUM',
        'description' => 'Type',
        'valueSet' => null,
    ],
    'state' => [
        'type' => 'ENUM',
        'description' => 'State',
        'valueSet' => null,
    ],
    'budget' => [
        'type' => 'DECIMAL',
        'description' => 'Budget',
    ],
    'spent' => [
        'type' => 'DECIMAL',
        'description' => 'Spent',
    ],
    'reference' => [
        'type' => 'VARCHAR',
        'description' => 'Paiement Reference',
    ],
    'date_creation' => [
        'type' => 'TIMESTAMP',
    ],
    'date_modification' => [
        'type' => 'TIMESTAMP',
    ],
    'id_group_creation' => [
        'type' => 'INTEGER',
    ],
    'id_creation' => [
        'type' => 'INTEGER',
    ],
    'id_modification' => [
        'type' => 'INTEGER',
    ],
];

$query['project'] = [
    'select' => $table['project'],
    'filter' => [],
    'join' => [],
    'limit' => [],
    'order' => [],
    'page' => [],
];
$table['time_line'] = [
    'id_cost_line' => [
        'type' => 'INTEGER',
    ],
    'id_project' => [
        'type' => 'INTEGER',
    ],
    'calc_id' => [
        'type' => 'VARCHAR',
    ],
    'Name' => [
        'type' => 'VARCHAR',
        'description' => 'Title',
    ],
    'date' => [
        'type' => 'DATE',
        'description' => 'Date',
    ],
    'note' => [
        'type' => 'LONGVARCHAR',
        'description' => 'Note',
    ],
    'quantity' => [
        'type' => 'DECIMAL',
        'description' => 'Quantity',
    ],
    'amount' => [
        'type' => 'DECIMAL',
        'description' => 'Amount',
    ],
    'total' => [
        'type' => 'DECIMAL',
        'description' => 'Total',
    ],
    'date_creation' => [
        'type' => 'TIMESTAMP',
    ],
    'date_modification' => [
        'type' => 'TIMESTAMP',
    ],
    'id_group_creation' => [
        'type' => 'INTEGER',
    ],
    'id_creation' => [
        'type' => 'INTEGER',
    ],
    'id_modification' => [
        'type' => 'INTEGER',
    ],
];

$query['time_line'] = [
    'select' => $table['time_line'],
    'filter' => [],
    'join' => [],
    'limit' => [],
    'order' => [],
    'page' => [],
];
$table['authy'] = [
    'id_authy' => [
        'type' => 'INTEGER',
    ],
    'validation_key' => [
        'type' => 'VARCHAR',
    ],
    'username' => [
        'type' => 'VARCHAR',
        'description' => 'Username',
    ],
    'fullname' => [
        'type' => 'VARCHAR',
        'description' => 'Fullname',
    ],
    'email' => [
        'type' => 'VARCHAR',
        'description' => 'Email',
    ],
    'passwd_hash' => [
        'type' => 'VARCHAR',
        'description' => 'Password',
    ],
    'expire' => [
        'type' => 'DATE',
        'description' => 'Expiration',
    ],
    'deactivate' => [
        'type' => 'ENUM',
        'description' => 'Deactivated',
        'valueSet' => null,
    ],
    'is_root' => [
        'type' => 'ENUM',
    ],
    'id_authy_group' => [
        'type' => 'INTEGER',
        'description' => 'Primary group',
    ],
    'is_system' => [
        'type' => 'ENUM',
    ],
    'rights_all' => [
        'type' => 'LONGVARCHAR',
        'description' => 'Rights',
    ],
    'rights_group' => [
        'type' => 'LONGVARCHAR',
        'description' => 'Rights group',
    ],
    'rights_owner' => [
        'type' => 'LONGVARCHAR',
        'description' => 'Rights owner',
    ],
    'onglet' => [
        'type' => 'LONGVARCHAR',
    ],
    'date_creation' => [
        'type' => 'TIMESTAMP',
    ],
    'date_modification' => [
        'type' => 'TIMESTAMP',
    ],
    'id_group_creation' => [
        'type' => 'INTEGER',
    ],
    'id_creation' => [
        'type' => 'INTEGER',
    ],
    'id_modification' => [
        'type' => 'INTEGER',
    ],
];

$query['authy'] = [
    'select' => $table['authy'],
    'filter' => [],
    'join' => [],
    'limit' => [],
    'order' => [],
    'page' => [],
];
$table['country'] = [
    'id_country' => [
        'type' => 'INTEGER',
    ],
    'name' => [
        'type' => 'VARCHAR',
        'description' => 'Name',
    ],
    'code' => [
        'type' => 'VARCHAR',
        'description' => 'Code',
    ],
    'timezone' => [
        'type' => 'VARCHAR',
        'description' => 'Timezone',
    ],
    'timezone_code' => [
        'type' => 'VARCHAR',
        'description' => 'Timezone code',
    ],
    'priority' => [
        'type' => 'INTEGER',
        'description' => 'Priority',
    ],
    'date_creation' => [
        'type' => 'TIMESTAMP',
    ],
    'date_modification' => [
        'type' => 'TIMESTAMP',
    ],
    'id_group_creation' => [
        'type' => 'INTEGER',
    ],
    'id_creation' => [
        'type' => 'INTEGER',
    ],
    'id_modification' => [
        'type' => 'INTEGER',
    ],
];

$query['country'] = [
    'select' => $table['country'],
    'filter' => [],
    'join' => [],
    'limit' => [],
    'order' => [],
    'page' => [],
];
$table['authy_group'] = [
    'id_authy_group' => [
        'type' => 'INTEGER',
    ],
    'name' => [
        'type' => 'VARCHAR',
        'description' => 'Name',
    ],
    'desc' => [
        'type' => 'VARCHAR',
        'description' => 'Description',
    ],
    'default_group' => [
        'type' => 'ENUM',
        'description' => 'Default',
        'valueSet' => null,
    ],
    'admin' => [
        'type' => 'ENUM',
        'description' => 'Admin',
        'valueSet' => null,
    ],
    'rights_all' => [
        'type' => 'VARCHAR',
        'description' => 'Rights',
    ],
    'rights_owner' => [
        'type' => 'VARCHAR',
        'description' => 'Rights owner',
    ],
    'rights_group' => [
        'type' => 'VARCHAR',
        'description' => 'Rights group',
    ],
    'date_creation' => [
        'type' => 'TIMESTAMP',
    ],
    'date_modification' => [
        'type' => 'TIMESTAMP',
    ],
    'id_group_creation' => [
        'type' => 'INTEGER',
    ],
    'id_creation' => [
        'type' => 'INTEGER',
    ],
    'id_modification' => [
        'type' => 'INTEGER',
    ],
];

$query['authy_group'] = [
    'select' => $table['authy_group'],
    'filter' => [],
    'join' => [],
    'limit' => [],
    'order' => [],
    'page' => [],
];
$table['authy_group_x'] = [
    'id_authy' => [
        'type' => 'INTEGER',
    ],
    'id_authy_group' => [
        'type' => 'INTEGER',
        'description' => 'Group',
    ],
];

$query['authy_group_x'] = [
    'select' => $table['authy_group_x'],
    'filter' => [],
    'join' => [],
    'limit' => [],
    'order' => [],
    'page' => [],
];
$table['authy_log'] = [
    'id_authy_log' => [
        'type' => 'INTEGER',
    ],
    'id_authy' => [
        'type' => 'INTEGER',
    ],
    'timestamp' => [
        'type' => 'TIMESTAMP',
        'description' => 'Date',
    ],
    'login' => [
        'type' => 'VARCHAR',
        'description' => 'Username',
    ],
    'userid' => [
        'type' => 'INTEGER',
    ],
    'result' => [
        'type' => 'VARCHAR',
    ],
    'ip' => [
        'type' => 'VARCHAR',
        'description' => 'Ip',
    ],
    'count' => [
        'type' => 'INTEGER',
        'description' => 'Count',
    ],
];

$query['authy_log'] = [
    'select' => $table['authy_log'],
    'filter' => [],
    'join' => [],
    'limit' => [],
    'order' => [],
    'page' => [],
];
$table['message'] = [
    'id_message' => [
        'type' => 'INTEGER',
    ],
    'label' => [
        'type' => 'VARCHAR',
        'description' => 'Label',
    ],
];

$query['message'] = [
    'select' => $table['message'],
    'filter' => [],
    'join' => [],
    'limit' => [],
    'order' => [],
    'page' => [],
];
$table['config'] = [
    'id_config' => [
        'type' => 'INTEGER',
    ],
    'category' => [
        'type' => 'ENUM',
        'description' => 'Category',
        'valueSet' => null,
    ],
    'config' => [
        'type' => 'VARCHAR',
        'description' => 'Setting',
    ],
    'value' => [
        'type' => 'LONGVARCHAR',
        'description' => 'Value',
    ],
    'system' => [
        'type' => 'ENUM',
    ],
    'description' => [
        'type' => 'VARCHAR',
        'description' => 'Description',
    ],
    'type' => [
        'type' => 'VARCHAR',
    ],
    'date_creation' => [
        'type' => 'TIMESTAMP',
    ],
    'date_modification' => [
        'type' => 'TIMESTAMP',
    ],
    'id_group_creation' => [
        'type' => 'INTEGER',
    ],
    'id_creation' => [
        'type' => 'INTEGER',
    ],
    'id_modification' => [
        'type' => 'INTEGER',
    ],
];

$query['config'] = [
    'select' => $table['config'],
    'filter' => [],
    'join' => [],
    'limit' => [],
    'order' => [],
    'page' => [],
];
$table['api_rbac'] = [
    'id_api_rbac' => [
        'type' => 'INTEGER',
    ],
    'date_creation' => [
        'type' => 'DATE',
        'description' => 'Date',
    ],
    'description' => [
        'type' => 'LONGVARCHAR',
        'description' => 'Description',
    ],
    'model' => [
        'type' => 'VARCHAR',
        'description' => 'Model',
    ],
    'action' => [
        'type' => 'VARCHAR',
        'description' => 'Action',
    ],
    'body' => [
        'type' => 'LONGVARCHAR',
        'description' => 'Body',
    ],
    'query' => [
        'type' => 'LONGVARCHAR',
        'description' => 'Query',
    ],
    'method' => [
        'type' => 'ENUM',
        'description' => 'Method',
        'valueSet' => null,
    ],
    'scope' => [
        'type' => 'ENUM',
        'description' => 'Scope',
        'valueSet' => null,
    ],
    'rule' => [
        'type' => 'ENUM',
        'description' => 'Rule',
        'valueSet' => null,
    ],
    'count' => [
        'type' => 'INTEGER',
        'description' => 'Used count',
    ],
    'date_modification' => [
        'type' => 'TIMESTAMP',
    ],
    'id_group_creation' => [
        'type' => 'INTEGER',
    ],
    'id_creation' => [
        'type' => 'INTEGER',
    ],
    'id_modification' => [
        'type' => 'INTEGER',
    ],
];

$query['api_rbac'] = [
    'select' => $table['api_rbac'],
    'filter' => [],
    'join' => [],
    'limit' => [],
    'order' => [],
    'page' => [],
];
$table['api_log'] = [
    'id_api_log' => [
        'type' => 'INTEGER',
    ],
    'id_api_rbac' => [
        'type' => 'INTEGER',
        'description' => 'Rule',
    ],
    'id_authy' => [
        'type' => 'INTEGER',
    ],
    'time' => [
        'type' => 'TIMESTAMP',
        'description' => 'Time',
    ],
];

$query['api_log'] = [
    'select' => $table['api_log'],
    'filter' => [],
    'join' => [],
    'limit' => [],
    'order' => [],
    'page' => [],
];
$table['template'] = [
    'id_template' => [
        'type' => 'INTEGER',
    ],
    'name' => [
        'type' => 'VARCHAR',
        'description' => 'Name',
    ],
    'subject' => [
        'type' => 'VARCHAR',
        'description' => 'Action',
    ],
    'color_1' => [
        'type' => 'VARCHAR',
        'description' => 'Color 1',
    ],
    'color_2' => [
        'type' => 'VARCHAR',
        'description' => 'Color 2',
    ],
    'color_3' => [
        'type' => 'VARCHAR',
        'description' => 'Color 3',
    ],
    'status' => [
        'type' => 'ENUM',
        'description' => 'Status',
        'valueSet' => null,
    ],
    'body' => [
        'type' => 'LONGVARCHAR',
        'description' => 'Body',
    ],
    'date_creation' => [
        'type' => 'TIMESTAMP',
    ],
    'date_modification' => [
        'type' => 'TIMESTAMP',
    ],
    'id_group_creation' => [
        'type' => 'INTEGER',
    ],
    'id_creation' => [
        'type' => 'INTEGER',
    ],
    'id_modification' => [
        'type' => 'INTEGER',
    ],
];

$query['template'] = [
    'select' => $table['template'],
    'filter' => [],
    'join' => [],
    'limit' => [],
    'order' => [],
    'page' => [],
];
$table['template_file'] = [
    'id_template_file' => [
        'type' => 'INTEGER',
    ],
    'id_template' => [
        'type' => 'INTEGER',
    ],
    'name' => [
        'type' => 'VARCHAR',
        'description' => 'Name',
    ],
    'file' => [
        'type' => 'VARCHAR',
        'description' => 'File',
    ],
    'date_creation' => [
        'type' => 'TIMESTAMP',
    ],
    'date_modification' => [
        'type' => 'TIMESTAMP',
    ],
    'id_group_creation' => [
        'type' => 'INTEGER',
    ],
    'id_creation' => [
        'type' => 'INTEGER',
    ],
    'id_modification' => [
        'type' => 'INTEGER',
    ],
];

$query['template_file'] = [
    'select' => $table['template_file'],
    'filter' => [],
    'join' => [],
    'limit' => [],
    'order' => [],
    'page' => [],
];
$table['message_i18n'] = [
    'id_message' => [
        'type' => 'INTEGER',
    ],
    'locale' => [
        'type' => 'VARCHAR',
    ],
    'text' => [
        'type' => 'LONGVARCHAR',
        'description' => 'Texte',
    ],
    'date_creation' => [
        'type' => 'TIMESTAMP',
    ],
    'date_modification' => [
        'type' => 'TIMESTAMP',
    ],
    'id_group_creation' => [
        'type' => 'INTEGER',
    ],
    'id_creation' => [
        'type' => 'INTEGER',
    ],
    'id_modification' => [
        'type' => 'INTEGER',
    ],
];

$query['message_i18n'] = [
    'select' => $table['message_i18n'],
    'filter' => [],
    'join' => [],
    'limit' => [],
    'order' => [],
    'page' => [],
];

return [
            'Authy/auth' => [
            'description' => "Authenticate a user and get a JWT token.",
            'type' => 'service',
            'POST' => [
                'request' => [
                            'u' => ['type' => 'string',
                                    'description'=> 'Username'
                            ],
                            'pw' => ['type' => 'string',
                                    'description'=> 'The MD5 hash of the password.'
                            ],
                ],
                'response' => [
                    'token' => ['type' => 'string',
                                'description'=> 'The JWT tocken.'
                    ],
                    'expires' => ['type' => 'timestamp',
                                'description'=> 'The expiration datetime.'
                    ],
                ]
            ]
        ],
        'ApiGoat/sendEmail' => [
            'description' => "Send an email to one or multiple existing email address(es).",
            'type' => 'service',
            'POST' => [
                'request' => [
                    'template_name' => ['type' => 'string',
                                        'description'=> 'The name of an existing template.'
                    ],
                    'email' => ['type' => 'string',
                                        'description'=> 'An existing email from the the Authy table.'
                    ],
                ],
                'response' => [
                    'data' => 'null',
                    'messages' => ['type' => 'string',
                                'description'=> 'The status of the email sender.'
                    ]
                ]
            ]
        ],
        'ApiGoat/account/{id}' => [
            'description' => "Get an account details.",
            'type' => 'service',
            'GET' => [
                'request' => [
                    'id' => ['type' => 'integer',
                            'description'=> 'A Authy id.'
                    ]
                ],
                'response' => [
                    'data' => ['type' => 'array',
                                'description'=> 'All Authy fields minus the secured ones (password, rights, etc...).'
                    ],
                ]
            ]
        ],
        'ApiGoat/reset/{key}' => [
            'description' => "Reset a password from a one time key.",
            'type' => 'service',
            'POST' => [
                'request' => [
                    'key' => ['type' => 'string',
                                        'description'=> 'The name of an existing template.'
                    ],
                    'email' => ['type' => 'string',
                                        'description'=> 'An existing email from the the Authy table.'
                    ],
                ],
                'response' => [
                    'data' => ['type' => 'string',
                                'description'=> 'The status of the email sender.'
                    ],
                ]
            ]
        ],
        'ApiGoat/oAuth/{Provider}/' => [
            'description' => "Use Oauth service to register and connect your user. The service must have been configured separatly beforehand.",
            'type' => 'service',
            'GET' => [
                'request' => [
                    'Provider' => ['type' => 'string',
                                    'description'=> 'One of the supported provider [facebook, github].'],
                ],
                'response' => [
                    'description' => "Redirection to the provider."
                ]
            ]
        ],
    'client[/{id}]' => [
        'description' => 'Client',
        'type' => 'custom',
        'GET' => [
            'request' => [
                'id' => [
                    'type' => 'INTEGER',
                    'name' => 'id_client'
                ]
            ],
            'response' => [
                'data' => $table['client']
            ]
        ],
        'POST' =>  [
            'request' => [
                'fields' => $table['client'],
                'query' => $query
            ],
            'response' => [
                'ids' => [],
                'count' => []
            ]
        ],
        'PATCH' =>  [
            'request' => $table['client']
            ],
        'DELETE' =>  [
            'request' => [
                        'type' => 'INTEGER',
                        'name' => 'id_client'
            ]
        ],
    ],
    'billing[/{id}]' => [
        'description' => 'Billing',
        'type' => 'custom',
        'GET' => [
            'request' => [
                'id' => [
                    'type' => 'INTEGER',
                    'name' => 'id_billing'
                ]
            ],
            'response' => [
                'data' => $table['billing']
            ]
        ],
        'POST' =>  [
            'request' => [
                'fields' => $table['billing'],
                'query' => $query
            ],
            'response' => [
                'ids' => [],
                'count' => []
            ]
        ],
        'PATCH' =>  [
            'request' => $table['billing']
            ],
        'DELETE' =>  [
            'request' => [
                        'type' => 'INTEGER',
                        'name' => 'id_billing'
            ]
        ],
    ],
    'billing_line[/{id}]' => [
        'description' => 'Entries',
        'type' => 'custom',
        'GET' => [
            'request' => [
                'id' => [
                    'type' => 'INTEGER',
                    'name' => 'id_billing_line'
                ]
            ],
            'response' => [
                'data' => $table['billing_line']
            ]
        ],
        'POST' =>  [
            'request' => [
                'fields' => $table['billing_line'],
                'query' => $query
            ],
            'response' => [
                'ids' => [],
                'count' => []
            ]
        ],
        'PATCH' =>  [
            'request' => $table['billing_line']
            ],
        'DELETE' =>  [
            'request' => [
                        'type' => 'INTEGER',
                        'name' => 'id_billing_line'
            ]
        ],
    ],
    'payment_line[/{id}]' => [
        'description' => 'Payment entry',
        'type' => 'custom',
        'GET' => [
            'request' => [
                'id' => [
                    'type' => 'INTEGER',
                    'name' => 'id_payment_line'
                ]
            ],
            'response' => [
                'data' => $table['payment_line']
            ]
        ],
        'POST' =>  [
            'request' => [
                'fields' => $table['payment_line'],
                'query' => $query
            ],
            'response' => [
                'ids' => [],
                'count' => []
            ]
        ],
        'PATCH' =>  [
            'request' => $table['payment_line']
            ],
        'DELETE' =>  [
            'request' => [
                        'type' => 'INTEGER',
                        'name' => 'id_payment_line'
            ]
        ],
    ],
    'cost_line[/{id}]' => [
        'description' => 'Cost entry',
        'type' => 'custom',
        'GET' => [
            'request' => [
                'id' => [
                    'type' => 'INTEGER',
                    'name' => 'id_cost_line'
                ]
            ],
            'response' => [
                'data' => $table['cost_line']
            ]
        ],
        'POST' =>  [
            'request' => [
                'fields' => $table['cost_line'],
                'query' => $query
            ],
            'response' => [
                'ids' => [],
                'count' => []
            ]
        ],
        'PATCH' =>  [
            'request' => $table['cost_line']
            ],
        'DELETE' =>  [
            'request' => [
                        'type' => 'INTEGER',
                        'name' => 'id_cost_line'
            ]
        ],
    ],
    'project[/{id}]' => [
        'description' => 'Project',
        'type' => 'custom',
        'GET' => [
            'request' => [
                'id' => [
                    'type' => 'INTEGER',
                    'name' => 'id_project'
                ]
            ],
            'response' => [
                'data' => $table['project']
            ]
        ],
        'POST' =>  [
            'request' => [
                'fields' => $table['project'],
                'query' => $query
            ],
            'response' => [
                'ids' => [],
                'count' => []
            ]
        ],
        'PATCH' =>  [
            'request' => $table['project']
            ],
        'DELETE' =>  [
            'request' => [
                        'type' => 'INTEGER',
                        'name' => 'id_project'
            ]
        ],
    ],
    'time_line[/{id}]' => [
        'description' => 'Time',
        'type' => 'custom',
        'GET' => [
            'request' => [
                'id' => [
                    'type' => 'INTEGER',
                    'name' => 'id_cost_line'
                ]
            ],
            'response' => [
                'data' => $table['time_line']
            ]
        ],
        'POST' =>  [
            'request' => [
                'fields' => $table['time_line'],
                'query' => $query
            ],
            'response' => [
                'ids' => [],
                'count' => []
            ]
        ],
        'PATCH' =>  [
            'request' => $table['time_line']
            ],
        'DELETE' =>  [
            'request' => [
                        'type' => 'INTEGER',
                        'name' => 'id_cost_line'
            ]
        ],
    ],
    'authy[/{id}]' => [
        'description' => 'User',
        'type' => 'base',
        'GET' => [
            'request' => [
                'id' => [
                    'type' => 'INTEGER',
                    'name' => 'id_authy'
                ]
            ],
            'response' => [
                'data' => $table['authy']
            ]
        ],
        'POST' =>  [
            'request' => [
                'fields' => $table['authy'],
                'query' => $query
            ],
            'response' => [
                'ids' => [],
                'count' => []
            ]
        ],
        'PATCH' =>  [
            'request' => $table['authy']
            ],
        'DELETE' =>  [
            'request' => [
                        'type' => 'INTEGER',
                        'name' => 'id_authy'
            ]
        ],
    ],
    'country[/{id}]' => [
        'description' => 'Country',
        'type' => 'custom',
        'GET' => [
            'request' => [
                'id' => [
                    'type' => 'INTEGER',
                    'name' => 'id_country'
                ]
            ],
            'response' => [
                'data' => $table['country']
            ]
        ],
        'POST' =>  [
            'request' => [
                'fields' => $table['country'],
                'query' => $query
            ],
            'response' => [
                'ids' => [],
                'count' => []
            ]
        ],
        'PATCH' =>  [
            'request' => $table['country']
            ],
        'DELETE' =>  [
            'request' => [
                        'type' => 'INTEGER',
                        'name' => 'id_country'
            ]
        ],
    ],
    'authy_group[/{id}]' => [
        'description' => 'Group',
        'type' => 'base',
        'GET' => [
            'request' => [
                'id' => [
                    'type' => 'INTEGER',
                    'name' => 'id_authy_group'
                ]
            ],
            'response' => [
                'data' => $table['authy_group']
            ]
        ],
        'POST' =>  [
            'request' => [
                'fields' => $table['authy_group'],
                'query' => $query
            ],
            'response' => [
                'ids' => [],
                'count' => []
            ]
        ],
        'PATCH' =>  [
            'request' => $table['authy_group']
            ],
        'DELETE' =>  [
            'request' => [
                        'type' => 'INTEGER',
                        'name' => 'id_authy_group'
            ]
        ],
    ],
    'authy_group_x[/{id}]' => [
        'description' => 'Group',
        'type' => 'base',
        'GET' => [
            'request' => [
                'id' => [
                    'type' => 'INTEGER',
                    'name' => 'id_authy_group'
                ]
            ],
            'response' => [
                'data' => $table['authy_group_x']
            ]
        ],
        'POST' =>  [
            'request' => [
                'fields' => $table['authy_group_x'],
                'query' => $query
            ],
            'response' => [
                'ids' => [],
                'count' => []
            ]
        ],
        'PATCH' =>  [
            'request' => $table['authy_group_x']
            ],
        'DELETE' =>  [
            'request' => [
                        'type' => 'INTEGER',
                        'name' => 'id_authy_group'
            ]
        ],
    ],
    'authy_log[/{id}]' => [
        'description' => 'Login log',
        'type' => 'base',
        'GET' => [
            'request' => [
                'id' => [
                    'type' => 'INTEGER',
                    'name' => 'id_authy_log'
                ]
            ],
            'response' => [
                'data' => $table['authy_log']
            ]
        ],
        'POST' =>  [
            'request' => [
                'fields' => $table['authy_log'],
                'query' => $query
            ],
            'response' => [
                'ids' => [],
                'count' => []
            ]
        ],
        'PATCH' =>  [
            'request' => $table['authy_log']
            ],
        'DELETE' =>  [
            'request' => [
                        'type' => 'INTEGER',
                        'name' => 'id_authy_log'
            ]
        ],
    ],
    'message[/{id}]' => [
        'description' => 'Message',
        'type' => 'base',
        'GET' => [
            'request' => [
                'id' => [
                    'type' => 'INTEGER',
                    'name' => 'id_message'
                ]
            ],
            'response' => [
                'data' => $table['message']
            ]
        ],
        'POST' =>  [
            'request' => [
                'fields' => $table['message'],
                'query' => $query
            ],
            'response' => [
                'ids' => [],
                'count' => []
            ]
        ],
        'PATCH' =>  [
            'request' => $table['message']
            ],
        'DELETE' =>  [
            'request' => [
                        'type' => 'INTEGER',
                        'name' => 'id_message'
            ]
        ],
    ],
    'config[/{id}]' => [
        'description' => 'Setting',
        'type' => 'base',
        'GET' => [
            'request' => [
                'id' => [
                    'type' => 'INTEGER',
                    'name' => 'id_config'
                ]
            ],
            'response' => [
                'data' => $table['config']
            ]
        ],
        'POST' =>  [
            'request' => [
                'fields' => $table['config'],
                'query' => $query
            ],
            'response' => [
                'ids' => [],
                'count' => []
            ]
        ],
        'PATCH' =>  [
            'request' => $table['config']
            ],
        'DELETE' =>  [
            'request' => [
                        'type' => 'INTEGER',
                        'name' => 'id_config'
            ]
        ],
    ],
    'api_rbac[/{id}]' => [
        'description' => 'API ACL',
        'type' => 'base',
        'GET' => [
            'request' => [
                'id' => [
                    'type' => 'INTEGER',
                    'name' => 'id_api_rbac'
                ]
            ],
            'response' => [
                'data' => $table['api_rbac']
            ]
        ],
        'POST' =>  [
            'request' => [
                'fields' => $table['api_rbac'],
                'query' => $query
            ],
            'response' => [
                'ids' => [],
                'count' => []
            ]
        ],
        'PATCH' =>  [
            'request' => $table['api_rbac']
            ],
        'DELETE' =>  [
            'request' => [
                        'type' => 'INTEGER',
                        'name' => 'id_api_rbac'
            ]
        ],
    ],
    'api_log[/{id}]' => [
        'description' => 'API log',
        'type' => 'base',
        'GET' => [
            'request' => [
                'id' => [
                    'type' => 'INTEGER',
                    'name' => 'id_api_log'
                ]
            ],
            'response' => [
                'data' => $table['api_log']
            ]
        ],
        'POST' =>  [
            'request' => [
                'fields' => $table['api_log'],
                'query' => $query
            ],
            'response' => [
                'ids' => [],
                'count' => []
            ]
        ],
        'PATCH' =>  [
            'request' => $table['api_log']
            ],
        'DELETE' =>  [
            'request' => [
                        'type' => 'INTEGER',
                        'name' => 'id_api_log'
            ]
        ],
    ],
    'template[/{id}]' => [
        'description' => 'Template',
        'type' => 'base',
        'GET' => [
            'request' => [
                'id' => [
                    'type' => 'INTEGER',
                    'name' => 'id_template'
                ]
            ],
            'response' => [
                'data' => $table['template']
            ]
        ],
        'POST' =>  [
            'request' => [
                'fields' => $table['template'],
                'query' => $query
            ],
            'response' => [
                'ids' => [],
                'count' => []
            ]
        ],
        'PATCH' =>  [
            'request' => $table['template']
            ],
        'DELETE' =>  [
            'request' => [
                        'type' => 'INTEGER',
                        'name' => 'id_template'
            ]
        ],
    ],
    'template_file[/{id}]' => [
        'description' => 'File',
        'type' => 'base',
        'GET' => [
            'request' => [
                'id' => [
                    'type' => 'INTEGER',
                    'name' => 'id_template_file'
                ]
            ],
            'response' => [
                'data' => $table['template_file']
            ]
        ],
        'POST' =>  [
            'request' => [
                'fields' => $table['template_file'],
                'query' => $query
            ],
            'response' => [
                'ids' => [],
                'count' => []
            ]
        ],
        'PATCH' =>  [
            'request' => $table['template_file']
            ],
        'DELETE' =>  [
            'request' => [
                        'type' => 'INTEGER',
                        'name' => 'id_template_file'
            ]
        ],
    ],
    'message_i18n[/{id}]' => [
        'description' => '',
        'type' => 'base',
        'GET' => [
            'request' => [
                'id' => [
                    'type' => 'INTEGER',
                    'name' => 'id_template_file'
                ]
            ],
            'response' => [
                'data' => $table['message_i18n']
            ]
        ],
        'POST' =>  [
            'request' => [
                'fields' => $table['message_i18n'],
                'query' => $query
            ],
            'response' => [
                'ids' => [],
                'count' => []
            ]
        ],
        'PATCH' =>  [
            'request' => $table['message_i18n']
            ],
        'DELETE' =>  [
            'request' => [
                        'type' => 'INTEGER',
                        'name' => 'id_template_file'
            ]
        ],
    ],
];
