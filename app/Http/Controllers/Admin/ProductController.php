<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use App\Category;

class ProductController extends Controller
{
    public function index()
    {
      $products = Product::paginate(10);
      return view('admin.products.index')->with(compact('products')); // listado de productos
    }

    public function create()
    {
      $categories = Category::orderBy('name')->get();
      return view('admin.products.create')->with(compact('categories')); 
    }

    public function store(Request $request) //registrar producto en DB
    {
      //registrar el nuevo producto en la bd
      // dd($request-all());

      //validar
      $messages = [
        'name.required' => 'Es necesario ingresar un nombre para el producto.',
        'name.min' => 'El nombre del produto debe contener al menos 3 caracteres.',
        'descripcion.required' => 'Es necesario ingresar una descripción para el producto.',
        'descripcion.max' => 'La categoría del produto debe contener como 200 caracteres.',
        'price.required' => 'Es necesario ingresar un precio para el producto.',
        'price.numeric' => 'Ingrese un precio válido.',
        'price.min' => 'El precio del producto debe ser mayor a cero.',
        'category_id.required' => 'Es necesario seleccionar una categoría para el producto.'
      ];  

      $rules = [
        'name' => 'required|min:2',
        'descripcion' => 'required|max:200',
        'price' => 'required|numeric|min:0',
        'category_id' => 'required'

      ];

      $this->validate($request, $rules, $messages);

      //Guardar en BD
      $product = new Product();
      $product->name = $request->input('name');
      $product->descripcion = $request->input('descripcion');
      $product->long_descripcion = $request->input('long_descripcion');
      $product->price = $request->input('price');
      $product->category_id = $request->category_id;
      $product->save(); //INSERT

      return redirect('admin/products');
    }

    public function edit($id)
    {
      $categories = Category::orderBy('name')->get();
      $product = Product::find($id);
      return view('admin.products.edit')->with(compact('product', 'categories')); 
    }

    public function update(Request $request, $id) //actualizar producto en DB
    {
      // dd($request-all());
      
      //validar
      $messages = [
        'name.required' => 'Es necesario ingresar un nombre para el producto.',
        'name.min' => 'El nombre del produto debe contener al menos 3 caracteres.',
        'descripcion.required' => 'Es necesario ingresar una descripción para el producto.',
        'descripcion.max' => 'La categoría del produto debe contener como 200 caracteres.',
        'price.required' => 'Es necesario ingresar un precio para el producto.',
        'price.numeric' => 'Ingrese un precio válido.',
        'price.min' => 'El precio del producto debe ser mayor a cero.'
      ];  

      $rules = [
        'name' => 'required|min:2',
        'descripcion' => 'required|max:200',
        'price' => 'required|numeric|min:0'
      ];

      $this->validate($request, $rules, $messages);

      //Guardar en BD
      $product = Product::find($id);
      $product->name = $request->input('name');
      $product->descripcion = $request->input('descripcion');
      $product->long_descripcion = $request->input('long_descripcion');
      $product->price = $request->input('price');
      $product->category_id = $request->category_id;
      $product->save(); //INSERT

      return redirect('admin/products');
    }

    public function destroy($id) //actualizar producto en DB
    {
      ProductImage::where('product_id', $id)->delete();

      $product = Product::find($id);
      $product->delete();

      return redirect('admin/products');
    }

}