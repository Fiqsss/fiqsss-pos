<?php

use function Livewire\Volt\{state};
use Livewire\WithPagination;
use Livewire\Volt\Component;
use App\Models\Barang;
use App\Models\Kategori;
new class extends Component {
    use WithPagination;
    public $kategoriId;
    public $barcode, $kategori, $namabarang, $merk, $stock, $harga_jual, $harga_beli, $satuan;
    public function with()
    {
        return [
            'barangs' => Barang::latest()->paginate(),
            'kategoris' => Kategori::latest()->get(),
        ];
    }

    public function insert()
    {
        // dd($this->kategori);
        $validated = $this->validate([
            'barcode' => 'required|min:4|numeric',
            'kategori' => 'required',
            'namabarang' => 'required',
            'merk' => 'required',
            'stock' => 'required|numeric',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'satuan' => 'required',
        ]);

        Barang::create([
            'barcode' => $this->barcode,
            'kategori_id' => $this->kategori,
            'nama_barang' => $this->namabarang,
            'merk' => $this->merk,
            'stock' => $this->stock,
            'harga_jual' => $this->harga_jual,
            'harga_beli' => $this->harga_beli,
            'satuan_barang' => $this->satuan,
        ]);
        $this->reset();
        return redirect()->route('barang')->with('success', 'Data barang telah di tambahkan');
    }
};
?>

<div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white ">Tambah Data Barang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex ">
                <form class="w-100" wire:submit.prevent='insert'>
                    <div class="row">
                        <div class="col-6">
                            <label for="barcode">Barcode</label>
                            <input type="number" class="form-control @error('barcode') is-invalid @enderror "
                                wire:model='barcode'>

                        </div>
                        <div class="col-6">
                            <label class="" for="kategori">Kategori</label>
                            <select wire:model='kategori' id="kategori"
                                class="form-control @error('kategori') is-invalid @enderror " style="width: 100%;">
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="mt-3" for="namabarang">Nama Barang</label>
                            <input type="text" wire:model='namabarang'
                                class="form-control @error('namabarang') is-invalid @enderror ">
                        </div>
                        <div class="col-6">
                            <label class="mt-3" for="merk">merk</label>
                            <input type="text" class="form-control @error('merk') is-invalid @enderror"
                                wire:model='merk'>
                        </div>
                        <div class="col-6">
                            <label class="mt-3" for="harga_beli">harga_beli</label>
                            <input type="number" class="form-control @error('harga_beli') is-invalid @enderror"
                                wire:model='harga_beli'>
                        </div>

                        <div class="col-6">
                            <label class="mt-3" for="harga_jual">harga_jual</label>
                            <input type="number" class="form-control @error('harga_jual') is-invalid @enderror"
                                wire:model='harga_jual'>

                        </div>
                    </div>
                    <label class="mt-3" for="stock">stock</label>
                    <input type="number" class="form-control @error('stock') is-invalid @enderror" wire:model='stock'>

                    <label class="mt-3" for="satuan">satuan</label>
                    <input type="text" class="form-control @error('satuan') is-invalid @enderror"
                        wire:model='satuan'>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Data</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
