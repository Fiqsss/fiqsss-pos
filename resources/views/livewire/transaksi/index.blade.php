<?php

use Livewire\Volt\Component;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Cart;
use Livewire\Attributes\On;
use function Livewire\Volt\{state};

new class extends Component {
    public $keyword;
    public $limit = 10;
    public $search;
    public $kategori;
    public $kategori_id;
    public $product;

    #[On('productSelected')]
    public function selectProduct($product)
    {
        $this->product = $product;
    }

    public function with()
    {
        return [
            'barang' => Barang::when($this->kategori_id, function ($query) {
                return $query->where('kategori_id', $this->kategori_id);
            })->get(),
        ];
    }

    public function muatulang()
    {
        $this->dispatch('muatulang');
    }
};
?>
{{-- {{ dd($product) }} --}}

<div class="mx-5">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Cari Barang</h3>
                        </div>
                        <div class="card-body mb-3">
                            <livewire:transaksi.search />
                            {{-- <livewire:transaksi.fillter :barang="$barang" /> --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header row mx-0">
                            <div class="col-6 d-flex align-items-center ">
                                <h3 class="card-title">Hasil Pencarian</h3>
                            </div>
                            <div class="col-6 text-end d-flex justify-content-end ">
                                <button wire:click.prevent="muatulang" class="text-end rounded btn-warning"><i class="fas fa-sync-alt"></i></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <livewire:transaksi.checkout />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
