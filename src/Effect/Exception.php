<?php

$Effect_Exception_error = function($msg) { return new \Exception($msg); };
$Effect_Exception_message = function($e) { return $e->getMessage(); };
$Effect_Exception_name = function($e) { return get_class($e); };
$Effect_Exception_stackImpl = function($just) { return function($nothing) { return function($e) use(&$just, &$nothing) { return $just($e->getTraceAsString()); }; }; };
$Effect_Exception_throwException = function($e) { return function() use(&$e) { throw $e; }; };
$Effect_Exception_catchException = function($c, $t = null) {
    if (func_num_args() < 2) {
        $__args = func_get_args();
        return function(...$more) use ($__args) {
            global $Effect_Exception_catchException;
            return $Effect_Exception_catchException(...array_merge($__args, $more));
        };
    }
    return function() use(&$c, &$t) { try { return $t(); } catch (\Throwable $e) { return $c($e)(); } };
};
$Effect_Exception_showErrorImpl = function($e) { return (string)$e; };