<?php

namespace App\Http\Controllers;

use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use App;
use Illuminate\View\View;
use Intervention\Image\Size;
use League\Flysystem\Exception;
use Validator;
use Mail;
use Image;
use Illuminate\Support\Facades\File;
use Lang;
use Illuminate\Validation\Rule;
use App\Page;
use Config;
use App\Slider;
use App\News;
use App\Contact;
use App\HotelRoom;
use Illuminate\Support\Facades\Schema;
use App\Category;
use App\Partner;
use App\Gallery;
use App\Section;
use App\SectionList;
use App\RoomBook;
use App\ConferenceHall;
use App\Achievement;
use Illuminate\View\Factory;


class AdminController extends Controller
{
    static $lang_data=['ro'=>'RO','ru'=>'RU','en'=>'EN'];

    public function __construct(){
        $this->middleware('admin');
    }

    function Admin(){

        return view('admin.admin');
    }




    //=================NEWS===========================//
    function NewGet($id=null)
    {
        if(is_null($id)){
            return view('admin.news.new');
        }
            $item=News::findOrFail($id);
            return view('admin.news.new',compact('item'));

    }
    function NewPost(Request $request){
        $input=$request->all();
        $rules=[
            'title_ro'               =>'required|max:255|string',
            'title_ru'               =>'required|max:255|string',
            'meta_description_ro'   =>'nullable|max:255|string',
            'meta_description_ru'   =>'nullable|max:255|string',
            'mini_description_ro'   =>'nullable|string|max:350',
            'mini_description_ru'   =>'nullable|string|max:350',
            'description_ro'        =>'nullable|string',
            'description_ru'        =>'nullable|string',
            'id'                    =>'exists:news,id',
            'image'                    =>'text'

        ];
        $v=Validator::make($input,$rules);
        if($v->fails()){
            return back()->withInput()->withErrors($v);
        }
        if(isset($input['id'])){
            $new=News::find($input['id']);
        }else{
            $new=new News();
        }

        $data=['title_','meta_description_','description_','mini_description_','slug_', 'image'];

        $new=$this->getInput($new,$input,$data);
        $new->status=$input['status'];
        if($new->save()){
            $image='image';
           if($request->hasFile($image)) {
                        $img=$request->file($image);

                        if (!empty($new->$image) && isset($input[$image])) {

                            if (file_exists(public_path() . '/images/news/' . ($new->id) . '/' . $new->$image)) {

                                unlink(public_path() . '/images/news/' . ($new->id) . '/' . $new->$image);

                            }
                        }
                        if(!is_null($img)){

                            $origName = $img->getClientOriginalExtension();
                            $nameImg = str_random(10) . '.' . $origName;
                            $new->$image=$nameImg;
                            $image = \Image::make($img);
                            $path =public_path().'/images/news/'.($new->id) . '/';
                            list($width, $height) = getimagesize($img);
                            if( $width > 400 )
                            {
                                $image->resize(400, null, function ($constraint) {
                                    $constraint->aspectRatio();
                                });
                            }
                            if(!File::exists($path)){
                                File::makeDirectory($path);
                            }

                            $image->save($path.$nameImg);

                            $new->save();

                        }


            }
            $input['id']=$new->id;
            $new=$this->insertSlug($new,$input,new News());
            $new->save();
            return  redirect()->route('admin/news')->with('success',trans('trans.data_save'));
        }
    }
    function NewsDelete(Request $request){
        $input=$request->all();
        $rules=[
            'id'    =>'required|exists:news,id'
        ];
        $v=Validator::make($input,$rules);
        if($v->fails()){
            return back()->withErrors($v);
        }

        $new=News::find($input['id']);
        $image='image';
        if (!empty($new->$image)) {
            if (file_exists(public_path() . '/images/news/' . ($new->id) . '/' . $new->$image)) {
                unlink(public_path() . '/images/news/' . ($new->id) . '/' . $new->$image);

            }
        }
        if($new->delete()){
            return back()->with('success',trans('trans.data_delete'));
        }else {
            return back()->withErrors($new->delete());
        }


    }

    //=================NEWS===========================//

    function insertSlug($item,&$input,$model){
        foreach(self::$lang_data as $lang=>$key){
            $slug='slug_'.$lang;
            if(empty($input[$slug])){
                $name=isset($input['name_'.$lang])? str_slug($input['name_'.$lang]) : str_slug($input['title_'.$lang]);
                $temp=$model::where($slug,$name)->where('id','!=',$input['id'])->first();
                if($temp){
                    $input['exists_slug']=true;
                    $item->$slug=$name.'-'.$input['id'];
                }else{
                    $input['exists_slug']=false;
                    $item->$slug=$name;
                }
            }else{
                $temp=$model::where('id','!=',$input['id'])->where($slug,$input[$slug])->first();
                if($temp){
                    $input['exists_slug']=true;
                    $item->$slug=$input[$slug].'-'.$input['id'];
                }else{
                    $input['exists_slug']=false;
                    $item->$slug=$input[$slug];
                }
            }
        }
        return $item;
    }
    function setSort(&$item,$input,$object){
        if(empty($input['sort'])){
            $max=$object;
            if(isset($input['id_parent'])){
                $max=$max->where('id_parent',$input['id_parent'])->max('sort');
            }else {
                $columns = Schema::getColumnListing($object->getTable());

                if (in_array('id_parent',$columns)) {
                    $max=$max->where('id_parent',0)->max('sort');
                } else {
                    $max=$max->max('sort');
                }
            }

            $item->sort=$max+1;
        }else{
            $item->sort=$input['sort'];
        }
        return $item;
    }


    function getInput(&$item,$input,$data){
        foreach($data as $value){
            foreach(self::$lang_data as $lang=>$va){
                $temp=$value.$lang;
                if(isset($input[$temp])){
                    $item->$temp=$input[$temp];
                }
            }
        }

        return $item;
    }


    function Contacts(){
        $item=Contact::first();
        return view('admin.contacts',compact('item'));
    }

    function ContactsPost(Request $request){
        $input=$request->all();
        $rules=[

            'phone'    =>'nullable|string|max:25',
            'fax'    =>'nullable|string|max:25',
            'map'    =>'required|string',
            'skype'  =>'nullable|string|max:255',
            'fb'        =>'nullable|url',
            'ok'        =>'nullable|url',
            'wk'        =>'nullable|url',
            'twitter'        =>'nullable|url',
            'google'        =>'nullable|url',
            'email'        =>'required|email',
        ];
        $v=Validator::make($input,$rules);
        if($v->fails()){
            return back()->withInput()->withErrors($v);
        }

        $item=Contact::first();
        $data=['phone','fax','map','skype','fb','ok','wk','twitter','google','email'];
        foreach($data as $t){
            $item->$t=$input[$t];
        }
        $item->save();
        return back()->with('success',trans('trans.data_save'));
    }


    //====================SLIDER===================//
    function Sliders(){

        $slider=Slider::orderBy('id','desc')->get();

        return view('admin.sliders.sliders',compact('slider'));
    }
    function Slider($id=null){
        if(is_null($id)){
            return view('admin.sliders.slider');
        }else{
            $rules=['id'=>'required|exists:sliders,id'];
            $v=Validator::make(['id'=>$id],$rules);
            if($v->fails()){
                return back()->withErrors($v);
            }

            $item=Slider::find($id);
            return view('admin.sliders.slider',compact('item'));
        }
    }
    function PostSlider(Request $request)
    {
        $input = $request->all();
        $rules = [
            'url_ro' => 'nullable|max:255|url',
            'url_ru' => 'nullable|max:255|url',
            'url_en' => 'nullable|max:255|url',
            'text_ro' => 'nullable|string|max:300',
            'text_ru' => 'nullable|string|max:300',
            'text_en' => 'nullable|string|max:300',
            'name_ro' => 'nullable|string|max:170',
            'name_ru' => 'nullable|string|max:170',
            'name_en' => 'nullable|string|max:170',
            'sort' => 'nullable|numeric',
            'status'    =>'required|boolean',
            'id' => 'numeric|exists:sliders,id',

        ];
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        $fields = ['url_', 'text_', 'name_'];

        if (isset($input['id'])) {

            $item = Slider::find($input['id']);
        } else {

            $item = new Slider();
        }

        foreach (self::$lang_data as $lang => $value) {
            {
                foreach ($fields as $item2) {
                    $field = $item2 . $lang;
                    $item->$field = isset($input[$item2 . $lang])?$input[$item2 . $lang]:'' ;
                }
            }
        }
        $item->status = isset($input['status']) ? 1 : 0;

        if (empty($input['sort'])) {
            $max = Slider::max('sort');
            $item->sort = $max + 1;
        } else {
            $item->sort = $input['sort'];
        }

        $item->status = $input['status'];

        if ($item->save()) {
                $image1='image';
                if(isset($input[$image1]) && !empty($input[$image1] )){
                    if ((file_exists(public_path() . '/images/slider/' . $item->id . '/' . $item->$image1) && !empty($item->$image1))) {
                        unlink(public_path() . '/images/slider/' . $item->id . '/' . $item->$image1);
                    }

                    $img=$request->file($image1);
                    $origName = $img->getClientOriginalExtension();
                    $nameImg = str_random(10) . '.' . $origName;
                    $item->$image1=$nameImg;
                    $image_edit = Image::make($img);
                    $path =public_path().'/images/slider/' . ($item->id) . '/';
                    list($width, $height) = getimagesize($img);

                    if( $width > 1920 )
                    {
                        $image_edit->resize(1920, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }

                    if(!File::exists($path)){
                        File::makeDirectory($path);
                    }
                    $image_edit->save($path.$nameImg);

                }


            $item->save();
            return redirect()->route('admin/sliders')->with('success', trans('trans.data_save'));
        } else {
            return back()->withErrors($item->save());
        }


    }
    function DeleteSlider(Request $request){
        $input=$request->all();
        $rules=['id' =>'exists:sliders,id|numeric|required'];
        $validator=Validator::make($input,$rules);
        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $slider=Slider::find($input['id']);
        foreach (self::$lang_data as $lang => $value) {
            $id=$slider->id;
            $image="image_".$lang;

            //TODO: issue with windows path separators
            if (file_exists(public_path() . '/images/slider/' . $id . '/' . $slider->$image)) {
                /*unlink*/(public_path() . '/images/slider/' . $id . '/' . $slider->$image);

            }

        }
        if($slider->delete()){
            return back()->with('success',trans('trans.data_delete'));
        }else {
            return back()->withErrors($slider->delete());
        }
    }

    //====================SLIDER===================//


    //====================HOTELROOMS===================//

    function HotelRooms(){
        $items=HotelRoom::orderBy('id','desc')->get();
        return view('admin.hotel_rooms.hotel_rooms',compact('items'));
    }

    function HotelRoom($id=null){
        if(is_null($id)){
            return view('admin.hotel_rooms.hotel_room');
        }

        $item=HotelRoom::findOrFail($id);
        return view('admin.hotel_rooms.hotel_room',compact('item'));
    }

    function HotelRoomPost(Request $request){
        $input=$request->all();
        $rules=[
            'id'            =>'exists:hotel_rooms,id',
            'title_ro'      =>'required|string|max:255',
            'title_ru'      =>'required|string|max:255',
            'title_en'      =>'required|string|max:255',
            'meta_description_ro' =>'nullable|string|max:255',
            'meta_description_ru' =>'nullable|string|max:255',
            'meta_description_en' =>'nullable|string|max:255',
            'mini_description_ro' =>'required|string|max:255',
            'mini_description_ru' =>'required|string|max:255',
            'mini_description_en' =>'required|string|max:255',
            'slug_ro'             =>'nullable|string|max:255',
            'slug_ru'             =>'nullable|string|max:255',
            'slug_en'             =>'nullable|string|max:255',
            'status'              =>'required|boolean',
            'price'               =>'required|numeric',
            'persons'             =>'required|numeric',
        ];
        $v=Validator::make($input,$rules);
        if($v->fails()){
            return back()->withInput()->withErrors($v);
        }

        if(isset($input['id'])){
            $item=HotelRoom::findOrFail($input['id']);
        }else{
            $item=new HotelRoom();
        }

        $data=['title_','meta_description_','mini_description_','description_','service_'];
        $item=$this->getInput($item,$input,$data);
        $item->status=$input['status'];
        $item->price=$input['price'];
        $item->persons=$input['persons'];
        $item->save();
        $input['id']=$item->id;
        $item=$this->insertSlug($item,$input,new HotelRoom());
        for($inc=1;$inc<=4;$inc++){
            $image='image_'.$inc;
            if($request->hasFile($image)) {
                $img=$request->file($image);

                if (!empty($item->$image) && isset($input[$image])) {

                    if (file_exists(public_path() . '/images/hotel_rooms/' . ($item->id) . '/' . $item->$image)) {

                        unlink(public_path() . '/images/hotel_rooms/' . ($item->id) . '/' . $item->$image);

                    }
                }
                if(!is_null($img)){

                    $origName = $img->getClientOriginalExtension();
                    $nameImg = str_random(10) . '.' . $origName;
                    $item->$image=$nameImg;
                    $image = \Image::make($img);
                    $path =public_path().'/images/hotel_rooms/'.($item->id) . '/';
                    list($width, $height) = getimagesize($img);
                    if( $width > 1500 )
                    {
                        $image->resize(1500, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }
                    if(!File::exists($path)){
                        File::makeDirectory($path);
                    }

                    $image->save($path.$nameImg);

                    $item->save();

                }


            }
        }
        $item->save();
        return redirect()->route('admin/hotel_rooms')->with('success',trans('trans.data_save'));
    }

    function HotelRoomsDelete(Request $request){
        $input=$request->all();
        $item=HotelRoom::findOrFail($input['id']);
        for($inc=1;$inc<=4;$inc++){
            $image='image_'.$inc;


                if (!empty($item->$image)) {

                    if (file_exists(public_path() . '/images/hotel_rooms/' . ($item->id) . '/' . $item->$image)) {

                        unlink(public_path() . '/images/hotel_rooms/' . ($item->id) . '/' . $item->$image);

                    }
                }

        }
        $item->delete();
        return back()->with('success',trans('trans.data_delete'));
    }




    //====================CATEGORIES===================//

    function Categories(){
        $items=Category::orderBy('sort','asc')->get();
        return view('admin.categories.categories',compact('items'));
    }

    function CategoriesDelete($id = null) {

        if ($id) {
            Category::where('id', '=', $id)->delete();
        }

        $items = Category::orderBy('sort', 'asc')->get();
        return view('admin.categories.categories',compact('items'));
    }

    function Category($id=null){
        if($id) {
            $item = Category::findOrFail($id);
            return view('admin.categories.category', compact('item'));
        } else {
            return view('admin.categories.category');
        }
    }

    function AddCategory() {
        return view('admin.categories.category');
    }

    function SaveCategory(Request $request) {

        $myCategory = new Category();
        $myCategory->title_ro = $request->input('title_ro');
        $myCategory->title_ru = $request->input('title_ru');
        $myCategory->title_en = $request->input('title_en');
        $myCategory->meta_description_ro = $request->input('meta_description_ro');
        $myCategory->meta_description_ru = $request->input('meta_description_ru');
        $myCategory->meta_description_en = $request->input('meta_description_en');
        $myCategory->slug_ro = $request->input('slug_ro');
        $myCategory->slug_ru = $request->input('slug_ru');
        $myCategory->slug_en = $request->input('slug_en');
        $myCategory->mini_description_ro = $request->input('mini_description_ro');
        $myCategory->mini_description_ru = $request->input('mini_description_ru');
        $myCategory->mini_description_ro = $request->input('mini_description_en');
        $myCategory->description_ro = $request->input('description_ro');
        $myCategory->description_ru = $request->input('description_ru');
        $myCategory->description_en = $request->input('description_en');
        $myCategory->status = $request->input('status');
        $myCategory->service_ro = $request->input('service_ro');
        $myCategory->service_ru = $request->input('service_ru');
        $myCategory->service_en = $request->input('service_en');
        $myCategory->image_1 = $request->input('image_1');
        $myCategory->image_2 = $request->input('image_2');
        $myCategory->image_3 = $request->input('image_3');
        $myCategory->image_4 = $request->input('image_4');
        $myCategory->created_at = $request->input('created_at');
        $myCategory->updated_at = $request->input('updated_at');
        $myCategory->sort = $request->input('sort');
        $myCategory->menu = $request->input('menu');


        $myCategory->save();


        return redirect()->route('admin/categories')->with('success',trans('trans.data_save'));
    }


    function CategoryPost(Request $request){
        $input=$request->all();
        $rules=[
          //  'id'            =>'required|exists:categories,id',
            'title_ro'      =>'required|string|max:255',
            'title_ru'      =>'required|string|max:255',
            'title_en'      =>'required|string|max:255',
            'meta_description_ro' =>'nullable|string|max:255',
            'meta_description_ru' =>'nullable|string|max:255',
            'meta_description_en' =>'nullable|string|max:255',
            'mini_description_ro' =>'required|string|max:255',
            'mini_description_ru' =>'required|string|max:255',
            'mini_description_en' =>'required|string|max:255',
            'slug_ro'             =>'nullable|string|max:255',
            'slug_ru'             =>'nullable|string|max:255',
            'slug_en'             =>'nullable|string|max:255',
            'status'              =>'required|boolean',
            'sort'                  =>'nullable|numeric',
            'menu'                  =>'required|boolean',
        ];
        $v=Validator::make($input,$rules);
        if($v->fails()){
            return back()->withInput()->withErrors($v);
        }

        $item = Category::findOrFail($input['id']);
        $item=$this->setSort($item,$input,new Category());
        $data=['title_','meta_description_','mini_description_','description_','service_'];
        $item=$this->getInput($item,$input,$data);
        $item->status=$input['status'];
        $item->menu=$input['menu'];
        $item->save();

        $input['id'] = $item->id;

        $item=$this->insertSlug($item,$input,new HotelRoom());
        for($inc=1;$inc<=4;$inc++){
            $image='image_'.$inc;
            if($request->hasFile($image)) {
                $img=$request->file($image);

                if (!empty($item->$image) && isset($input[$image])) {

                    if (file_exists(public_path() . '/images/categories/' . ($item->id) . '/' . $item->$image)) {

                        unlink(public_path() . '/images/categories/' . ($item->id) . '/' . $item->$image);

                    }
                }
                if(!is_null($img)){

                    $origName = $img->getClientOriginalExtension();
                    $nameImg = str_random(10) . '.' . $origName;
                    $item->$image=$nameImg;
                    $image = \Image::make($img);
                    $path =public_path().'/images/categories/'.($item->id) . '/';
                    list($width, $height) = getimagesize($img);
                    if( $width > 1500 )
                    {
                        $image->resize(1500, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }
                    if(!File::exists($path)){
                        File::makeDirectory($path);
                    }

                    $image->save($path.$nameImg);

                    $item->save();

                }


            }
        }
        $item->save();
        return redirect()->route('admin/categories')->with('success',trans('trans.data_save'));
    }

//==========================translater=======================//
    //test
    public function test(){
        return view('admin.translation.index');
    }
    public function set( Request $request){
        $trans='l.php';
        $input = $request->all();
        $resources = resource_path();
        foreach(self::$lang_data as $keylang=>$value)
        {
            $path = $resources.'/lang/'.$keylang.'/'.$trans;
            if( file_exists( $path )){
                $array = [];
                $string = "<?php ".PHP_EOL;
                $string .= "return [".PHP_EOL;
                foreach( $input as $key=>$item ){
                    $l=explode('_',$key);
                    if( $key == '_token' ||($keylang!=$l[0]) ) continue;
                    $key=substr($key,3);
                    $array[$key]= $item;
                    $string.="\t'".$key."' => '".str_replace("'","\'",$item)."',".PHP_EOL;
                }

                $string.="];";
                file_put_contents($path, $string);
            }
        }

        return redirect()->back()->with('success',trans('trans.data_save'));
    }
    //==========================translater=======================//




    //==========================PARTNERS=======================//

    function Partners(){
        $items=Partner::orderBy('sort','asc')->get();
        return view('admin.partners.partners',compact('items'));
    }

    function Partner($id=null){
        if(is_null($id)){
            return view('admin.partners.partner');
        }
        $item=Partner::findOrFail($id);
        return view('admin.partners.partner',compact('item'));
    }

    function PartnerPost(Request $request){
        $input=$request->all();
        $rules=[
            'id'        =>'exists:partners,id',
            'url'       =>'nullable|url',
            'sort'      =>'nullable|numeric',
            'status'    =>'required|boolean',
        ];
        $v=Validator::make($input,$rules);
        if($v->fails()){
            return back()->withInput()->withErrors($v);
        }

        if(isset($input['id'])){
            $item=Partner::findOrFail($input['id']);
        }else{
            $item=new Partner();
        }

        $item->url=$input['url'];
        $item->status=$input['status'];
        $item=$this->setSort($item,$input,new Partner());
        $item->save();
        $image='image';
        if($request->hasFile($image)) {
            $img=$request->file($image);

            if (!empty($item->$image) && isset($input[$image])) {

                if (file_exists(public_path() . '/images/partners/' . ($item->id) . '/' . $item->$image)) {

                    unlink(public_path() . '/images/partners/' . ($item->id) . '/' . $item->$image);

                }
            }
            if(!is_null($img)){

                $origName = $img->getClientOriginalExtension();
                $nameImg = str_random(10) . '.' . $origName;
                $item->$image=$nameImg;
                $image = \Image::make($img);
                $path =public_path().'/images/partners/'.($item->id) . '/';
                list($width, $height) = getimagesize($img);
                if( $width > 400 )
                {
                    $image->resize(400, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }
                if(!File::exists($path)){
                    File::makeDirectory($path);
                }

                $image->save($path.$nameImg);
            }
        }
        $item->save();

        return redirect()->route('admin/partners')->with('success',trans('trans.data_save'));

    }

    function PartnersDelete(Request $request){
        $item=Partner::findOrFail($request->all()['id']);
        $image='image';
        if (!empty($item->$image) ) {

            if (file_exists(public_path() . '/images/partners/' . ($item->id) . '/' . $item->$image)) {

                unlink(public_path() . '/images/partners/' . ($item->id) . '/' . $item->$image);

            }
        }

        $item->delete();
        return back()->with('success',trans('trans.data_delete'));
    }
    //==========================PARTNERS=======================//


    //==========================GALLERY=======================//
    function Gallery(){
        $items=App\Gallery::orderBy('id','desc')->get();
        return view('admin.gallery',compact('items'));
    }

    function GalleryPost(Request $request){
        $input=$request->all();
        if(isset($input['images']) && is_array($input['images'])){
            foreach($request->file('images') as $img){
                if(!is_null($img)){

                    $new = new App\Gallery();
                    $new->save();
                    $origName = $img->getClientOriginalExtension();
                    $nameImg = str_random(10) . '.' . $origName;
                    $new->image=$nameImg;
                    $image = \Image::make($img);
                    $path =public_path().'/images/gallery/' . ($new->id) . '/';
                    list($width, $height) = getimagesize($img);
                    if( $width > 1500 )
                    {
                        $image->resize(1500, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }
                    if(!File::exists($path)){
                        File::makeDirectory($path);
                    }

                    $image->save($path.$nameImg);
                    $image->destroy();

                    $new->save();
                }

            }

        }
        return back()->with('success',trans('trans.data_save'));

    }

    function GalleryDelete(Request $request){
        $input=$request->all();
        $rules=['id'=>'required|exists:gallery,id'];
        $v=Validator::make($input,$rules);
        if($v->fails()){
            echo json_encode([false]);
            return;
        }
        $item=App\Gallery::find($input['id']);

        if (file_exists(public_path().'/images/gallery/'.$item->id.'/'.$item->image)) {
            unlink(public_path().'/images/gallery/'.$item->id.'/'.$item->image);
        }
        $item->delete();
        echo  json_encode([true]);
    }
    //==========================GALLERY=======================//


    //==========================ROOMBOOK=======================//
    function RoomBooks(){
        $items=RoomBook::orderBy('id','desc')->get();
        return view('admin.room_books.room_books',compact('items'));
    }
    function RoomBooksDelete(Request $request){
        $item=RoomBook::findOrFail($request->all()['id']);
        $item->delete();
        return redirect()->route('admin/room_books')->with('success',trans('trans.data_delete'));
    }

    function RoomBook($id=null){
        if(is_null($id)){
            return view('admin.room_books.room_book');
        }
        $item=RoomBook::findOrFail($id);
        return view('admin.room_books.room_book',compact('item'));
    }

    function RoomBookPost(Request $request){
        $input=$request->all();
        $rules=[
            'name'      =>'required|string|max:255',
            'phone'      =>'required|string|max:20',
            'status'     =>'required|boolean',
            'id_room'    =>'required|exists:hotel_rooms,id',
            'id'        =>'exists:room_book,id',
            'comment'   =>'nullable|string|max:500',
        ];
        $v=Validator::make($input,$rules);
        if($v->fails()){
            return back()->withInput()->withErrors($v);
        }
        if(isset($input['id'])){
            $item=RoomBook::findOrFail($input['id']);
        }else{
            $item=new RoomBook();
        }
        $data=['name','status','phone','id_room','comment'];
        foreach($data as $temp){
            $item->$temp=$input[$temp];
        }
        $item->save();
        return redirect()->route('admin/room_books')->with('success',trans('trans.data_save'));
    }
    //==========================ROOMBOOK=======================//



    //==========================CONFERENTIAL HOOL=======================//
    function ConferenceHalls(){
        $items=ConferenceHall::orderBy('id','desc')->get();
        return view('admin.conference_halls.conference_halls',compact('items'));
    }

    function ConferenceHall($id=null){
        if(is_null($id)){
            return view('admin.conference_halls.conference_hall');
        }

        $item=ConferenceHall::findOrFail($id);
        return view('admin.conference_halls.conference_hall',compact('item'));
    }

    function ConferenceHallsPost(Request $request){
        $input=$request->all();
        $rules=[
            'id'            =>'exists:conference_halls,id',
            'title_ro'      =>'required|string|max:255',
            'title_ru'      =>'required|string|max:255',
            'title_en'      =>'required|string|max:255',
            'meta_description_ro' =>'nullable|string|max:255',
            'meta_description_ru' =>'nullable|string|max:255',
            'meta_description_en' =>'nullable|string|max:255',
            'mini_description_ro' =>'required|string|max:255',
            'mini_description_ru' =>'required|string|max:255',
            'mini_description_en' =>'required|string|max:255',
            'slug_ro'             =>'nullable|string|max:255',
            'slug_ru'             =>'nullable|string|max:255',
            'slug_en'             =>'nullable|string|max:255',
            'status'              =>'required|boolean',
        ];
        $v=Validator::make($input,$rules);
        if($v->fails()){
            return back()->withInput()->withErrors($v);
        }

        if(isset($input['id'])){
            $item=ConferenceHall::findOrFail($input['id']);
        }else{
            $item=new ConferenceHall();
        }

        $data=['title_','meta_description_','mini_description_','description_','service_'];
        $item=$this->getInput($item,$input,$data);
        $item->status=$input['status'];
        $item->save();
        $input['id']=$item->id;
        $item=$this->insertSlug($item,$input,new ConferenceHall());
        for($inc=1;$inc<=4;$inc++){
            $image='image_'.$inc;
            if($request->hasFile($image)) {
                $img=$request->file($image);

                if (!empty($item->$image) && isset($input[$image])) {

                    if (file_exists(public_path() . '/images/conference_halls/' . ($item->id) . '/' . $item->$image)) {

                        unlink(public_path() . '/images/conference_halls/' . ($item->id) . '/' . $item->$image);

                    }
                }
                if(!is_null($img)){

                    $origName = $img->getClientOriginalExtension();
                    $nameImg = str_random(10) . '.' . $origName;
                    $item->$image=$nameImg;
                    $image = \Image::make($img);
                    $path =public_path().'/images/conference_halls/'.($item->id) . '/';
                    list($width, $height) = getimagesize($img);
                    if( $width > 1500 )
                    {
                        $image->resize(1500, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }
                    if(!File::exists($path)){
                        File::makeDirectory($path);
                    }

                    $image->save($path.$nameImg);

                    $item->save();

                }


            }
        }
        $item->save();
        return redirect()->route('admin/conference_halls')->with('success',trans('trans.data_save'));
    }

    function ConferenceHallsDelete(Request $request){
        $input=$request->all();
        $item=ConferenceHall::findOrFail($input['id']);
        for($inc=1;$inc<=4;$inc++){
            $image='image_'.$inc;


            if (!empty($item->$image)) {

                if (file_exists(public_path() . '/images/conference_halls/' . ($item->id) . '/' . $item->$image)) {

                    unlink(public_path() . '/images/conference_halls/' . ($item->id) . '/' . $item->$image);

                }
            }

        }
        $item->delete();
        return back()->with('success',trans('trans.data_delete'));
    }


    function Achivements(){
        $items=Achievement::orderBy('sort','asc')->get();
        return view('admin.achivements.achivements',compact('items'));
    }

    function Achivement($id){
        if(is_null($id)){
            return view('admin.achivements.achivement');
        }
        $item=Achievement::findOrFail($id);
        return view('admin.achivements.achivement',compact('item'));

    }



    function AchivementPost(Request $request){
        $input=$request->all();
        $rules=[
            'id'        =>'exists:achievements,id',
            'name_ro'   =>'required|string|max:255',
            'name_ru'   =>'required|string|max:255',
            'name_en'   =>'required|string|max:255',
            'value'     =>'required|numeric',
            'sort'      =>'nullable|numeric',
            'status'    =>'required|boolean',
        ];
        $v=Validator::make($input,$rules);
        if($v->fails()){
            return back()->withInput()->withErrors($v);
        }
        if(isset($input['id'])){
            $item=Achievement::find($input['id']);
        }else{
            $item=new Achievement();
        }
        $data=['name_'];
        $item=$this->getInput($item,$input,$data);
        $item=$this->setSort($item,$input,new Achievement());
        $item->status=$input['status'];
        $item->value=$input['value'];
        $item->save();

        return redirect()->route('admin/achivements')->with('success',trans('trans.data_save'));
    }
    //==========================CONFERENTIAL HOOL=======================//

    function Pages(){
        $name='title_'.Lang::getLocale();
        $items = Page::orderBy($name,'asc')->get();
        return view('admin.pages.pages',compact('items'));
    }

    function Page($id){
        $item=Page::findOrFail($id);
        return view('admin.pages.page',compact('item'));
    }

    function Add(){
        return view('admin.pages.page');
    }

    public function Save(Request $request){
          /*
        $rules=[
            'title_ro'  =>'required|string|max:255',
            'title_ru'  =>'required|string|max:255',
            'title_en'  =>'required|string|max:255',
        ];

        $v=Validator::make($input,$rules);

        if($v->fails()){
            return back()->withInput()->withErrors($v);
        }
        */
                $newPage = new Page();
                $newPage->title_ro = $request->input('title_ro');
                $newPage->title_ru = $request->input('title_ru');
                $newPage->title_en = $request->input('title_en');
                $newPage->meta_description_ro = $request->input('meta_description_ro');
                $newPage->meta_description_ru = $request->input('meta_description_ru');
                $newPage->meta_description_en = $request->input('meta_description_en');
                $newPage->save();

                return redirect()->route('admin/pages')->with('success',trans('trans.data_save'));
    }



    public function PageDelete($id){

        $pageToDelete = App\Page::findOrFail($id);
        $pageToDelete->delete();

       return redirect()->route('admin/pages')->with('success',trans('trans.data_delete'));
    }




    function PagePost(Request $request){

        $input=$request->all();
        /*
        $rules=[
            'title_ro'  =>'required|string|max:255',
            'title_ru'  =>'required|string|max:255',
            'title_en'  =>'required|string|max:255',
            'id'        =>'required|exists:pages,id',
        ];
        $v=Validator::make($input,$rules);
        if($v->fails()){
            return back()->withInput()->withErrors($v);
        }
        $data=['name_','meta_description_','description_'];
        $item=Page::find($input['id']);
        */


        //TODO: Update not working well, check below statement
        //$item=$this->getInput($item,$input,$data);
        //$post->save();
        return redirect()->route('admin/pages')->with('success',trans('trans.data_save'));
    }
}

function Booking(){
    return view('frontend.booking');
}