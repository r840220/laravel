<?php

namespace shopping_mall\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class Globalvalue
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        $item = DB::table('settings')->select('name', 'value')->get();
        $setting = array();
        foreach($item as $value){
            $setting[$value->name] = $value->value;
        }
        $data['setting'] = $setting;
        $data['product_type'] = DB::table('product_types')->select('id', 'parent', 'level', 'name')->get();
        $request->merge($data);
        return $next($request);
    }
}
