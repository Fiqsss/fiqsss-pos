<?php
use Livewire\WithPagination;
use Livewire\Volt\Component;
use App\Models\Barang;
use App\Models\Kategori;
use Livewire\Attributes\On;
use function Livewire\Volt\{state};

new class extends Component {
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $paginate = 5;
    public $search;
    public $kategori;

    public function with()
    {
        return [
            'kategoris' => Kategori::latest()->get(),
        ];
    }
};

?>

<div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent='insert'>
                    <label for="barcode">Nama Kategori</label>
                    <input type="number" class="form-control @error('barcode') is-invalid @enderror "
                        wire:model='barcode'>
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
