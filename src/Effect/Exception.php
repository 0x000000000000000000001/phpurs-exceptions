<?php

$error = function($msg) use (&$error) { return new \Exception($msg); };
$message = function($e) use (&$message) { return $e->getMessage() . "\n" . $e->getTraceAsString(); };
$name = function($e) use (&$name) { return get_class($e); };
$stackImpl = function($just) use (&$stackImpl) { return function($nothing) { return function($e) use(&$just, &$nothing) { return $just($e->getTraceAsString()); }; }; };
$throwException = function($e) use (&$throwException) { return function() use(&$e) { throw $e; }; };
$catchException = function($c, $t = null) use (&$catchException) {
    if (func_num_args() < 2) {
        $__args = func_get_args();
        return function(...$more) use ($__args, &$catchException) {

            return $catchException(...array_merge($__args, $more));
        };
    }
    return function() use(&$c, &$t) { try { return $t(); } catch (\Throwable $e) { if (strpos($e->getMessage(), 'Object of class stdClass') !== false) { echo "\n\n!!! CAUGHT IN EXCEPTION.PHP:\n" . $e->getTraceAsString() . "\n\n"; } return $c($e)(); } };
};
$showErrorImpl = function($e) use (&$showErrorImpl) { return (string)$e; };

$exports['error'] = $error;
$exports['message'] = $message;
$exports['name'] = $name;
$exports['stackImpl'] = $stackImpl;
$exports['throwException'] = $throwException;
$exports['catchException'] = $catchException;
$exports['showErrorImpl'] = $showErrorImpl;
return $exports;
