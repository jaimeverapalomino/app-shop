<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

	public static $messages = [
        'name.required' => 'Es necesario ingresar un nombre para la categoría.',
        'name.min' => 'El nombre de la categoría debe contener al menos 3 caracteres.',
        'description.required' => 'Es necesario ingresar una descripción para la categoría.',
        'description.max' => 'La categoría del produto debe contener como 250 caracteres.',
    ];  

    public static $rules = [
        'name' => 'required|min:2',
        'description' => 'required|max:250',
    ];

	protected $fillable = ['name', 'description'];


    // $category->products
    public function products()
    {
    	return $this->hasMany(Product::class); 
    }
}
