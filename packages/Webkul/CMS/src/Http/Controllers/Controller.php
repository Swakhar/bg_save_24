<?php

namespace Webkul\CMS\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use  App\Helper\ImageManipulation;
class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;
    protected $imageManipulation;
    function __construct(ImageManipulation $imageManipulation)
    {
        $this->imageManipulation = $imageManipulation;
    }
}