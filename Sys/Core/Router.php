<?php

namespace core;

abstract class Router
{
    protected $routers = array(
        'site' => 'site',
        'admin' => 'admin'
    );
    protected $default_router = 'site';
    protected $on_default_router = true;
}
