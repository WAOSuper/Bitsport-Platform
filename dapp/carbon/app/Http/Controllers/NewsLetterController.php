<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use Mail;

class NewsLetterController extends Controller
{
    public function subscriber_list()
    {
    	$subscribe = Subscription::get();
    	return view('admin.newsletter.subscriber_list', compact('subscribe'));
    }

    public function delete($id)
    {
        Subscription::find($id)->delete();
        return redirect()->back()->with("success","Subscriber delete.");
    }

    public function subscribe(Request $request)
    {
        $is_present = Subscription::where("email", $request->email)->first();
        if ($is_present) {
            return 0;
        }
        $subscribe = new Subscription;
        $subscribe->email = $request->email;
        $subscribe->save();
        return 1;
       	// $user = $request->email;
        // return view('emails.subscription', compact('user'));
   //      try {
   //          //Sending an Email to the Subscriber
   //      Mail::send('emails.subscription', [
   //          'user' => $request->email,
   //      ], function ($message) use ($request) {
   //          $message->to($request->email);
   //          $message->subject("Bitsport Subscription");
   //      });    
   //      return 1;        
   //          // Adding Subscriber to the mailchimp
			// // Newsletter::subscribe($request->email);
   //      }
    }
}
