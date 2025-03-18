<?php

declare(strict_types=1);

namespace Services\Telegram;

use Illuminate\Support\Facades\Http;
use Services\Telegram\Exceptions\TelegramBotApiException;
use Throwable;

interface TelegramBotApiContract
{
    public static function sendMessage(string $token,int $chatId, string $text): bool;
}
