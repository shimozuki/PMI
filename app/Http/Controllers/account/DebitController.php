<?php

namespace App\Http\Controllers\account;

use App\Goldarah;
use App\Debit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DebitController extends Controller
{
    /**
     * DebitController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $debit = DB::table('pendonor')
            ->select('pendonor.id', 'pendonor.nama_pendonor', 'pendonor.no_hp', 'pendonor.category_id', 'pendonor.user_id', 'pendonor.jml', 'pendonor.created_at', 'pendonor.description', 'golongan_darah.id as id_category', 'golongan_darah.name')
            ->join('golongan_darah', 'pendonor.category_id', '=', 'golongan_darah.id', 'LEFT')
            ->where('pendonor.user_id', Auth::user()->id)
            ->orderBy('pendonor.created_at', 'DESC')
            ->paginate(10);
        return view('account.debit.index', compact('debit'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $search = $request->get('q');
        $debit = DB::table('pendonor')
            ->select('pendonor.id', 'pendonor.nama_pendonor', 'pendonor.no_hp', 'pendonor.category_id', 'pendonor.user_id', 'pendonor.jml', 'pendonor.created_at', 'pendonor.description', 'golongan_darah.id as id_category', 'golongan_darah.name')
            ->join('golongan_darah', 'pendonor.category_id', '=', 'golongan_darah.id', 'LEFT')
            ->where('pendonor.user_id', Auth::user()->id)
            ->where('pendonor.description', 'LIKE', '%' .$search. '%')
            ->orderBy('pendonor.created_at', 'DESC')
            ->paginate(10);
        return view('account.debit.index', compact('debit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Goldarah::where('user_id', Auth::user()->id)
        ->get();
        return view('account.debit.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //set validasi required
        $this->validate($request, [
            'nama_pendonor' => 'required',
            'no_hp' => 'required',
            'jml'       => 'required',
            'category_id'   => 'required',
            'description'   => 'required'
        ],
            //set message validation
            [
                'nama_pendonor' => 'Masukan nama pendonor',
                'no_hp' => 'Masukan nomor tlpn pendonor',
                'jml.required' => 'Masukkan jumlah kantong darah',
                'category_id.required' => 'Silahkan Pilih Kategori!',
                'description.required' => 'Masukkan Keterangan!',
            ]
        );

        //Eloquent simpan data
        $save = Debit::create([
            'nama_pendonor' => $request->input('nama_pendonor'),
            'no_hp' => $request->input('nama_pendonor'),
            'user_id'       => Auth::user()->id,
            'category_id'   => $request->input('category_id'),
            'jml'       => str_replace(",", "", $request->input('jml')),
            'description'   => $request->input('description'),
        ]);
        //cek apakah data berhasil disimpan
        if($save){
            //redirect dengan pesan sukses
            return redirect()->route('account.debit.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('account.debit.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Debit $debit)
    {
        $categories = Goldarah::where('user_id', Auth::user()->id)
            ->get();
        return  view('account.debit.edit', compact('debit', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Debit $debit)
    {
        //set validasi required
        $this->validate($request, [
            'jml'       => 'required',
            'debit_date'    => 'required',
            'category_id'   => 'required',
            'description'   => 'required'
        ],
            //set message validation
            [
                'jml.required' => 'Masukkan jml Debit / Uang Masuk!',
                'debit_date.required' => 'Silahkan Pilih Tanggal!',
                'category_id.required' => 'Silahkan Pilih Kategori!',
                'description.required' => 'Masukkan Keterangan!',
            ]
        );

        //Eloquent simpan data
        $update = Debit::whereId($debit->id)->update([
            'user_id'       => Auth::user()->id,
            'category_id'   => $request->input('category_id'),
            'debit_date'    => $request->input('debit_date'),
            'jml'       => str_replace(",", "", $request->input('jml')),
            'description'   => $request->input('description'),
        ]);
        //cek apakah data berhasil disimpan
        if($update){
            //redirect dengan pesan sukses
            return redirect()->route('account.debit.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('account.debit.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Debit::find($id)->delete($id);

        if($delete){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
