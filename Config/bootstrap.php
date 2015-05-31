<?php
/**
 * This file is loaded automatically by the app/webroot/index.php file after core.php
 *
 * This file should load/create any application wide configuration settings, such as 
 * Caching, Logging, loading additional configuration files.
 *
 * You should also use this file to include any files that provide global functions/constants
 * that your application uses.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

// Setup a 'default' cache configuration for use in the application.
Cache::config('default', array('engine' => 'File'));

/**
 * The settings below can be used to set additional paths to models, views and controllers.
 *
 * App::build(array(
 *     'Plugin' => array('/full/path/to/plugins/', '/next/full/path/to/plugins/'),
 *     'Model' =>  array('/full/path/to/models/', '/next/full/path/to/models/'),
 *     'View' => array('/full/path/to/views/', '/next/full/path/to/views/'),
 *     'Controller' => array('/full/path/to/controllers/', '/next/full/path/to/controllers/'),
 *     'Model/Datasource' => array('/full/path/to/datasources/', '/next/full/path/to/datasources/'),
 *     'Model/Behavior' => array('/full/path/to/behaviors/', '/next/full/path/to/behaviors/'),
 *     'Controller/Component' => array('/full/path/to/components/', '/next/full/path/to/components/'),
 *     'View/Helper' => array('/full/path/to/helpers/', '/next/full/path/to/helpers/'),
 *     'Vendor' => array('/full/path/to/vendors/', '/next/full/path/to/vendors/'),
 *     'Console/Command' => array('/full/path/to/shells/', '/next/full/path/to/shells/'),
 *     'locales' => array('/full/path/to/locale/', '/next/full/path/to/locale/')
 * ));
 *
 */

/**
 * Custom Inflector rules, can be set to correctly pluralize or singularize table, model, controller names or whatever other
 * string is passed to the inflection functions
 *
 * Inflector::rules('singular', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 * Inflector::rules('plural', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 *
 */

/**
 * Plugins need to be loaded manually, you can either load them one by one or all of them in a single call
 * Uncomment one of the lines below, as you need. make sure you read the documentation on CakePlugin to use more
 * advanced ways of loading plugins
 *
 * CakePlugin::loadAll(); // Loads all plugins at once
 * CakePlugin::load('DebugKit'); //Loads a single plugin named DebugKit
 *
 */

//CakePlugin::load('DebugKit');

// Enable the Dispatcher filters for plugin assets, and
// CacheHelper.
Configure::write('Dispatcher.filters', array(
    'AssetDispatcher',
    'CacheDispatcher'
));

// Add logging configuration.
CakeLog::config('debug', array(
    'engine' => 'FileLog',
    'types' => array('notice', 'info', 'debug'),
    'file' => 'debug',
));
CakeLog::config('error', array(
    'engine' => 'FileLog',
    'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
    'file' => 'error',
));

Inflector::rules('plural', array('irregular' => array('billing' => 'billing')));
Inflector::rules('plural', array('irregular' => array('admin' => 'admin')));

if (!defined('FULL_BASE_URL')) {
  define('FULL_BASE_URL', 'http://rentsquaredev.com');
}


define('USER_TYPE_MANAGER', 0);
define('USER_TYPE_TENANT', 1);
define('USER_TYPE_ADMIN',2);

define('MSG_STATUS_UNREAD', 0);
define('MSG_STATUS_READ', 1);

define('CC_FEE',0.0275);
define('ACH_FEE',3.95); 

define('RENTSQUARE_MERCH_USER','yolodesign1'); 
define('RENTSQUARE_MERCH_PASS','whLswPbvLfkrHCZHvGHp');
define('RENTSQUARE_MERCH_KEY','E03E49619870FD8C9885513210F4F7F7BC1AB65BFE79456E');

define('BC_SANDBOXVALUE', true);
//define('RENTSQUARE_MERCH_USER','RentSquare'); 
//define('RENTSQUARE_MERCH_PASS','rentsquare1');

define('MONTHLY_25_OR_LESS',25); 
define('MONTHLY_26_TO_50',50); 
define('MONTHLY_51_TO_100',75); 
define('MONTHLY_101_TO_200',125); 
define('MONTHLY_201_TO_300',175); 
define('MONTHLY_301_TO_400',225); 
define('MONTHLY_OVER_400',275); 
		