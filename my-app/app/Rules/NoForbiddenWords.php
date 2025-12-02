<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NoForbiddenWords implements Rule
{
    protected $forbiddenWords = ['ヴォルデモート', 'ぎっちょ'];

    public function passes($attribute, $value)
    {
        foreach ($this->forbiddenWords as $word) {
            if (mb_strpos($value, $word) !== false) {
                return false;
            }
        }
        return true;
    }

    public function message(): string
    {
        return '禁止ワードが含まれています！';
    }
}
