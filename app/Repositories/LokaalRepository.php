<?php

namespace App\Repositories;

use App\Models\Werkpunten;
use Illuminate\Database\Eloquent\Model;

class LokaalRepository extends Model
{
    public function getWerkpuntenOpen(bool $indicator)
    {
        return Werkpunten::whereLokalenId($this->id)->isOpen($indicator)->simplePaginate();
    }
}