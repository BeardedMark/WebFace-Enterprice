<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AntibotService
{
    public static function check(Request $request): void
    {
        $request->validate([
            'human_confirm'    => 'accepted',
            'contact_field'    => 'max:0',
            'form_start_time'  => 'required|numeric',
        ], [
            'human_confirm.accepted' => 'Пожалуйста, подтвердите, что вы не робот',
            'contact_field.max'      => 'Поле должно быть пустым',
            'form_start_time.required' => 'Ошибка времени отправки формы',
            'form_start_time.numeric'  => 'Неверный формат времени',
        ]);

        // Проверка времени заполнения
        $formStart = (int) $request->input('form_start_time');
        $formEnd   = now()->getTimestampMs(); // текущее время в ms
        $diffSec   = ($formEnd - $formStart) / 1000;

        if ($diffSec < 5) {
            throw ValidationException::withMessages([
                'form' => 'Слишком быстро отправлена форма. Подтвердите, что вы человек',
            ]);
        }
    }
}
