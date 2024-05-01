<?php

namespace App\Enums;

enum WorksheetType : string
{
    case MONEY_BY_FORMS = 'Кол-во средств, по регионам';
    case PEOPLE_BY_FORMS = 'Кол-во получателей поддержки, по формам поддержки';
    case PEOPLE_BY_REGIONS = 'Кол-во получателей поддержки, по регионам';
}
