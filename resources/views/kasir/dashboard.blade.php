@extends('layouts.admin')

@section('title', __('Dashboard'))

@section('breadcrumb')
    @parent
    <li class="active">@yield('title')</li>
@endsection

@section('content')
        <section class="content">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <h2>Selamat Datang di Halaman Utama <b>Website Kasir</b></h2>
                            <br>
                            <h3>Anda Login Sebagai Kasir {{ Auth::user()->name }}</h3>
                            <br>
                            <a href="{{ route('transaksi.baru') }}" class="btn btn-primary mb-4">Buat Transaksi Baru</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
