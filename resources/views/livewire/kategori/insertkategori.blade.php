<?php
use Livewire\WithPagination;
use Livewire\Volt\Component;
use App\Models\Kategori;
use Livewire\Attributes\On;
use function Livewire\Volt\{state};

new class extends Component {
    public $namakategori, $kode;
    public function with()
    {
        $category_max_id = Kategori::max('id') + 1;
        $category_code = 'CA_' . str_pad($category_max_id, 2, '0', STR_PAD_LEFT);
        $this->kode = $category_code;
        return [
            'category_code' => $category_code,
        ];
    }

    public function insert()
    {
        Kategori::create([
            'nama_kategori' => $this->namakategori,
            'kode' => $this->kode,
        ]);
        return redirect()->route('kategori')->with('success','data kategori berhasil di tambahkan');
    }
};

//

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
                    <label class="mt-3" for="stock">Kode Kategori</label>
                    <input type="text" readonly class="form-control @error('stock') is-invalid @enderror"
                        value="{{ $category_code }}" wire:model='kode'>
                    <label class="mt-3" for="satuan">Nama Kategori</label>
                    <input type="text" class="form-control @error('satuan') is-invalid @enderror"
                        wire:model='namakategori'>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
