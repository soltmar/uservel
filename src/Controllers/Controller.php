<?php
/**
 *
 * Project: ecmsl55
 * Date: 07/11/2017
 * @author Mariusz Soltys.
 * @version 1.0.0
 * @license All Rights Reserved
 *
 */

namespace marsoltys\uservel\Controllers;

use \App\Http\Controllers\Controller as AppController;
use Illuminate\Routing\Controller as BaseController;

if (class_exists('\App\Http\Controllers\Controller')) {

    class Controller extends AppController
    {

    }
} else if (class_exists('Illuminate\Routing\Controller')) {

    class Controller extends BaseController
    {

    }
} else {

    class Controller
    {

    }
}