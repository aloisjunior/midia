<?php
/**
 * Created by PhpStorm.
 * User: alois
 * Date: 17/09/2017
 * Time: 18:22
 */

namespace ARsig\Http\Middleware;

use Illuminate\Http\Request;
use Fideloper\Proxy\TrustProxies as Middleware;
class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array
     */
    protected $proxies;
    /**
     * The current proxy header mappings.
     *
     * @var array
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}