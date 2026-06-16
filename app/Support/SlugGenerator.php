<?php

namespace App\Support;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SlugGenerator
{
    /**
     * @param  class-string<Model>  $modelClass
     */
    public static function generate(string $base, string $modelClass, ?int $exceptId = null): string
    {
        $slug = Str::slug($base);
        $original = $slug;
        $suffix = 1;

        while ($modelClass::query()
            ->when($exceptId, fn ($query) => $query->whereKeyNot($exceptId))
            ->where('slug', $slug)
            ->exists()) {
            $slug = $original.'-'.$suffix++;
        }

        return $slug;
    }
}
