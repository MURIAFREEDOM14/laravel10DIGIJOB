@extends('layouts.akademi')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <b class="" style="text-transform:uppercase;">Data Kandidat</b>
                <a href="" class="float-right btn text-white" style="background-color: #FF9E27">Tambah Kandidat/Murid</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Age</th>
                                <th>Start date</th>
                                <th>Salary</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection