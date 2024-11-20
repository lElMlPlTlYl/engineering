<?php

namespace App\Enums;
use Filament\Support\Contracts\HasLabel;

enum Status: string implements HasLabel {
    case Approved = 'approved';
    case Pending = 'pending';
    case Denied = 'denied';
    case Canceled = 'canceled';

    public function getLabel(): string{
        return match ($this) {
            self::Approved => 'APPROVED',
            self::Pending => 'PENDING',
            self::Denied => 'DENIED',
            self::Canceled => 'CANCELED'
        };
    }
}





