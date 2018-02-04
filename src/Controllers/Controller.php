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

use marsoltys\uservel\Traits\HandleEmptyRights;
use marsoltys\uservel\Traits\rightsInstalled;

if (class_exists('\App\Http\Controllers\Controller')) {

    class Controller extends \App\Http\Controllers\Controller
    {
        use rightsInstalled;
        use HandleEmptyRights;
    }
} else {

    class Controller extends \Illuminate\Routing\Controller
    {
        use rightsInstalled;
        use HandleEmptyRights;
    }
}