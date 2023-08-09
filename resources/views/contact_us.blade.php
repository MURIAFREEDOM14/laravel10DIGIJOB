@extends('layouts.laman')
@section('content')
@include('sweetalert::alert')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5>Pusat Panggilan</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="text-center">
                            <span>WhatssApp</span>
                            <hr>
                            <div class="">
                                <a href="https://api.whatsapp.com/send?phone=62816372729">0816-3727-29</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <h6>Email</h6>
                            <hr>
                            <div class="">cs@ugiport.com</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="" style="height: 11rem;"></div>
    </div>
@endsection
