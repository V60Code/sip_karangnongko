<?php

namespace App\Enums;

enum GenderEnum: string
{
    case JANTAN = 'jantan';
    case BETINA = 'betina';

    /**
     * Mendapatkan label yang lebih ramah pengguna untuk Enum.
     *
     * @return string
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::JANTAN => 'Jantan',
            self::BETINA => 'Betina',
        };
    }

    /**
     * Mendapatkan semua nilai Enum sebagai array.
     *
     * @return array
     */
    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Mendapatkan semua kasus Enum sebagai array asosiatif (value => label)
     * untuk digunakan di form select Filament.
     *
     * @return array
     */
    public static function asSelectArray(): array
    {
        $array = [];
        foreach (self::cases() as $case) {
            $array[$case->value] = $case->getLabel();
        }
        return $array;
    }
}