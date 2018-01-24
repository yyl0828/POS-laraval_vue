<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/16 0016
 * Time: 9:43
 */

namespace App\Http\Middleware;

use Closure;

class Activity
{

    public function handle($request, Closure $next)
    {

        if (time() < strtotime('2017-11-14')) {
            return redirect('activity0');
        } else {
            return $next($request);
        }
    }
}