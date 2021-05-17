<?php

namespace App\Services;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use Jenssegers\Agent\Agent;
use Stevebauman\Location\Facades\Location;

class VisitorService
{
    /**
     * Variable to hold user agent related information.
     *
     * @var Agent
     */
    protected $agent;

    public function __construct(Agent $agent)
    {
        $this->agent = $agent;
    }

    /**
     * The browser of the visitor.
     *
     * @return bool|string
     */
    public function browser()
    {
        return $this->agent->browser();
    }

    /**
     * The referer of the visitor.
     *
     * @return string
     */
    public function referer()
    {
        return URL::previous();
    }

    /**
     * The operating system platform of the visitor.
     *
     * @return bool|string
     */
    public function platform()
    {
        return $this->agent->platform();
    }

    /**
     * The ip address of the visitor.
     *
     * @return string|null
     */
    public function ip()
    {
        return Request::ip();
    }

    /**
     * The country of the visitor.
     *
     * @return mixed
     */
    public function country()
    {
        return Location::get()->countryName;
    }
}
