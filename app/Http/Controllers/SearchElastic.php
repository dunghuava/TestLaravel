<?php

namespace App\Http\Controllers;

interface SearchElastic
{
    public function search($query = null);
}
