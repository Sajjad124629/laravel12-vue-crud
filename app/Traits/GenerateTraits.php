<?php
namespace App\Traits;

use Keygen\Keygen;

trait GenerateTraits
{
    public function generateNumber($length = 5)
    {
        do {
            $number = Keygen::numeric($length)->generate();
        } while (strlen($number) < $length || $number[0] == '0');

        return $number;
    }

    public function maskPhoneNumber($phone)
    {
        return substr($phone, 0, 4) . '*****' . substr($phone, -2);
    }
    public function biggerNumberFormat($num)
    {
        if ($num >= 1000000000) {
            return $num % 1000000000 == 0 ? $num / 1000000000 . 'B' : round($num / 1000000000, 1) . 'B';
        } elseif ($num >= 1000000) {
            return $num % 1000000 == 0 ? $num / 1000000 . 'M' : round($num / 1000000, 1) . 'M';
        } elseif ($num >= 1000) {
            return $num % 1000 == 0 ? $num / 1000 . 'K' : round($num / 1000, 1) . 'K';
        }
        return $num;
    }
}
