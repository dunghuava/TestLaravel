<?php

namespace App\Http\Controllers;

interface SearchElastic {
    static function search($query = null);
}
