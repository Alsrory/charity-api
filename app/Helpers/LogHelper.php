<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use App\Models\SystemLog;
use Illuminate\Support\Facades\Http;

class LogHelper
{
    public static function event($level, $message, array $context = [])
    {
        // 1.register Logs in file
        // 1. تسجيل في ملف الـ Logs
        // Check if the log level method exists, otherwise default to 'info'

        if (!method_exists(app('log'), $level)) {
            $level = 'info';
        }
        Log::$level($message, $context);

        // 2. store in database
        try {
            // 2. تخزين في قاعدة البيانات
            SystemLog::create([
                'level' => $level,
                'message' => $message,
                'context' => $context
            ]);
        } catch (\Exception $e) {
            // If database logging fails, log to the default log file
            Log::error('Failed to log to database: ' . $e->getMessage(), [
                'level' => $level,
                'message' => $message,
                'context' => $context
            ]);
        }
        // 2.1. If the level is critical or alert, store in database

  
        // 3. If the level is critical or alert, send a Telegram alert
        if (in_array($level, ['critical', 'alert', 'emergency','debug', 'error'])) {
            self::sendTelegramAlert($level, $message, $context);
        }
    }

    protected static function sendTelegramAlert($level, $message, $context)
    {
        $token = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID');

        $text = "🚨 *{$level}*\n"
              . "{$message}\n"
              . "Context: " . json_encode($context, JSON_PRETTY_PRINT);

        Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
            'chat_id' => $chatId,
            'text' => $text,
            'parse_mode' => 'Markdown'
        ]);
        
    }
}
