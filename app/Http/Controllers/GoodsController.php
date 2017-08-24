<?php

namespace App\Http\Controllers;

use Cache;
use App\Goods;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currency = 'BYN';
        $cachekey = 'exchange';

        $value = Cache::get($cachekey);

        if ($value === null)
        {
            $uri = "http://download.finance.yahoo.com/d/quotes.csv?s=".$currency."RUB=X&f=sl1d1t1ba";
            $response = \Httpful\Request::get($uri)
                ->parseWith(function($body) {
                    return explode(",", $body);
                })
                ->send();

            $value = $response->body[1];
            $minutes = 60;
            Cache::put($cachekey, $value, $minutes);
        }

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $this -> validate($request, [
            'name' => 'required',
            'price' => 'required',
            'vendor_id' => 'required'
        ]);
        $data = $request->all();
        $goods = new Goods;
        $goods->fill($data);
        $goods->save();
        return response()->json($goods, 201);
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
     * @param  \App\Goods  $goods
     * @return \Illuminate\Http\Response
     */
    public function show(Goods $goods)
    {
        // Вывод товаров определенного бренда
        $goods = DB::select('SELECT * FROM vendors, goods WHERE vendors.id = ? GROUP BY goods.i', $brand);
        return view('index', ['goods' => $goods]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Goods  $goods
     * @return \Illuminate\Http\Response
     */
    public function edit(Goods $goods)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Goods  $goods
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Goods $goods)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Goods  $goods
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        //
        $vendor = Vendor::findOrFail($id);
        $vendor->delete();
        return response()->json(null, 204);
    }
}
