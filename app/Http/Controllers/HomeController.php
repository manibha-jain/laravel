<?php

namespace App\Http\Controllers;
use Auth;
use Session;
use App\Category;
use App\Product;
use App\Offer;
use App\Product_other_images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['open_homepage','product_detail','sub_product_list','filter_subproducts']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('ia m in');
        if(Auth::check() && Auth::user()->isAdmin()){
             return view('admin.dashboard');
        }else{
            return view('home');
        }    
    }

    public function open_homepage()
    {
        // dd('ia m in ');
        $category = Category::with('children')
                        ->where('category_id',0)
                        ->get()->toArray();

        $new_pro = Product::where('product_id',0)->orderBy('id', 'desc')->limit(3)->get();
        $latest_pro = Product::where('product_id',0)->where('category_id',1)->orderBy('id', 'desc')->limit(4)->get();
        $deals = DB::table('products')
                    ->select(DB::raw('compare_price-price as diff_price,FLOOR(((compare_price-price)/compare_price)*100) as discount,products.*'))
                    ->where('product_id',0)->orderby('diff_price','desc')->limit(4)->get();
        $women_deals = DB::table('products')
                    ->select(DB::raw('compare_price-price as diff_price,FLOOR(((compare_price-price)/compare_price)*100) as discount,products.*'))
                    ->where('product_id',0)->where('subcategory_id',7) ->orderby('diff_price','desc')->limit(3)->get();
        // dd($women_deals);

        return view('homePage')->with('new_pro',$new_pro)->with('latest_pro',$latest_pro)->with('top_deals',$deals)->with('women_deals',$women_deals)->with(
            'categories',$category);
    }

    public function open_widgets()
    {
        $cat =  DB::table('category')
                    ->leftjoin('offers', 'category.id', '=', 'offers.category_id')
                    ->select('category.*', 'offers.available_offers')
                    ->where('category.category_id',0)
                    ->get();

        return view('admin.categoryList')->with('catgs', $cat);
    }
    public function category_form()
    {
        return view('admin.widgets');
    }

    public function logout_user(){
        Auth()->logout();
        return redirect('/login');
    }
    public function save_category(Request $request){
        $cat = new Category; 
        $cat->name = $request->input('category');
        $cat->save();
        Session::flash('message', 'Category saved Successfully!!!'); 
        return redirect('/widgets-dash');
    }
    public function products_form()
    {
        $cat = Category::where('category_id',0)->get();
        $sub_cat = Category::where('category_id','<>',0)->get();
        return view('admin.products')->with('catgs', $cat)->with('sub_cat', $sub_cat);
    }

    public function save_product(Request $request){
        // dd('i am in',$request->file('other_images'));
        $main_image_name = uniqid().'.'.$request->file('main_image')->getClientOriginalExtension();
        $image =Image::make($request->file('main_image'));
        $destinationPath = public_path('/images');
        $image->save($destinationPath.'/'.$main_image_name);
        $thumb  = $this->save_product_images($request->file('main_image'));
        $pro = new Product;
        $pro->main_image = $main_image_name;
        $pro->big_thumbnail = $thumb[0];
        $pro->small_thumbnail = $thumb[1];
        $pro->category_id = $request->input('cat_name');
        $pro->subcategory_id = $request->input('sub_category');
        $pro->name = $request->input('product');
        if($request->has('description')){
            $pro->description = $request->input('description');
        }
        if($request->has('size')){
            $pro->size = $request->input('size');
        }
        if($request->has('warranty')){
            $pro->warranty = $request->input('warranty');
        }
        $pro->price = $request->input('price');
        $pro->color = $request->input('color');
        $pro->compare_price = $request->input('comp_price');
        $pro->quantity = $request->input('quantity');
        $pro->highlights = $request->input('editor1');
        $pro->save();

        foreach ($request->other_images as $photo) {

            $main_other_name = uniqid().'.'.$photo->getClientOriginalExtension();
            $image =Image::make($photo);
            $destinationPath = public_path('/images');
            $image->save($destinationPath.'/'.$main_other_name);

            $other_thumbs = $this->save_product_images($photo);
            $others = new Product_other_images;
            $others->product_id = $pro->id;
            $others->actual_image = $main_other_name;
            $others->big_thumbnail= $other_thumbs[0];
            $others->small_thumbnail = $other_thumbs[1];
            $others->save();
        }
        Session::flash('message', 'Product saved Successfully!!!'); 
        return redirect('/products-form');
    }


    public function save_product_images($image)
    {
        // big thumbnail

        $big_thumbnail = uniqid().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/thumbnails');
        $img = Image::make($image->getRealPath());
        $img->resize(200, 200, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$big_thumbnail);

        // small thumbnail
        $small_thumbnail = uniqid().'.'.$image->getClientOriginalExtension();
        $img->resize( 100, 100, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$small_thumbnail);
       
         return[$big_thumbnail,$small_thumbnail];

    }

    public function offers_form(){
        $cat = Category::all();
        return view('admin.offers')->with('catgs', $cat);
    }

    public function save_offer(Request $request)
    {
        $avail_offer = new Offer; 
        $avail_offer->category_id = $request->input('cat_name');
        $avail_offer->available_offers = $request->input('offers');
        $avail_offer->save();
        Session::flash('message', 'Offers saved Successfully!!!'); 
        return redirect('/offers-form');
    }


    public function product_list()
    {   
        $products =  DB::table('products')
                    ->join('category', 'category.id', '=', 'products.category_id')
                    ->select('products.*', 'category.name As category')
                    ->where('product_id',0)
                    ->get();
        // dd($products);
        return view('admin.productList')->with('products', $products);
    }

    public function variants_form($id)
    {
        $cat = Category::all();
        return view('admin.variants')->with('catgs', $cat)->with('pro_id', $id);
    }

    public function save_variant(Request $request)
    {

        $pro_id = $request->input('product_id');
        $dycrypt_id = Crypt::decrypt($pro_id);
        $products = Product::where('id',$dycrypt_id)->first();
        $pro = new Product;

        $main_image_name = uniqid().'.'.$request->file('main_image')->getClientOriginalExtension();
        $image =Image::make($request->file('main_image'));
        $destinationPath = public_path('/images');
        $image->save($destinationPath.'/'.$main_image_name);
        $thumb  = $this->save_product_images($request->file('main_image'));
        $pro->main_image = $main_image_name;
        $pro->big_thumbnail = $thumb[0];
        $pro->small_thumbnail = $thumb[1];
        $pro->product_id = $dycrypt_id;
        $pro->name = $request->input('variant_name');
        $pro->price = $request->input('price');
        $pro->color = $request->input('color');
        $pro->compare_price = $request->input('comp_price');
        $pro->quantity = $request->input('quantity');
        $pro->category_id = $products['category_id'];
        $pro->highlights = $products['highlights'];
        $pro->subcategory_id = $products['subcategory_id'];
         if($products['description']){
            $pro->description = $products['description'];
        }
        if($products['size']){
            $pro->size = $products['size'];
        }
        if($products['warranty']){
            $pro->warranty = $products['warranty'];
        }
        $pro->save();

        foreach ($request->other_images as $photo) {

            $main_other_name = uniqid().'.'.$photo->getClientOriginalExtension();
            $image =Image::make($photo);
            $destinationPath = public_path('/images');
            $image->save($destinationPath.'/'.$main_other_name);

            $other_thumbs = $this->save_product_images($photo);
            $others = new Product_other_images;
            $others->product_id = $pro->id;
            $others->actual_image = $main_other_name;
            $others->big_thumbnail= $other_thumbs[0];
            $others->small_thumbnail = $other_thumbs[1];
            $others->save();
        }

        Session::flash('message', 'Variant saved Successfully!!!'); 
        return redirect('/products');

    }

    public function subcat_form($cat_id)
    {
        return view('admin.subcategory')->with('cat_id', $cat_id);
    }
    public function save_subcategory(Request $request)
    {
        // dd($request->input());
        $dycrypt_id = Crypt::decrypt($request->input('cat_id'));
        $cat = new Category; 
        $cat->name = $request->input('category');
        $cat->category_id = $dycrypt_id;
        $cat->save();
        Session::flash('message', 'Sub Category saved Successfully!!!'); 
        return redirect('/widgets-dash');
    }

    public function variant_list($pro_id)
    {
        $dycrypt_id = Crypt::decrypt($pro_id);
        $variants = Product::where('product_id',$dycrypt_id)->get();
        return view('admin.variantList')->with('variants', $variants);
    }
    public function subcategory_list($cat_id)
    {
       $dycrypt_id = Crypt::decrypt($cat_id);
       $sub_category = Category::where('category_id',$dycrypt_id)->get();
       return view('admin.subcategoryList')->with('sub_category', $sub_category);
       // dd($sub_category);
    }
    public function product_detail($pro_id)
    {
        $dycrypt_id = Crypt::decrypt($pro_id);
        $categories = Category::with('children')
                        ->where('category_id',0)
                        ->get()->toArray();
        $variants =[];
        $product = Product::
                // ->join('product_other_images', 'product_other_images.product_id', '=', 'products.id')
                select(DB::raw('compare_price-price as diff_price,FLOOR(((compare_price-price)/compare_price)*100) as discount,products.*'))
                ->where('products.id',$dycrypt_id)->first();
        $other_images =  Product::where('id', $dycrypt_id)->first()->images->toArray();
        return view('frontend.productDetail')->with(compact('product','other_images','categories'));
    }

    public function sub_product_list($subcat_id)
    {   
        $max_price = 0;
        $categories = Category::with('children')
                        ->where('category_id',0)
                        ->get()->toArray();
        $subcategory_id = Crypt::decrypt($subcat_id);
        $products = Product::
                    select(DB::raw('compare_price-price as diff_price,FLOOR(((compare_price-price)/compare_price)*100) as discount,products.*'))
                    ->where('subcategory_id',$subcategory_id)->get();
        $colors = $products->map(function($item) {return $item['color'];})->toArray();
        $sizes = $products->map(function($item) {return $item['size'];})->toArray();
        $price = $products->map(function($item) {return $item['price'];})->toArray();
        $sizes = array_filter($sizes);
        $products = $products ->toArray();
        if($price){
            $max_price = max($price);
        }
        return view('frontend.subProductList')->with(compact('categories','products','colors','sizes','max_price','subcategory_id'));
    }
    
    public function filter_subproducts(Request $request)
    {   
        $colors = array();
        $subcategory_id = $request->input('subcategory_id');
        $product = Product::
                    select(DB::raw('compare_price-price as diff_price,FLOOR(((compare_price-price)/compare_price)*100) as discount,products.*'))
                    ->where('subcategory_id',$subcategory_id);
        $price = $request->input('price');
        $colors = $request->input('color');
        if($price != 0){
            $product = $product->where('price','<=',$price);
        }

        if( $colors != null && sizeof($colors) >= 0){
            for ($i=0; $i < sizeof($request->input('color')); $i++) { 
               $product = $product->orWhere('color','=',$colors[$i]);
            }
        }
        $product = $product->get()->toArray();
        return json_encode($product);
    }
}
