@extends('layouts.account')

@section('title')
    Dashboard - PMI
@stop

@section('content')

    <script>

    </script>

    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="card card-statistic-2">
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-box"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Stok Darah A </h4>
                            </div>
                            <div class="card-body" style="font-size: 20px">
                                {{ $saldo_selama_ini }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="card card-statistic-2">
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-box"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Stok Darah B</h4>
                            </div>
                            <div class="card-body" style="font-size: 20px">
                                {{ $saldo_bulan_ini }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="card card-statistic-2">
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-box"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Stok Darah O</h4>
                            </div>
                            <div class="card-body" style="font-size: 20px">
                                {{ $saldo_bulan_lalu }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="card card-statistic-2">
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-box"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Stok Darah AB</h4>
                            </div>
                            <div class="card-body" style="font-size: 20px">
                                {{ $saldo_bulan_lalu }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fas fa-chart-pie"></i> STATISTIK STOK DARAH DALAM 1 TAHUN</h4>
                        </div>

                        <div class="card-body">
                            <div id="container"></div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
@stop
