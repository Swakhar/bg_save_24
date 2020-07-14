<?php

namespace Webkul\Shop\Http\Controllers;

use Webkul\Shop\Http\Controllers\Controller;

 class StaticPageController extends Controller
{
    
    public function aboutus()
    {
        return view($this->_config['view']);
    }
    public function privacy()
    {
        return view($this->_config['view']);
    }
    public function policy()
    {
        return view($this->_config['view']);
    }
    public function payment()
    {
        return view($this->_config['view']);
    }
    public function shipping()
    {
        return view($this->_config['view']);
    }
    public function tracking()
    {
        return view($this->_config['view']);
    }
    public function faqs()
    {
        return view($this->_config['view']);
    }

    
    public function notFound()
    {
        abort(404);
    }
}