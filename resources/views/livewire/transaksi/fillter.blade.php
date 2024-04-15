<?php

use Livewire\Volt\Component;
use App\Models\Barang;
use App\Models\Kategori;
use Livewire\Attributes\On;
use function Livewire\Volt\{state};

new class extends Component {
    public $barang;
    public $kategori;
};

?>

<div>
    <select class="select2 form-control" id="">
        <option>ks;m</option>
        @foreach ($barang as $item)
            <option wire:model.live='search' value="{{ $item->id }}">
                {{ $item->id }}
            </option>
        @endforeach
    </select>
</div>
