<x-mail::message>
# Introduction

مرحبا بك  {{ $user->name }},<br>
نحن سعداء بانضمامك إلينا في {{ config('app.name') }}.   ستجد الكثير من المبادئ والمعلومات المفيدة في هذا التطبيق.

<x-mail::button :url="''">
تصفح الموقع
</x-mail::button>

شكرا<br>
{{ config('app.name') }}
</x-mail::message>



