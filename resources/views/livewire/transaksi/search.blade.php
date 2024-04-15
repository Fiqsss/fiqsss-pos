<?php

use function Livewire\Volt\{state};

use Livewire\Volt\Component;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Member;
use Livewire\Attributes\On;
use Illuminate\Support\Collection;

new class extends Component {
    public $query;
    public $search_results;
    public $how_many;

    public function mount()
    {
        $this->query = '';
        $this->how_many = 5;
        $this->search_results;
    }

    public function updatedQuery()
    {
        $this->search_results = Barang::where('nama_barang', 'like', '%' . $this->query . '%')
            ->orWhere('nama_barang', 'like', '%' . $this->query . '%')
            ->take($this->how_many)
            ->get();
    }

    public function loadMore()
    {
        $this->how_many += 5;
        $this->updatedQuery();
    }
    public function resetQuery()
    {
        $this->query = '';
        $this->how_many = 5;
        $this->search_results;
    }

    public function with()
    {
        return [
            'members' => Member::latest()->get()
    ];
    }

    public function selectProduct($product)
    {
        $this->dispatch('productSelected', $product);
    }
};

?>
<div class="position-relative">
    <div class="card mb-0 border-0 shadow-sm">
        <div class="card-body">
            <div class="form-group mb-0 d-flex justify-content-center ">
                <div class="input-group position-relative  w-75">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                    <input wire:keydown.escape="resetQuery" wire:model.live.debounce.300ms="query" type="text"
                        class="form-control" placeholder="Type product name or code....">
                </div>
            </div>
            <div class="member-select w-50 d-flex justify-content-center w-100">
                <div class="d-flex justify-content-center  w-75">

                </div>
            </div>
        </div>
    </div>

    <div wire:loading class="card position-absolute mt-1 border-0" style="z-index: 1;left: 0;right: 0;">
        <div class="card-body shadow">
            <div class="d-flex justify-content-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
    </div>

    @if (!empty($query))
        <div wire:click="resetQuery" class="position-fixed w-100 h-100"
            style="left: 0; top: 0; right: 0; bottom: 0;z-index: 1;"></div>
        @if ($search_results->isNotEmpty())
            <div class="card position-absolute mt-1" style="z-index: 2;left: 0;right: 0;border: 0;">
                <div class="card-body shadow">
                    <ul class="list-group list-group-flush">
                        @foreach ($search_results as $result)
                            <li class="list-group-item list-group-item-action d-flex justify-content-between ">
                                <p>
                                    {{ $result->nama_barang }} | {{ $result->barcode }}
                                </p>
                                <a class="btn btn-warning" wire:click="resetQuery"
                                    wire:click.prevent="selectProduct({{ $result }})" href="#">
                                    <i class="fas fa-shopping-cart"></i>
                                </a>
                            </li>
                        @endforeach
                        @if ($search_results->count() >= $how_many)
                            <li class="list-group-item list-group-item-action text-center">
                                <a wire:click.prevent="loadMore" class="btn btn-primary btn-sm" href="#">
                                    Load More <i class="bi bi-arrow-down-circle"></i>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        @else
            <div class="card position-absolute mt-1 border-0" style="z-index: 1;left: 0;right: 0;">
                <div class="card-body shadow">
                    <div class="alert alert-warning mb-0">
                        No Product Found....
                    </div>
                </div>
            </div>
        @endif
    @endif
</div>
