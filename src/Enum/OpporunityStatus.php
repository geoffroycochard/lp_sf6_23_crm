<?php

namespace App\Enum;

enum OpportunityStatus: string {
    case open =  'Open';
    case inProgree =  'In progress';
    case lost = 'Lost';
    case win = 'Won';
}