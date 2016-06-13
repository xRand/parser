<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $table = 'ads';
    protected $fillable = [
        'url',
        'img',
        'description',
        'model',
        'year',
        'capacity',
        'mileage',
        'price'
    ];

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function scopeSort($query, $option){
        switch ($option) {
            case 'price_desc':
                return $query->orderBy('price', 'desc');
            case 'date_desc':
                return $query->orderBy('created_at', 'desc');
            case 'date_asc':
                return $query->orderBy('created_at', 'asc');
            default:
                return $query->orderBy('price', 'asc');
        }
    }

    public function scopeFilter($query, $options){
        extract($options);

        if(!empty($price_min)) $query->where('price', '>=', $price_min);
        if(!empty($price_max)) $query->where('price', '<=', $price_max);

        if(!empty($year_min)) $query->where('year', '>=', $year_min);
        if(!empty($year_max)) $query->where('year', '<=', $year_max);

        if(!empty($mileage_min)) $query->where('mileage', '>=', $mileage_min);
        if(!empty($mileage_max)) $query->where('mileage', '<=', $mileage_max);

        if(!empty($cap_min)) $query->whereRaw('CAST(capacity AS DECIMAL) >= ' . $cap_min);
        if(!empty($cap_max)) $query->whereRaw('CAST(capacity AS DECIMAL) <= ' . $cap_max);

        return $query;
    }

    public function isDuplicate(){
        if(Ad::where('url', $this->url)->first()) {
            return true;
        } else if(Ad::where('model', $this->model)
                    ->where('year', $this->year)
                    ->where('price', $this->price)
                    ->whereBetween('mileage', [$this->mileage-2000, $this->mileage+2000])
                   // ->where('mileage', reset($mileage))
                    ->first()) {
            return true;
        } else {
            return false;
        }
    }

    public function save(array $options = [])
    {
        $query = $this->newQueryWithoutScopes();
        if ($this->fireModelEvent('saving') === false) {
            return false;
        }
        if ($this->exists) {
            $saved = $this->performUpdate($query, $options);
        }
        else {
            $saved = $this->performInsert($query, $options);
        }
        if ($saved) {
            $this->finishSave($options);
        }
        return $saved;
    }
}
