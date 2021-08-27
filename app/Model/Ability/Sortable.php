<?php

namespace App\Model\Ability;

use Illuminate\Database\Eloquent\Builder;

trait Sortable {
    public function scopeSort(Builder $builder, string $column, string $direction = 'asc'): Builder {
        $fields = $this->sortable ?? [];
        $encoding = $this->sortEncoding ?? 'utf8';
        if (in_array($column, $fields)) {
            return $builder->orderByRaw('convert(' . $column . ' using ' . $encoding . ') ' . $direction);
        }
        else {
            return $builder->orderBy($column, $direction);
        }
    }
}
