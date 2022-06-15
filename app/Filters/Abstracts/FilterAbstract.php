<?php

declare(strict_types=1);

namespace App\Filters\Abstracts;

abstract class FilterAbstract
{
    public abstract function handle(): array;
}