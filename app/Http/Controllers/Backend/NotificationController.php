<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Notifications\DatabaseNotification;


class NotificationController extends Controller
{
    public function __construct()
    {

    }

    public function read($id) {

        DatabaseNotification::find($id)->markAsRead();

        return response()->json(["msg" => "Success"]);
    }
}
