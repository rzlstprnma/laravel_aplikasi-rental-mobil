@extends('layouts.layouts')
@section('title')
    Konfirmasi Rental
@endsection
@section('css')
    <style>
        .car-img{
            width: 100%;
            max-height: 220px;
            padding-bottom: 20px;
        }
        .card{
            min-height: 470px;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Data Transaksi</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Kode Booking</td>
                                <th>{{$data['booking_code']}}</th>
                            </tr>
                            <tr>
                                <td>Tanggal Order</td>
                                <th>{{$data['order_date']}}</th>
                            </tr>
                            <tr>
                                <td>Duration</td>
                                <th>{{$data['duration']}} Hari</th>
                            </tr>
                            <tr>
                                <td>Kembali Pada</td>
                                <th>{{$return_date}}</th>
                            </tr>
                            <tr>
                                <td>Total Harga</td>
                                <th>Rp. {{number_format($total_price)}}</th>
                            </tr>
                            <tr>
                                <td>DP Minimum</td>
                                <th>Rp. {{number_format($dp)}}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Data Mobil</h3>
                </div>
                <img class="car-img" src="{{$car->getPhoto()}}" alt="car images">
                <div class="card-body">
                    <div class="d-flex no-block align-items-center mb-3">
                        <span><strong>{{number_format($car->price)}} / Hari</strong></span>
                        <div class="ml-auto">
                            <span><i class="ti-car"></i> {{$car->type}}</span>
                        </div>
                    </div>
                    <h3>{{$car->car_name}}</h3>
                    <div class="d-flex no-block align-items-center pb-3">
                        <span class="text-muted">{{$car->brand->brand_name}}</span>
                        <div class="ml-auto">
                            <span class="text-muted"><strong>{{$car->plat_number}}</strong></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Data Penyewa</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>NIK</td>
                                <th>{{$client->nik}}</th>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <th>{{$client->name}}</th>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <th>{{$client->gender}}</th>
                            </tr>
                            <tr>
                                <td>Tanggal lahir</td>
                                <th>{{$client->date_of_birth}}</th>
                            </tr>
                            <tr>
                                <td>Nomor HP</td>
                                <th>{{$client->phone}}</th>
                            </tr>
                        </tbody>
                    </table>
                    <label>Alamat</label>
                    <textarea class="form-control" readonly>{{$client->address}}</textarea>
                </div>
            </div>
        </div>
    </div>
<form action="/bookings/process" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="client_id" value="{{$client->id}}">
    <input type="hidden" name="car_id" value="{{$car->id}}">
    <input type="hidden" name="booking_code" value="{{$data['booking_code']}}">
    <input type="hidden" name="order_date" value="{{$data['order_date']}}">
    <input type="hidden" name="duration" value="{{$data['duration']}}">
    <input type="hidden" name="return_date_supposed" value="{{$return_date}}">
    <input type="hidden" name="total_price" value="{{$total_price}}">

    <button href="#" type="button" data-target="#paymentModal" data-toggle="modal" class="btn btn-block btn-primary">Konfirmasi Rental Mobil</button>
    @include('bookings.form-payment')
</form>
@endsection