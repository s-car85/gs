<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->middleware('auth');

        parent::__construct();
    }

    public function profile()
    {
        return view('profile.index');
    }

    public function userPassword()
    {
        return view('profile.password');
    }
    public function updatePassword(Request $request)
    {
        $user = $this->user->findOrFail(auth()->id());

        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if ($validator->fails()) {

            flash()->error('Ispravite greške','');

            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        $user->password = Hash::make($request['password']);
        $user->save();

        flash()->success('Lozinka je uspešno promenjena.','');

        return redirect()->back();
    }

    public function profileData()
    {
        return view('profile.address');
    }

    public function updateProfileData(Request $request)
    {
        $user = $this->user->findOrFail(auth()->id());

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'surname' => 'required',
            'address' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {

            flash()->error('Ispravite greške','');

            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        $user->fill($request->only('name', 'surname', 'address', 'city', 'zip', 'phone'))->save();

        flash()->success('Podaci su usprešno sačuvani','');

        return redirect()->back();
    }

    public function status()
    {
        $orders = Order::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(10);

        return view('profile.status', compact('orders'));
    }

    public function statusDetail($orderId)
    {
        $order = Order::whereId($orderId)->where('user_id', auth()->user()->id)->with('cart')->firstOrFail();

       return view('profile.status-detail', compact('order'));
    }

}
