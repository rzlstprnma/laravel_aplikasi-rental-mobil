<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\Payment;
use DateTime;
use App\Car;
use Carbon\Carbon;

class returnController extends Controller
{
    public function index(){
        $bookings = Booking::where('return_date', null)->get();
        return view('returns.index', compact('bookings'));
    }

    protected function show($code){
        $booking = Booking::where('booking_code', $code)->first();
        $payment = Payment::where('booking_code', $code)->first();
        
        // fine / denda (*10%/hari)
        if($booking->return_date_supposed < date('Y-m-d')){
            $return_supposed = new DateTime($booking->return_date_supposed);
            $return_now = new DateTime(date('Y-m-d'));
            $selisih = $return_supposed->diff($return_now);
            $late = $selisih->days;
            $fine = $booking->car->price * 10 / 100 * $late;
            $data['fine'] = $fine + $booking->car->price * $late;;
    		$data['late'] = $late;
        }else{
            $data['fine'] = null;
            $data['late'] = null;
        }

        $data['total'] = $booking->total_price - $payment->amount;
        $data['dp'] = $payment->amount;
        $data['now'] = Carbon::now()->toDateString();
        // dd($data['now']);

        return view('returns.show', compact('booking', 'data'));
    }

    protected function store(Request $request){
        $booking = Booking::where('booking_code', $request->booking_code)->first()->update([
            'total_price' => $request->total_price,
            'fine' => $request->fine,
            'return_date' => date('Y-m-d')
        ]);

        $car = Car::find($request->car_id);
        $car->update([
            'available' => 1,
        ]);

        Payment::create([
            'type' => 'repayment',
            'amount' => $request->total_price,
            'date' => date('Y-m-d'),
            'booking_code' => $request->booking_code,
            'client_id' => $request->client_id,
        ]);

        return redirect('/returns');
    }
}
