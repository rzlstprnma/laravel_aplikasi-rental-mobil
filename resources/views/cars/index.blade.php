@extends('layouts.layouts')
@section('title')
    Data Mobil
@endsection
@section('css-datatables')
<link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endsection
<style>
.car-img{
    height: 60px; 
    padding: 5px;
}
.car-img:hover{
    transform: scale(1.07);
}
</style>
@section('content')
<div class="row">
        <div class="col-12">
            <div class="material-card card">
                <div class="card-body">
                    <div class="float-left ml-3">
                    <h4 class="card-title">Data Mobil</h4>
                    <h6 class="card-subtitle">Data Mobil yang ada di Rental Mobil ini</h6>
                    </div>
                    <div class="float-right mr-3">
                        <button type="button" class="btn btn-circle btn-sm btn-info" data-toggle="modal" data-target="#exampleModal"><i class="ti-plus"></i></button><span class="ml-2 font-normal text-dark">Tambah Mobil</span>
                    @include('cars.create')
                    </div>
                    <div class="table-responsive">
                        <table id="multi_col_order" class="table table-striped border display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Foto Mobil</th>
                                    <th>Brand</th>
                                    <th>Type</th>
                                    <th>Nama Mobil</th>
                                    <th>Harga / hari</th>
                                    <th>Plat Nomor</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cars as $car)
                                <tr>
                                    <td>
                                        <img class="car-img" src="{{$car->getPhoto()}}" alt="car images"/>   
                                    </td>
                                    <td>{{$car->brand->brand_name}}</td>
                                    <td>{{$car->type}}</td>
                                    <td>{{$car->car_name}}</td>
                                    <td>{{$car->price}}</td>
                                    <td>{{$car->plat_number}}</td>
                                    <td>
                                        <form action="{{route('cars.destroy', $car->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="ti-trash"></i></button>
                                        </form>                                    
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $('#multi_col_order').DataTable()
    </script>
@endsection