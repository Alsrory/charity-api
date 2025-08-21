<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeJsonErrorViews extends Command
{
    protected $signature = 'make:json-error-views';
    protected $description = 'Create JSON error views for API responses';

    public function handle()
    {
        $errorPath = resource_path('views/errors');

        if (!File::exists($errorPath)) {
            File::makeDirectory($errorPath, 0755, true);
        }

        $errors = [
            401 => ['message' => 'يجب تسجيل الدخول للوصول إلى هذا المورد'],
            403 => ['message' => 'غير مصرح بالوصول إلى هذا المورد'],
            404 => ['message' => 'الرابط المطلوب غير موجود'],
            405 => ['message' => 'الطريقة غير مسموح بها'],
            422 => ['message' => 'البيانات المرسلة غير صحيحة'],
            500 => ['message' => 'حدث خطأ غير متوقع'],
        ];

        foreach ($errors as $code => $data) {
            $jsonContent = json_encode([
                'status' => false,
                'message' => $data['message'],
            ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

            File::put("$errorPath/{$code}.json", $jsonContent);
        }

        $this->info('✅ JSON error views created successfully in: resources/views/errors');
    }
}
