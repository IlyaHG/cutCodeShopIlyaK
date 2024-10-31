<?php

namespace App\Services\Telegram\Exceptions;

use Exception;
use Illuminate\Http\Request;
final class TelegramBotApiException extends Exception
{
    public function report()
    {
        // return response('123');
    }
    public function render(Request $request)
    {
        // return response()->json([]);
    }
}
