@extends('layouts.account')

@section('title')
    Tambah Pendonor - PMI
@stop

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1> DONOR DARAH</h1>
            </div>

            <div class="section-body">

                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-money-check-alt"></i> TAMBAH PENDONOR</h4>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('account.debit.store') }}" method="POST">
                            @csrf

                            <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" name="nama_pendonor" placeholder="Nama Pendonor">

                                        @error('nama_pendonor')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kantong</label>
                                        <input type="text" name="jml" value="{{ old('jml') }}" placeholder="Masukkan jumlah kantong" class="form-control currency">

                                        @error('jml')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Hp</label>
                                        <input type="text" class="form-control" name="no_hp" placeholder="Nomor hp">

                                        @error('date_debit')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>KATEGORI</label>
                                        <select class="form-control select2" name="category_id" style="width: 100%">
                                            <option value="">-- PILIH KATEGORI --</option>
                                            @foreach ($categories as $hasil)
                                                <option value="{{ $hasil->id }}"> {{ $hasil->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('category_id')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>KETERANGAN</label>
                                        <textarea class="form-control" name="description" rows="6" placeholder="Masukkan Keterangan">{{ old('description') }}</textarea>

                                        @error('description')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i> SIMPAN</button>
                            <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>

                        </form>

                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>

        if($(".datetimepicker").length) {
            $('.datetimepicker').daterangepicker({
                locale: {format: 'YYYY-MM-DD hh:mm'},
                singleDatePicker: true,
                timePicker: true,
                timePicker24Hour: true,
            });
        }

        var cleaveC = new Cleave('.currency', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });

        var timeoutHandler = null;

        /**
         * btn submit loader
         */
        $( ".btn-submit" ).click(function()
        {
            $( ".btn-submit" ).addClass('btn-progress');
            if (timeoutHandler) clearTimeout(timeoutHandler);

            timeoutHandler = setTimeout(function()
            {
                $( ".btn-submit" ).removeClass('btn-progress');

            }, 1000);
        });

        /**
         * btn reset loader
         */
        $( ".btn-reset" ).click(function()
        {
            $( ".btn-reset" ).addClass('btn-progress');
            if (timeoutHandler) clearTimeout(timeoutHandler);

            timeoutHandler = setTimeout(function()
            {
                $( ".btn-reset" ).removeClass('btn-progress');

            }, 500);
        })

    </script>
@stop
