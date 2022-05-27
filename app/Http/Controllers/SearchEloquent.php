<?php

namespace App\Http\Controllers;

interface SearchEloquent
{
    public function search($query = null);
}
