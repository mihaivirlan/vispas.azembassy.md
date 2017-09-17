<?php

namespace App\Http\Controllers\Frontend;

use App\ConferenceHall;
use App\HotelRoom;
use App\Page;
use App\Partner;
use App\RoomBook;
use App\User;
use App\Http\Controllers\Controller;
use App\News;
use App\Category;
use App\Slider;
use Composer\Command\ValidateCommand;
use Lang;
use Illuminate\Http\Request;
use App\Achievement;
use Validator;

class IndexController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
       // dd(app()->getLocale());


        $partners=Partner::orderBy('sort','asc')->where('status', 1)->get();
        $news=News::where('status',1)->orderBy('id','desc')->take(3)->get();
        $page_index=Page::findOrFail(6);
        $categories=Category::where('status',1)->orderBy('sort','asc')->get();
        $sliders=Slider::orderBy('sort','asc')->get();
        $achievements=Achievement::where('status',1)->orderBy('sort','asc')->get();
        $page=Page::find(3);
        return view('frontend.index',compact('page','partners','page_index','news','categories','sliders','achievements'));
    }







    public function hotel()
    {
        $items=HotelRoom::where('status',1)->orderBy('id','desc')->paginate(12);
        $page=Page::find(7);
        return view('frontend.hotel',compact('items','page'));

    }

    public function booking()
    {
        return view('frontend.booking');
    }

    public function room($slug)
    {
        $sl='slug_'.Lang::GetLocale();
        $item=HotelRoom::where($sl,$slug)->firstOrFail();
        $items=HotelRoom::where('id','!=',$item->id)->where('status',1)->take(6)->inRandomOrder()->get();
        $slug_url=$item;
        return view('frontend.room',compact('item','items','slug_url'));
    }

    function roomPost(Request $request){
        $input=$request->all();
        $rules=[
            'id_room' =>'required|exists:Hotel Rooms,id',
            'name'   =>'required|string|max:50',
            'phone'  =>'required|max:20',
            'comment' =>'nullable|string|max:500',
        ];
        $v=Validator::make($input,$rules);
        if($v->fails()){
            return redirect()->route('/');
        }
        $item= new RoomBook();
        $data=['name','phone','id_room','comment'];
        foreach($data as $temp){
            $item->$temp=$input[$temp];
        }
        $item->save();
        return back()->with('success','ok');
    }

    public function contacts() {
        $page=Page::find(2);
        return view('frontend.contacts',compact('page'));
    }



     public function news($slug=null) {
        if(is_null($slug)){
            $news=News::where('status',1)->orderBy('id','desc')->paginate(12);
            $page=Page::findOrFail(5);
            return view('frontend.news',compact('news','page'));
        }
        $sl='slug_'.Lang::getLocale();
        $page=News::where($sl,$slug)->firstOrFail();
        $slug_url=$page;
        return view('frontend.page',compact('page','slug_url'));

    }
     public function about() {
        $page=Page::find(4);
        return view('frontend.about',compact('page'));
    }

    function page($slug){
        $sl='slug_'.Lang::getLocale();
        $page=Page::where($sl,$slug)->where('status',1)->firstOrFail();
        $slug_url=$page;

        return view('frontend.page',compact('page','slug_url'));
    }

    public function conference($slug=null) {
        if(is_null($slug)){
            $page=Page::find(8);
            $items=ConferenceHall::where('status',1)->orderBy('id','desc')->paginate(12);
            return view('frontend.conference',compact('items','page'));
        }
        $sl='slug_'.Lang::getLocale();
        $item=ConferenceHall::where($sl,$slug)->firstOrFail();
        $slug_url=$item;
        $items=ConferenceHall::where('id','!=',$item->id)->where('status',1)->take(6)->inRandomOrder()->get();
        return view('frontend.conference_hall',compact('item','slug_url','items'));

    }

    function category($slug){
        $sl='slug_'.Lang::getLocale();
        $item=Category::where($sl,$slug)->where('status',1)->firstOrFail();
        return view('frontend.category',compact('item'));
    }
}