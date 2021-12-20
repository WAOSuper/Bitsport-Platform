<?php

namespace App\Http\Controllers;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Crypt;
use Google2FA;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use \ParagonIE\ConstantTime\Base32;

class Google2FAController extends Controller
{
    use ValidatesRequests;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    public function securityPage()
    {
        return view('user.security');
    }
    public function enableTwoFactor(Request $request)
    {
        //generate new secret
        $secret = $this->generateSecret();

        //get user
        $user = Sentinel::getUser();


        //generate image for QR barcode
        $imageDataUri = Google2FA::getQRCodeInline(
            'Betting',
            $user->email,
            $secret,
            200
        );

        return $data = array('secret'=> $secret, 'imgurl'=>$imageDataUri);

    }

    public function saveSecretKey(Request $request)
    {
        $user = Sentinel::getUser();
        $user->google2fa_secret = Crypt::encrypt($request->secret_key);
        $user->save();

        return redirect()->back();
    }
    /**
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function disableTwoFactor(Request $request)
    {
        $user = $request->user();

        //make secret column blank
        $user->google2fa_secret = null;
        $user->save();

        return redirect()->back();
        //return view('2fa/disableTwoFactor');
    }

    /**
     * Generate a secret key in Base32 format
     *
     * @return string
     */
    private function generateSecret()
    {
        $randomBytes = random_bytes(10);
        return Base32::encodeUpper($randomBytes);
    }
}