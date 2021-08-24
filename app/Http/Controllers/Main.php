<?php

namespace App\Http\Main;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

class Main extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
