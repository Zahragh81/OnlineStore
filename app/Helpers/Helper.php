<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Morilog\Jalali\CalendarUtils;
use Morilog\Jalali\Jalalian;

function diagnosis_format(mixed $value, ?string $format): string
{
    return $format ?? (Str::contains($value, ':') ? 'Y/m/d H:i' : 'Y/m/d');
}

function to_georgian(mixed $data, string $format = null): ?string
{
    $format = diagnosis_format($data, $format);

    return $data ? CalendarUtils::createDatetimeFromFormat($format, $data)->format($format) : null;
}

function to_jalali(mixed $data, string $format = null): ?string
{
    $format = diagnosis_format($data, $format);

    return $data ? Jalalian::forge($data)->format($format) : null;
}

function user_search(mixed $query, string $search): void
{
    $string = Str::remove('%', $search);

    $array = Str::of($string)->explode(' ')->map(fn ($value) => "%$value%");

    foreach ($array as $search)
        $query->whereAny(['username', 'first_name', 'last_name'], 'like', $search);
}
