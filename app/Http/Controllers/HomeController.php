<?php

namespace App\Http\Controllers;
use Auth;
use Session;
use App\Category;
use App\Product;
use App\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['open_homepage','product_detail']]);
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
        $new_pro = Product::where('product_id',0)->orderBy('id', 'desc')->limit(3)->get();
        $latest_pro = Product::where('product_id',0)->where('category_id',1)->orderBy('id', 'desc')->limit(4)->get();
        $deals = DB::table('products')
                    ->select(DB::raw('compare_price-price as diff_price,FLOOR(((compare_price-price)/compare_price)*100) as discount,products.*'))
                    ->where('product_id',0)->orderby('diff_price','desc')->limit(4)->get();
        $women_deals = DB::table('products')
                    ->select(DB::raw('compare_price-price as diff_price,FLOOR(((compare_price-price)/compare_price)*100) as discount,products.*'))
                    ->where('product_id',0)->where('subcategory_id',7) ->orderby('diff_price','desc')->limit(3)->get();
        // dd($women_deals);

        return view('homePage')->with('new_pro',$new_pro)->with('latest_pro',$latest_pro)->with('top_deals',$deals)->with('women_deals',$women_deals);
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
        $images = [];
        foreach ($request->other_images as $photo) {
            $filename = $photo->store('public');
            $real_file_name =  explode('/',$filename);
            array_push($images,$real_file_name[1]);
        }
        $image_json =  json_encode($images);

        $main_image_path = $request->file('main_image')->store('public');
        $splitstr =  explode('/',$main_image_path);
        $pro = new Product; 
        $pro->category_id = $request->input('cat_name');
        $pro->subcategory_id = $request->input('sub_category');
        $pro->name = $request->input('product');
        $pro->description = $request->input('description');
        $pro->size = $request->input('size');
        $pro->price = $request->input('price');
        $pro->color = $request->input('color');
        $pro->compare_price = $request->input('comp_price');
        $pro->quantity = $request->input('quantity');
        $pro->main_image = $splitstr[1];
        $pro->highlights = $request->input('editor1');
        $pro->warranty = $request->input('warranty');
        $pro->other_images = $image_json;
        $pro->save();
        Session::flash('message', 'Product saved Successfully!!!'); 
        return redirect('/products-form');
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
        // dd($products['category_id']);
        $images = [];
        foreach ($request->other_images as $photo) {
            $filename = $photo->store('public');
            $real_file_name =  explode('/',$filename);
            array_push($images,$real_file_name[1]);
        }
        $image_json =  json_encode($images);

        $main_image_path = $request->file('main_image')->store('public');
        $splitstr =  explode('/',$main_image_path);
        $pro = new Product;
        $pro->product_id = $dycrypt_id;
        $pro->name = $request->input('variant_name');
        $pro->price = $request->input('price');
        $pro->size = $request->input('size');
        $pro->color = $request->input('color');
        $pro->compare_price = $request->input('comp_price');
        $pro->quantity = $request->input('quantity');
        $pro->main_image = $splitstr[1];
        $pro->description = $products['description'];
        $pro->category_id = $products['category_id'];
        $pro->highlights = $products['highlights'];
        $pro->warranty = $products['warranty'];
        $pro->subcategory_id = $products['subcategory_id'];
        $pro->other_images = $image_json;
        $pro->save();
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
        $product = Product::select(DB::raw('compare_price-price as diff_price,FLOOR(((compare_price-price)/compare_price)*100) as discount,products.*'))
                ->where('id',$dycrypt_id)->first();
        $product->other_images = json_decode($product->other_images);
        $variants =  Product::where('product_id',$dycrypt_id)->get();
        return view('frontend.productDetail')->with('product', $product)->with('variants', $variants);
    }
    
}
