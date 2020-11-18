<?php


namespace App\Repo\Contracts;


use Illuminate\Support\Collection;

interface CategoryInterface
{
    public function all(): Collection;

}
