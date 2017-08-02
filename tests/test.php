<?php
require 'build/cron-expression.phar';

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
