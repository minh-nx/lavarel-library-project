<?php

namespace App\Custom\Traits;

use Illuminate\Support\Str;

trait Filterable
{
    /**
     * Scope a query to filter based on given param
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $param
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, $param)
    {
        foreach ($param as $field => $value) {
            $method = 'filter' . Str::studly($field);
    
            if ($value === '') {
                continue;
            }
    
            if (method_exists($this, $method)) {
                $this->{$method}($query, $value);
                continue;
            }
    
            if (empty($this->filterable) || !is_array($this->filterable)) {
                continue;
            }
    
            if (in_array($field, $this->filterable)) {
                $query->where($this->table . '.' . $field, $value);
                continue;
            }
    
            if (key_exists($field, $this->filterable)) {
                $query->where($this->table . '.' . $this->filterable[$field], $value);
                continue;
            }
        }
    
        return $query;
    }
}