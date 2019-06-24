@extends('layouts.layouts')
@section('title')
    Informasi Rental
@endsection 
@section('content')
    <div class="card material-card">
        <div class="card-body">
            <h4>Information Rental | <strong>{{$booking->booking_code}}</strong></h4>
            <p class="card-subtitle">Ini adalah data informasi perentalan mobila dengan kode booking <strong>{{$booking->booking_code}}</strong></p>
            <div class="row">
                <div class="col-lg-6">
                <form action="/return/store" method="POST">
                    @csrf
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Kode Booking </td>
                                <td>:</td>
                                <th>{{$booking->booking_code}}</th>
                            </tr>
                            <tr>
                                <td>Nama Penyewa </td>
                                <td>:</td>
                                <th>{{$booking->client->name}}</th>
                            </tr>
                            <tr>
                                <td>Mobil </td>
                                <td>:</td>
                                <th>{{$booking->car->car_name}}</th>
                            </tr>
                            <tr>
                                <td>Tanggal Rental </td>
                                <td>:</td>
                                <th>{{$booking->order_date}}</th>
                            </tr>
                            <tr>
                                <td>Duration </td>
                                <td>:</td>
                                <th>{{$booking->duration}} Hari</th>
                            </tr>
                            <tr>
                                <td>Tanggal Pengembalian Seharusnya </td>
                                <td>:</td>
                                <th>{{$booking->return_date_supposed}}</th>
                            </tr>
                            <tr>
                                <td>Dikembalikan Pada</td>
                                <td>:</td>
                                <th>{{$data['now']}}</th>
                            </tr>
                        </tbody>
                    </table>
                    <label>Foto Mobil</label>
                    <img src="{{$booking->car->getPhoto()}}" style="width: 100%; height: 200px">
                </div> 
                
                <div class="col-lg-6">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Harga Mobil / Hari </td>
                                <td>:</td>
                                <th>Rp. {{number_format($booking->car->price)}}</th>
                            </tr>
                            <tr>
                                <td>Waktu Penyewaan </td>
                                <td>:</td>
                                <th>{{$booking->duration}} Hari</th>
                            </tr>
                            <tr>
                                <td>Telat Pengembalian </td>
                                <td>:</td>
                                <th> 
                                @if ($data['late'] <= 0)
                                    0
                                @else
                                {{$data['late']}}
                                @endif Hari</th>
                            </tr>
                            <tr>
                                <td>Denda <br>
                                <small class="text-muted">Denda, 10% dari harga sewa mobil /hari + harga sewa /hari</small><br>
                                </td>
                                <td>:</td>
                                <th>
                                    <input readonly class="inputDenda form-control" type="number" value="{{$data['fine']}}" name="fine">
                                    <small class="text-muted">Klik 2x untuk tambah denda</small>
                                </th>
                            </tr>
                            <tr>
                                <td>Sudah Dibayar / DP</td>
                                <td>:</td>
                                <th>RP. {{number_format($data['dp'])}}</th>
                            </tr>
                            <tr>
                                <td>Sisa yang harus dibayar</td>
                                <td>:</td>
                                <th><input readonly class="form-control" type="number" id="total" name="total_price" ></th>
                                
                            </tr>

                        </tbody>
                    </table>
                    <input type="hidden" name="car_id" value="{{$booking->car_id}}">
                    <input type="hidden" name="client_id" value="{{$booking->client_id}}">
                    <input type="hidden" name="booking_code" value="{{$booking->booking_code}}">
                    <input type="submit" value="Process" class="btn-block btn btn-primary">
                    </form>
                </div> 
                              
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(e){
        let totalInput = $('#total')
        let fineInput = $('.inputDenda')
        // fineInput.val("{{$data['fine']}}")
        let valueTotal = "{{$data['total']}}"
        totalInput.val(valueTotal)   

        if(fineInput.val() == ''){
            totalInput.val()
        }else{
            totalInput.val(parseInt(totalInput.val()) + parseInt(fineInput.val()))
        }
        

        $('.inputDenda').dblclick(function(){
            $(this).removeAttr('readonly')
        })

        fineInput.on("input", function(){
            var $fine = parseInt($(this).val())
            var $total = parseInt(valueTotal) + $fine

            totalInput.val($total)
        })


        })

    </script>
@endsection
