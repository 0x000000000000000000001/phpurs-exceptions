<?php
if (!function_exists('phpurs_uncurry2')) {
function phpurs_uncurry2($fn) {
    return function($a, $b = null) use ($fn) {
        if (func_num_args() < 2) {
            $__args = func_get_args();
            return function(...$more) use ($fn, $__args) {
                return phpurs_uncurry2($fn)(...array_merge($__args, $more));
            };
        }
        return $fn($a)($b);
    };
}
function phpurs_uncurry3($fn) {
    return function($a, $b = null, $c = null) use ($fn) {
        if (func_num_args() < 3) {
            $__args = func_get_args();
            return function(...$more) use ($fn, $__args) {
                return phpurs_uncurry3($fn)(...array_merge($__args, $more));
            };
        }
        return $fn($a)($b)($c);
    };
}
function phpurs_uncurry4($fn) {
    return function($a, $b = null, $c = null, $d = null) use ($fn) {
        if (func_num_args() < 4) {
            $__args = func_get_args();
            return function(...$more) use ($fn, $__args) {
                return phpurs_uncurry4($fn)(...array_merge($__args, $more));
            };
        }
        return $fn($a)($b)($c)($d);
    };
}
function phpurs_uncurry5($fn) {
    return function($a, $b = null, $c = null, $d = null, $e = null) use ($fn) {
        if (func_num_args() < 5) {
            $__args = func_get_args();
            return function(...$more) use ($fn, $__args) {
                return phpurs_uncurry5($fn)(...array_merge($__args, $more));
            };
        }
        return $fn($a)($b)($c)($d)($e);
    };
}
}



$Effect_Exception_error = function($msg) { return new \Exception($msg); };
$Effect_Exception_message = function($e) { return $e->getMessage(); };
$Effect_Exception_name = function($e) { return get_class($e); };
$Effect_Exception_stackImpl = function($just) { return function($nothing) { return function($e) use(&$just, &$nothing) { return $just($e->getTraceAsString()); }; }; };
$Effect_Exception_throwException = function($e) { return function() use(&$e) { throw $e; }; };
$Effect_Exception_catchException = phpurs_uncurry2(function($c) { return function($t) use(&$c) { return function() use(&$c, &$t) { try { return $t(); } catch (\Throwable $e) { return $c($e)(); } }; }; });
$Effect_Exception_showErrorImpl = function($e) { return (string)$e; };