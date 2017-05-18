<?php

namespace App\Http\Controllers\Api\DingoTest\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
  public function index() {
    return 'index v1';
  }
}
