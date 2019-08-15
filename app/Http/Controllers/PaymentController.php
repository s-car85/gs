<?php

namespace App\Http\Controllers;

use App\Mail\OrderEmail;
use App\Mail\BankTrans;
use App\Order;
use App\OrderCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Cart;

class PaymentController extends Controller
{

    public function index(Request $request)
    {
        $clientid = str_replace("|", "\\|", str_replace("\\", "\\\\", env('CLIENTID')));
        $oid = str_replace("|", "\\|", str_replace("\\", "\\\\", $request->oid));
        $amount = str_replace("|", "\\|", str_replace("\\", "\\\\", $request->amount));
        $okurl = str_replace("|", "\\|", str_replace("\\", "\\\\", env('OKURL')));
        $failurl = str_replace("|", "\\|", str_replace("\\", "\\\\", env('FAILURL')));
        $shopurl = str_replace("|", "\\|", str_replace("\\", "\\\\", url('/')));
        $trantype = str_replace("|", "\\|", str_replace("\\", "\\\\", env('TRANTYPE')));
        $instalment = env('');
        $rnd = microtime();
        $currency = str_replace("|", "\\|", str_replace("\\", "\\\\", env('CURRENCY')));
        $storekey = str_replace("|", "\\|", str_replace("\\", "\\\\", env('STOREKEY')));
        $lang = env('LANG');
        $storetype = env('STORETYPE');
        $plaintext = $clientid . '|' . $oid . '|' . $amount . '|' . $okurl . '|' . $failurl . '|' . $trantype . '|' . $instalment . '|' . $rnd . '||||' . $currency . '|' . $storekey;
        $hashValue = hash('sha512', $plaintext);
        $hash = base64_encode(pack('H*', $hashValue));
        $hashalgorithm = env('HASHALGORITHM');
        $encoding = 'utf-8';

        return view('store.bank', compact('failurl', 'currency', 'trantype', 'okurl', 'amount', 'lang', 'oid', 'clientid', 'storetype', 'hashalgorithm', 'rnd', 'encoding', 'shopurl', 'hash'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ok(Request $request)
    {
        $id = $request->ReturnOid;

        $email = (Auth::check())? Auth::user()->email: $request->email;
        $order = Order::findOrFail($id);
        $order->status = 1;
        $order->update();

        $order['banka'] =  $request->all();

        Mail::to($email)->send(new BankTrans($order));

        return view('store.bankok', compact('order'));
    }

    public function notok()
    {
        return view('pages.banknok');
    }

    public function payment(Request $request)
    {
        if(!\auth()->check()){
            $validator = Validator::make($request->all(), [
                'email' => 'required|unique:users',
            ]);

            if ($validator->fails()) {

                 flash()->error('Email adresa već postoji','');

                return redirect()->back()->withInput()->withErrors($validator->errors());
            }
        }

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'street' => 'required',
            'place' => 'required',
            'zip' => 'required',
            'phone' => 'required',
            'type' => 'required|between:0,2',
        ]);

        if ($validator->fails()) {

              flash()->error('Ispravite greške','');

            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $userId = 0;
        $email = $request->email;

        if(\auth()->check()){
            $userId = \auth()->id();
            $email = \auth()->user()->email;
        }

        $order = new Order();
        $order->user_id = $userId;
        $order->email = $request->email;
        $order->name = $request->name;
        $order->surname = $request->surname;
        $order->street = $request->street;
        $order->place = $request->place;
        $order->zip = $request->zip;
        $order->phone = $request->phone;
        $order->note = $request->note;
        $order->amount = $request->amount;
        $order->type = $request->type;
        $order->status = 0;
        $order->save();

        $id = $order->id;

        foreach(Cart::getContent() as $item){
            $cart = new OrderCart();
            $cart->order_id = $id;
            $cart->product_id = $item->attributes->product_id;
            $cart->name = $item->name;
            $cart->price = $item->price;
            $cart->qty = $item->quantity;
            $cart->addition = json_encode($item->attributes);
            $cart->save();
        }

        Cart::clear();
        if ($request->type == 0) {
            $client = new \GuzzleHttp\Client();
            $headers = [
                'Authorization' => 'Bearer ' . csrf_token(),
                'Accept' => 'application/json',
            ];
            $response = $client->request('POST', url('/bank'), [
                'headers' => $headers,
                'form_params' => [
                    'oid' => $id,
                    'amount' => $request->amount
                ]
            ]);
            $response = $response->getBody()->getContents();
            return $response;
        }

        if ($request->type == 1) {
            $pdf = new \setasign\Fpdi\Fpdi();

            $pdf->AddPage();
            $pdf->setSourceFile(public_path() . '/uplatnice/uplatnica.pdf');
            $tpl = $pdf->importPage(1);
            $pdf->useTemplate($tpl);
            $mRootX = 8;
            $mRootY = 10;
            $pdf->SetFont('Arial', '', 10);
            $mLineHeight = 5;
            $mX1 = $mRootX;
            $mY1 = $mRootY;
            $pdf->SetXY($mX1, $mY1);
            $pdf->Cell(0, 0, utf8_decode($request->name), 0, 0, 'L');
            $pdf->SetXY($mX1, $mY1 + ($mLineHeight * 1));
            $pdf->Cell(0, 0, utf8_decode($request->surname), 0, 0, 'L');
            $mY2 = $mRootY + 20;
            $pdf->SetXY($mX1, $mY2);
            $pdf->Cell(0, 0, "Porudzbenica broj:", 0, 0, 'L');
            $pdf->SetXY($mX1, $mY2 + ($mLineHeight * 1));
            $pdf->Cell(0, 0, $id, 0, 0, 'L');
            $mY3 = $mRootY + 40;
            $pdf->SetXY($mX1, $mY3);
            $pdf->Cell(0, 0, "Gradski Sifonjer doo", 0, 0, 'L');
            $pdf->SetXY($mX1, $mY3 + ($mLineHeight * 1));
            $pdf->Cell(0, 0, "Suvoborska 19, 11000 Beograd ", 0, 0, 'L');
            $mX4 = $mRootX + 100;
            $mY4 = $mRootY + 4.5;
            $pdf->SetXY($mX4, $mY4);
            $pdf->Cell(11, 0, "221", 0, 0, 'C');
            $pdf->SetX($mX4 + 16);
            $pdf->Cell(11, 0, "RSD", 0, 0, 'C');
            $pdf->SetX($mX4 + 39);
            $pdf->Cell(0, 0, $request->amount, 0, 0, 'L');
            $mX5 = $mRootX + 120;
            $mY5 = $mRootY + 16.7;
            $pdf->SetXY($mX5, $mY5);
            $pdf->Cell(0, 0, ENV('TR'), 0, 0, 'L');
            $mX6 = $mRootX + 100;
            $mY6 = $mRootY + 28.7;
            $pdf->SetXY($mX6, $mY6);
            $pdf->Cell(11, 0, "99", 0, 0, 'C');
            $pdf->SetX($mX6 + 16);
            $pdf->Cell(0, 0, "0000-" . $userId . "-00-" . $id, 0, 0, 'L');
            $filename = public_path() . '/uplatnice/uplatnica_' . $id . '.pdf';
            $pdf->Output($filename, 'F');

            Mail::to($email)->send(new OrderEmail($order));

            if (Mail::failures()) {
                // return response showing failed emails
                return redirect()->back();
            }

            flash()->success('Uspešno poručeno.','');

            return redirect()->to('hvala-uplatnica');

        }
    }
}
