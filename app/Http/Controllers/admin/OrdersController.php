<?php

namespace App\Http\Controllers\admin;

use App\Mail\SendOrderMail;
use App\Order;
use App\OrderCart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('admin.orders.index');
    }

    public function ordersData()
    {
        $orders = Order::with('cart')->get();

        return Datatables::of($orders)
            ->addColumn('status', function($orders) {
                return view('admin.orders.status', compact('orders'))->render();
            })
            ->addColumn('action0', function($orders) {
                return view('admin.orders.action0', compact('orders'))->render();
            })
            ->addColumn('action1', function($orders) {
                return view('admin.orders.action1', compact('orders'))->render();
            })
            ->addColumn('views', function($orders) {
                return view('admin.orders.views', compact('orders'))->render();
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->rawColumns(['status','action','action0', 'action1', 'views'])
            ->make();
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->ajax()){
            $orders = Order::findOrFail($id);

            if($request->get('seen')){
                $orders->seen = $request->get('seen') == 'true';
            }
            if($request->get('status') || $request->get('status') ==  "0"){
                $orders->status = $request->get('status');
            }
            if($request->get('shipp')){

                Mail::to($orders->email)->send(new SendOrderMail($orders));

                $orders->shipp = $request->get('shipp') == true;
            }
            $orders->save();

            return response()->json(['status' => $request->get('status')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::findOrFail($id)->delete();
        OrderCart::where('order_id', $id)->delete();

        return response()->json(['success' => true], 200);
    }
}
