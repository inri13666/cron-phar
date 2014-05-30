<?php
/**
 * User  : Nikita.Makarov
 * Date  : 5/21/14
 * Time  : 1:17 PM
 * E-Mail: nikita.makarov@effective-soft.com
 */


$library_path = implode(DIRECTORY_SEPARATOR, array(dirname(dirname(__FILE__)), 'compiled')) . DIRECTORY_SEPARATOR . 'CronExpression.';

if (extension_loaded('bz2')) {
    require_once 'phar://' . $library_path . 'bz2';
} elseif (extension_loaded('zlib')) {
    require_once 'phar://' . $library_path . 'gz';
} else {
    require_once 'phar://' . $library_path . 'phar';
}
function pre($_)
{
    if (php_sapi_name() === 'cli') {
        echo print_r($_, true) . PHP_EOL;
    } else {
        echo '<pre>';
        echo print_r($_, true);
        echo '</pre>';
    }
}

$cron = Cron\CronExpression::factory('@daily');
$cron->isDue();
pre($cron->getNextRunDate()->format('Y-m-d H:i:s'));
pre($cron->getPreviousRunDate()->format('Y-m-d H:i:s'));

// Works with complex expressions
$cron = Cron\CronExpression::factory('3-59/15 2,6-12 */15 1 2-5');
pre($cron->getNextRunDate()->format('Y-m-d H:i:s'));

// Calculate a run date two iterations into the future
$cron = Cron\CronExpression::factory('@daily');
pre($cron->getNextRunDate(null, 2)->format('Y-m-d H:i:s'));

// Calculate a run date relative to a specific time
$cron = Cron\CronExpression::factory('@monthly');
pre($cron->getNextRunDate('2010-01-12 00:00:00')->format('Y-m-d H:i:s'));