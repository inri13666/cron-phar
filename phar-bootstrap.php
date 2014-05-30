<?php
if (!function_exists('__def')) {
    function __def($constant, $value)
    {
        if (strlen($constant) <= 0) {
            return false;
        }
        if (!defined($constant)) {
            define($constant, $value);
            return true;
        }
        //Already Defined
        return false;
    }
}
__def('DS', DIRECTORY_SEPARATOR);

if (version_compare(PHP_VERSION, '5.3.0') < 0) {
    exit("PHP must be 5.3.0+");
}

Phar::mapPhar();

if (!function_exists('CronExpressionAutoloader')) {
    function CronExpressionAutoloader($class)
    {
        $basePath = 'phar://' . __FILE__ . '/';
        if (is_readable($basePath . str_replace('\\', '/', $class) . '.php')) {
            require_once $basePath . str_replace('\\', '/', $class) . '.php';
        };

    }

    spl_autoload_register('CronExpressionAutoloader');
}
__HALT_COMPILER();
?>
