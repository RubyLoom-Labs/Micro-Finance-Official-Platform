<?php

namespace App\Http\Controllers;

use App\Repositories\LogRepository;
use Facade\FlareClient\View;
use Illuminate\Http\Request;

class LogController extends Controller
{
    protected $logRepository;
    public function __construct(LogRepository $logRepository)
    {
        $this->logRepository = $logRepository;
    }

    public function logsView() {
        return View('settings.userlogs');
    }
}
