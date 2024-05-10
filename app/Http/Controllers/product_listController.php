<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use Ramsey\Uuid\Uuid;

use App\Models\Product;
use App\Models\Category;
use App\Models\Series;


class product_listController extends Controller
{
    public function index(Request $request)
    {
        $auth_user = Auth::user();
        $categories = Category::all();
        $series = Series::all();


        $products = DB::table('products')->paginate(8);

      // Search
        if ($request->has('search')) {
            $search = $request->input('search');

            // search title, author
            $products = DB::table('products')->where(function ($query) use ($search){
                $query->where('name', 'ilike', "%$search%")
                    ->orWhere('author', 'ilike', "%$search%")
                    ->orWhere('description', 'ilike', "%$search%");
            })->paginate(8);
        }

        // Filter
        if ($request->has('filter-range-price-min')){
            $filterPriceMin = $request->input('filter-range-price-min');
            $filterPriceMax = $request->input('filter-range-price-max');
            $filterOrderBy = $request->input('product-list-order-by');
            $filterCategory = $request->input('category');
            $filterSeries = $request->input('series');

            $products = DB::table('products')->whereBetween('price', [$filterPriceMin, $filterPriceMax]);

            if($filterCategory == null){
                $filterCategory = Category::all()->pluck('id')->toArray();
            }
            else{
                $filterCategory = Category::all()->whereIn('name', $filterCategory)->pluck('id')->toArray();
            }

            if($filterSeries == null){
                $filterSeries = Series::all()->pluck('id')->toArray();
            }
            else{
                $filterSeries = Series::all()->whereIn('name', $filterSeries)->pluck('id')->toArray();
            }


            $products = $products->where(function ($query) use($filterCategory, $filterSeries){
                $query->whereIn('category_id', $filterCategory)
                    ->whereIn('series_id', $filterSeries);
            });

            // ORDERING
            if($filterOrderBy == 'az_asc'){
                $products->orderBy('name', 'asc');
            }
            elseif ($filterOrderBy == 'az_desc'){
                $products->orderBy('name', 'desc');
            }
            elseif ($filterOrderBy == 'pri_hi_lo'){
                $products->orderBy('price', 'desc');
            }
            elseif ($filterOrderBy == 'pri_lo_hi'){
                $products->orderBy('price', 'asc');
            }
            elseif ($filterOrderBy == 'disc_hi_lo'){
                $products->orderBy('discount', 'desc');
            }

            $products = $products->paginate(8);
        }

        $products->appends($request->all());


        return view('product_list', [
            'auth_user' => $auth_user,
            'categories' => $categories,
            'series' => $series,
            'products' => $products,
        ]);
    }

    public function addProduct(Request $request)
    {
        $newProduct = new Product;

        $newProduct->category_id = $request->category_select;
        $newProduct->series_id = $request->series_select;

        $newProduct->name = $request->name;
        $newProduct->author = strtoupper($request->author);     // optional
        $newProduct->pages = $request->pages;                   // optional
        $newProduct->publisher = $request->publisher;
        $newProduct->dimensions = $request->dimensions;

        $newProduct->price = $request->price;
        $newProduct->discount = $request->discount;

        $newProduct->stock = $request->stock;

        $newProduct->description = $request->description;

        $request->validate([
            'main_img' => 'required|mimes:jpg,png',
            'side_img_1' => 'required|mimes:jpg,png',
            'side_img_2' => 'required|mimes:jpg,png'
        ]);


        $tmp = $request->file('main_img')->storeAs('public/products', $request->main_img->getClientOriginalName());
        $tmp1 = $request->file('side_img_1')->storeAs('public/products', $request->side_img_1->getClientOriginalName());
        $tmp2 = $request->file('side_img_2')->storeAs('public/products', $request->side_img_2->getClientOriginalName());

        $newProduct->main_img = $request->main_img->getClientOriginalName();
        $newProduct->side_img_1 = $request->side_img_1->getClientOriginalName();
        $newProduct->side_img_2 = $request->side_img_2->getClientOriginalName();

        $newProduct->save();

        return redirect()->route('products', ['page'=>0])->with('success', 'Product added');
    }

    public function addCategory(Request $request)
    {

        // check if category already exists
        $checkIfExists = DB::table('categories')->where('name', 'ilike', $request->name)->count();
        if ($checkIfExists == 0){
            $newCategory = new Category;
            $newCategory->name = $request->name;
            $newCategory->save();

            return redirect()->route('products', ['page'=>0])->with('success', 'Category added');
        }
        else{
            return redirect()->route('products', ['page'=>0])->with('failure', 'Failure: Category already exists');
        }


    }

    public function addSeries(Request $request)
    {

        // check if series already exists
        $checkIfExists = DB::table('series')->where('name', 'ilike', $request->name)->count();
        if ($checkIfExists == 0){
            $newSeries = new Series;
            $newSeries->name = $request->name;
            $newSeries->save();

            return redirect()->route('products', ['page'=>0])->with('success', 'Series added');
        }
        else{
            return redirect()->route('products', ['page'=>0])->with('failure', 'Failure: Series already exists');
        }
    }

    public function editProduct(Request $request)
    {
        $product = Product::where('id', $request->input('product_id'))->first();

        if ($request->input("action") == "update"){
            $product->category_id = $request->category_select;
            $product->series_id = $request->series_select;

            $product->name = $request->edit_title;
            $product->author = $request->edit_author;     // optional

            $product->pages = $request->edit_pages;       // optional
            $product->publisher = $request->edit_publisher;
            $product->dimensions = $request->edit_dimensions;
            $product->price = $request->edit_price;
            $product->discount = $request->edit_discount;
            $product->stock = $request->edit_stock;
            $product->description = $request->edit_description;

            if ($request->edit_main_img != null){
                if(Storage::exists('public/products/'.$product->main_img)){
                    Storage::delete('public/products/'.$product->main_img);
                }
                $tmp = $request->file('edit_main_img')->storeAs('public/products', $request->edit_main_img->getClientOriginalName());
                $product->main_img = $request->edit_main_img->getClientOriginalName();
            }
            if ($request->edit_side_img_1 != null){
                if(Storage::exists('public/products/'.$product->side_img_1)){
                    Storage::delete('public/products/'.$product->side_img_1);
                }
                $tmp1 = $request->file('edit_side_img_1')->storeAs('public/products', $request->edit_side_img_1->getClientOriginalName());
                $product->side_img_1 = $request->edit_side_img_1->getClientOriginalName();
            }
            if ($request->edit_side_img_2 != null){
                if(Storage::exists('public/products/'.$product->side_img_2)){
                    Storage::delete('public/products/'.$product->side_img_2);
                }
                $tmp2 = $request->file('edit_side_img_2')->storeAs('public/products', $request->edit_side_img_2->getClientOriginalName());
                $product->side_img_2 = $request->edit_side_img_2->getClientOriginalName();
            }

            $product->save();

            return redirect()->route('products', ['page'=>0])->with('update', 'Product updated');
        }
        elseif ($request->input("action") == "delete"){

            $product->delete();

            if(Storage::exists('public/products/'.$product->main_img)){
                Storage::delete('public/products/'.$product->main_img);
            }
            if(Storage::exists('public/products/'.$product->side_img_1)){
                Storage::delete('public/products/'.$product->side_img_1);
            }
            if(Storage::exists('public/products/'.$product->side_img_2)){
                Storage::delete('public/products/'.$product->side_img_2);
            }

            return redirect()->route('products', ['page'=>0])->with('update', 'Product deleted');
        }

    }


    public function searchProduct(Request $request)
    {

        return $this->index($request);
    }

    public function filterProduct(Request $request)
    {

        return $this->index($request);

    }
}