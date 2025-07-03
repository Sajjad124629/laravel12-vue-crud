<?php 
namespace App\Traits;
use Carbon\Carbon;
trait DateFormatTraits {
    public function formatDate($requestDate,$format) {
        $formattedDate = Carbon::parse($requestDate)->format($format);
        return $formattedDate;
    }
}