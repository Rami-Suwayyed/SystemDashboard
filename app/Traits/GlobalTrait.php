<?php

namespace App\Traits;

use App\Models\Languages;

trait GlobalTrait {

    public function getAllLanguages()
    {
        // Fetch all the settings from the 'settings' table.
        $languages = Languages::all();
        return $languages;
    }
}
