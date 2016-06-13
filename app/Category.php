<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['name'];

    public function scopeFindById($query, $id)
    {
        $category = $query->where('id', '=', $id)->first();
        if (is_null($category)) {
            abort(404);
        }
        return $category;
    }

    public function scopeFindByName($query, $name)
    {
        $category = $query->where('name', '=', $name)->first();
        if (is_null($category)) {
            abort(404);
        }
        return $category;
    }

    public static function all($columns = ['*'])
    {
        $columns = is_array($columns) ? $columns : func_get_args();
        $instance = new static;
        return $instance->newQuery()->get($columns);
    }

    public function ads()
    {
        return $this->hasMany('App\Ad');
    }



    protected $categories = [
        'Alfa Romeo', 'Audi', 'BMW', 'Cadillac', 'Chevrolet', 'Chrysler', 'Citroen', 'Dacia', 'Daewoo',
        'Daihatsu', 'Dodge', 'Fiat', 'Ford', 'Honda', 'Hummer', 'Hyundai', 'Infiniti', 'Isuzu', 'Jaguar', 'Jeep',
        'Kia', 'Lancia', 'Land Rover', 'Lexus', 'Lincoln', 'Mazda', 'Mercedes', 'Mini', 'Mitsubishi', 'Nissan',
        'Opel', 'Peugeot', 'Pontiac', 'Porsche', 'Renault', 'Rover', 'Saab', 'Seat', 'Skoda', 'Smart', 'SsangYong',
        'Subaru', 'Suzuki', 'Toyota', 'Volkswagen', 'Volvo', 'Ваз', 'Газ', 'Заз', 'Иж', 'Москвич', 'Уаз'
    ];

    protected function fillDatabase(){
        foreach ($this->categories as $category) {
            $cat = new Category();
            $cat->name = $category;
            $cat->save();
        }
    }
}
