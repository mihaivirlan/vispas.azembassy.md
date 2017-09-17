<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Message;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\View;



class ContactsFormsController extends Controller
{
    //define ValidatesRequests inside controller also, to avoid error "undefined validate method"
    use ValidatesRequests;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      /* $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'mesaj' => 'required'
        ]);
        */
        //create Contact
        $newMessage = new Message();
        $newMessage->name = $request->input('name');
        $newMessage->email = $request->input('email');
        $newMessage->mesaj = $request->input('mesaj');

        $newMessage->save();

        return redirect()->route('contacts')->with(['message'=>'message_sent']);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function send($id)
    {
        $todo = Todo::find($id);
       // return view('frontend.contacts')->with('contact', $contact);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
