<?php

namespace App\Helpers\Rmsp;

class BusinessTypeable
{
    public function __construct(
        public string $microBusiness,
        public string $smallBusiness,
        public string $mediumBusiness,
    )
    {
    }
}
