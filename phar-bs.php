<?php

function CronExpressionAutoloader($className) {
  $classFile = dirname(__FILE__) . '/' . str_replace('\\', '/', $className) . '.php';
  if(is_readable($classFile))
    require_once $classFile;
}

spl_autoload_register('CronExpressionAutoloader');

__HALT_COMPILER();
