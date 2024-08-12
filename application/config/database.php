<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
*/

$active_group = 'default';
$active_record = TRUE;

$db['default']['hostname'] = 'localhost';
//$db['default']['username'] = 'root';
//$db['default']['password'] = 'msh@123';
//$db['default']['database'] = 'school_srp';
$db['default']['username'] = 'root';
// $db['default']['username'] = 'demo_kormochari';
$db['default']['password'] = '';
// $db['default']['password'] = 'OTWZb1VDVw';
$db['default']['database'] = 'school-mang';
// $db['default']['database'] = 'demo_educare';
$db['default']['dbdriver'] = 'mysqli';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;

$db['mssqldb']['hostname'] = 'sms_dsn';
$db['mssqldb']['username'] = '';
$db['mssqldb']['password'] = '';
$db['mssqldb']['database'] = 'school_ms_db';
$db['mssqldb']['dbdriver'] = 'odbc';
$db['mssqldb']['dbprefix'] = '';
$db['mssqldb']['pconnect'] = TRUE;
$db['mssqldb']['db_debug'] = TRUE;
$db['mssqldb']['cache_on'] = FALSE;
$db['mssqldb']['cachedir'] = '';
$db['mssqldb']['char_set'] = 'utf8';
$db['mssqldb']['dbcollat'] = 'utf8_general_ci';
$db['mssqldb']['swap_pre'] = '';
$db['mssqldb']['autoinit'] = TRUE;
$db['mssqldb']['stricton'] = FALSE;


/* End of file database.php */
/* Location: ./application/config/database.php */
