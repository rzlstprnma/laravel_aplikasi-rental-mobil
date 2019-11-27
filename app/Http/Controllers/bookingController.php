<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;
use App\Client;
use App\Booking;
use App\Payment;
use Illuminate\Support\Facades\Validator;

class bookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        $cars = Car::where('available', 1)->get();
        return view('bookings.index', compact('cars', 'clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function calculate(Request $request)
    {
        $data = $request->toArray();

        Validator::make($data, [
            'booking_code' => ['required', 'string', 'unique:bookings'],
        ]);
            
        $client = Client::where('id', $request->client_id)->first();
        $car = Car::where('id', $request->car_id)->first();

        $order_date = $request->order_date;
        $duration = $request->duration;

        // return date / tanggal kembali, dimana menghitung dari tanggal order + durasi peminjaman
        $return_date = date('Y-m-d', strtotime('+'.$duration.'days', strtotime($order_date)));

        // harga total => harga mobil/day * durasi peminjaman
        $total_price = $car->price * $duration;

        // dp => 30% dari total harga
        $dp = $total_price * 30 / 100;

        return view('bookings.confirm', compact('client', 'car', 'return_date', 'data', 'total_price', 'dp'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function process(Request $request)
    {
        $data = $request->toArray();    
        Validator::make($data, [
            'booking_code' => ['required', 'unique:bookings'],
            'order_date' => ['required'],
            'duration' => ['required'],
            'client_id' => ['required', 'integer'],
            'car_id' => ['required','integer'],
            'duration' => ['required','integer'],
            'return_date_supposed' => ['required'],
            'price' => ['required','integer'],
            'type' => ['required'],
            'amount' => ['required','integer']
        ]);

        //insert to table booking first
        $insert_booking = Booking::create([
            'booking_code' => $request->booking_code,
            'order_date' => $request->order_date,
            'duration' => $request->duration,
            'return_date_supposed' => $request->return_date_supposed,
            'total_price' => $request->total_price,
            'car_id' => $request->car_id,
            'client_id' => $request->client_id,
        ]);

        //insert to payment
        $insert_payment = Payment::create([
            'type' => $request->type,
            'amount' => $request->amount,
            'client_id' => $request->client_id,
            'booking_code' => $request->booking_code
        ]);
        
        $car = Car::find($request->car_id);
        $car->available = '0';
        $car->save();
        
        return redirect('/home');

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
