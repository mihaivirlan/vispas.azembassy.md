<?php

namespace App\Http\Controllers;

use App\Cart;
use App\User;
use Illuminate\Http\Request;
use App\Filtre;
use Lang;
use App\Product;
use Validator;
use Illuminate\Support\Facades\Auth;
use Hash;
use Cookie;
use Mail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Input;

class CartController extends Controller
{
    function InsertInCart($id_product,$id_color=null,$id_size=null){

    }

   static function getProducts(){
        $name='name_'.Lang::getLocale();
        $string_id=\App\Http\Controllers\HomeController::getCookie();
        $products=Cart::join('products','products.id','=','cart.id_product')
            ->leftJoin('filtres','filtres.id','=','cart.id_color')
            ->join('categories','categories.id','=','products.id_category');
        if(Auth::guard('user')->check()){
            $products=$products->where('id_user',Auth::guard('user')->user()->id);
        }else{
            $products=$products->where('id_string',$string_id);
        }
        $products=$products->where('products.status',1)
            ->where('categories.status',1)
            ->select('products.*','cart.qty as qty','cart.id_color as id_color','cart.id_size as id_size','filtres.'.$name.' as color','cart.id as id_cart')
            ->get();

        return $products;
    }

    static function  setProductsLogin($id_user){
        $name='name_'.Lang::getLocale();
        $string_id=\App\Http\Controllers\HomeController::getCookie();
        $products=Cart::join('products','products.id','=','cart.id_product')
            ->leftJoin('filtres','filtres.id','=','cart.id_color')
            ->join('categories','categories.id','=','products.id_category');
        $products=$products->where('id_string',$string_id);
        $products=$products->where('products.status',1)
            ->where('categories.status',1)
            ->where('id_user','!=',$id_user)
            ->select('products.*','cart.qty as qty','cart.id_color as id_color','cart.id_size as id_size','filtres.'.$name.' as color','cart.id as id_cart')
            ->get();
        foreach($products as $item){
            $pr=Cart::where('id_product',$item->id)->where('id_color',$item->id_color)->where('id_size',$item->id_size)->where('id_user',$id_user)->first();
            if(!$pr){
                $obj=new Cart();
                $obj->id_product=$item->id;
                $obj->id_color=$item->id_color;
                $obj->id_size=$item->id_size;
                $obj->qty=$item->qty;
                $obj->id_user=$id_user;
                $obj->save();
            }
        }
    }

    function getCountCart(){

        $string_id=\App\Http\Controllers\HomeController::getCookie();
        $products=Cart::join('products','products.id','=','cart.id_product');
        if(Auth::guard('user')->check()){
            $products=$products->where('id_user',Auth::guard('user')->user()->id);
        }else{
            $products=$products->where('id_string',$string_id);
        }
        $products=$products->where('products.status',1)
            ->sum('cart.qty');
        if($products==0){
            session()->forget('discount');
        }
        return $products;
    }

    function AddCart(Request $request){
        $input=$request->all();

        $rules=[
            'id_product'=>'required|exists:products,id',
            'id_color'  =>'required|numeric',
            'id_size'   =>'required|numeric'
        ];
        $data['rs']='errors';
        $v=Validator::make($input,$rules);
        if($v->fails()){
            $data['messages']=$v->messages();
            echo \GuzzleHttp\json_encode($data);
            return;
        }
        $data['rs']=true;
        $id_string=\App\Http\Controllers\HomeController::getCookie();
        $product_exists=Cart::join('products','products.id','=','cart.id_product')
            ->where('products.status',1);
        if(Auth::guard('user')->check()){
            $product_exists=$product_exists->where('id_user',Auth::guard('user')->user()->id);
        }else{
            $product_exists=$product_exists->where('id_string',$id_string);
        }
        $product_exists=$product_exists->where('id_product',$input['id_product'])
                                        ->where('id_size',$input['id_size'])
                                        ->where('id_color',$input['id_color'])
                                        ->count();
        if($product_exists){
            $product=Cart::where('id_product',$input['id_product'])->where('id_color',$input['id_color'])->where('id_size',$input['id_size']);
            if(Auth::guard('user')->check()){
                $product=$product->where('id_user',Auth::guard('user')->user()->id);
            }else{
                $product=$product->where('id_string',$id_string);
            }
            $product=$product->increment('qty');
            $data['operation']='increment';
        }else{
            $product=new Cart();
            $product->id_product=$input['id_product'];
            $product->id_color=$input['id_color'];
            $product->id_size=$input['id_size'];
            if(Auth::guard('user')->check()){
                $product->id_user=Auth::guard('user')->user()->id;
            }else{
                $product->id_string=$id_string;
            }
            $product->save();
            $data['operation']='add';
        }

        $data['count']=$this->getCountCart();
        $data['rs']=true;

        echo \GuzzleHttp\json_encode($data);
    }

    function ChangeCart(Request $request){
        $input=$request->all();
        $rules=[
            'id'=>'required|exists:cart,id',
            'type'=>'required|numeric|min:0|max:3'
        ];
        $data['rs']='false';
        $v=Validator::make($input,$rules);
        if($v->fails()){
            $data['messages']=$v->messages();
            echo \GuzzleHttp\json_encode($data);
            return;
        }
        $id_string=\App\Http\Controllers\HomeController::getCookie();
        $item=Cart::find($input['id']);
        $ver=false;
        if(Auth::guard('user')->check()){
            if($item->id_user==Auth::guard('user')->user()->id){
                $ver=true;
            }
        }else{
            if($item->id_string==$id_string){
                $ver==true;
            }
        }

        if($ver){
            if($input['type']==1){//++
                $data['operation']='increment';
                $item->qty=$item->qty+1;
            }else if($input['type']==0){//--
                $data['operation']='decrement';
                $item->qty=$item->qty-1;
            }
        }
        $item->save();
        if($item->qty==0 || $input['type']==2){
            $item->delete();
            $data['operation']='deleted';
        }
        $data['count']=$this->getCountCart();
        $data['rs']=true;

        echo \GuzzleHttp\json_encode($data);

    }

    static function deleteProducts(){
        if(Auth::guard('user')->check()){
            Cart::where('id_user',Auth::guard('user')->user()->id)->delete();
        }else{
            $id_string=\App\Http\Controllers\HomeController::getCookie();
            Cart::where('id_user',0)->where('id_string',$id_string)->delete();
        }
    }
}
