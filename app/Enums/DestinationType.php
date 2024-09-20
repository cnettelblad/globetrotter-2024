<?php

namespace App\Enums;

enum DestinationType: string
{
    case COUNTRY = 'Country';
    case STATE = 'State';
    case OVERSEAS_TERRITORY = 'Overseas Territory';
    case OTHER = 'Other';
}
