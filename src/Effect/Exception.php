<?php

$error = function($msg) { return new \Exception($msg); };
$errorWithCause = function($msg) {
    return function($cause) use ($msg) {
        return new \Exception($msg, 0, $cause instanceof \Throwable ? $cause : null);
    };
};
$errorWithName = function($msg) {
    return function($name) use ($msg) {
        $e = new class($msg) extends \Exception { public $name; };
        $e->name = $name;
        return $e;
    };
};
$message = function($e) { return $e->getMessage() . "\n" . $e->getTraceAsString(); };
$name = function($e) { return isset($e->name) ? $e->name : \get_class($e); };
$stackImpl = function($just) { return function($nothing) use ($just) { return function($e) use($just, $nothing) { return $just($e->getTraceAsString()); }; }; };
$throwException = function($e) { return function() use($e) { throw $e; }; };
$catchException = function($c, $t = null) use (&$catchException) {
    if (\func_num_args() < 2) {
        $__args = \func_get_args();
        return function(...$more) use ($__args, &$catchException) {

            return $catchException(...\array_merge($__args, $more));
        };
    }
    return function() use($c, $t) { try { return $t(); } catch (\Throwable $e) { return $c($e)(); } };
};
$showErrorImpl = function($e) { return (string)$e; };

$exports['error'] = $error;
$exports['errorWithCause'] = $errorWithCause;
$exports['errorWithName'] = $errorWithName;
$exports['message'] = $message;
$exports['name'] = $name;
$exports['stackImpl'] = $stackImpl;
$exports['throwException'] = $throwException;
$exports['catchException'] = $catchException;
$exports['showErrorImpl'] = $showErrorImpl;
return $exports;
