@extends('layouts.contact_service')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4><b class="bold">Contact Us</b></h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="table-responsive">
                            <table class="table table-bordered table-head-bg-info table-bordered-bd-info mt-4">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Dari</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notifCK as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->dari}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="table-responsive">
                            <table class="table table-bordered table-head-bg-warning table-bordered-bd-warning mt-4">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Dari</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notifCA as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->dari}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="table-responsive">
                            <table class="table table-bordered table-head-bg-success table-bordered-bd-success mt-4">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Dari</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notifCP as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->dari}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection