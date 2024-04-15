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

    #[On('insertsuccess')]
    public function with()
    {
        return [
            'barangs' =>
                $this->search === null
                    ? Barang::latest()->paginate($this->paginate)
                    : Barang::latest()
                        ->where('nama_barang', 'like', '%' . $this->search . '%')
                        ->orWhere('merk', 'like', '%' . $this->search . '%')
                        ->orWhere('barcode', 'like', '%' . $this->search . '%')
                        ->orWhere('merk', 'like', '%' . $this->search . '%')
                        ->orWhere('satuan_barang', 'like', '%' . $this->search . '%')
                        ->orWhereHas('kategori', function ($query) {
                            $query->where('nama_kategori', 'like', '%' . $this->search . '%');
                        })
                        ->paginate($this->paginate),
            'totalstock' => Barang::sum('stock'),
            'harga_jual' => Barang::sum('harga_jual'),
            'harga_beli' => Barang::sum('harga_beli'),
        ];
    }

    public function delete($id)
    {
        $barang = Barang::find($id);
        $barang->delete();
        session()->flash('delete', 'fijnades');
    }
};

?>
<div class="card pt-5">
    <div class="notif d-flex justify-content-end px-3">
        @if (session('delete'))
            <div class="w-50 alert alert-danger alert-dismissible fade show text-end " role="alert">
                <strong>Data Berhasil Dihapus.</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
    <div class="actiondata d-flex justify-content-end mx-3">
        <a href="/barang" wire:navigate class="btn btn-success mx-1 shadow "><i style="margin-right: 0.6rem"
                class="fas fa-sync-alt"></i>Refresh Data</a>
        <button data-toggle="modal" data-target="#insert" class="btn btn-primary shadow"><i style="margin-right: 0.6rem"
                class="fas fa-plus"></i> Tambah Data</button>
    </div>
    <div class="card-header d-flex justify-content-between  ">
        <div class="form-page">
            <select style="width: 5rem" class="form-control shadow " wire:model.live='paginate' id="">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
            </select>
        </div>
        <div class="w-100 d-flex justify-content-end align-content-center ">
            <input wire:model.live='search' type="text" class="shadow form-control w-25" placeholder="Cari Barang">
            {{-- <button style="margin-top: 2.5px" class="btn btn-primary position-absolute py-1 ">Cari</button> --}}
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>Barcode</th>
                    <th>Kategori</th>
                    <th>Nama Barang</th>
                    <th>Merk</th>
                    <th>Stock</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Satuan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($barangs as $index => $data)
                    <tr class="text-center">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $data->barcode }} </td>
                        <td>{{ $data->kategori->nama_kategori }}</td>
                        <td>{{ $data->nama_barang }}</td>
                        <td>{{ $data->merk }}</td>
                        <td>{{ $data->stock }}</td>
                        <td>{{ 'Rp.' . number_format($data->harga_beli, 0, ',', '.') }}</td>
                        <td>{{ 'Rp.' . number_format($data->harga_jual, 0, ',', '.') }}</td>
                        <td>{{ $data->satuan_barang }}</td>
                        <td>
                            <a data-toggle="modal" data-target="#edit{{ $data->id }}"
                                class="btn btn-warning"><i class="fas fa-edit"></i></a>
                            <button wire:click="delete({{ $data->id }})" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                        </td>
                        <div class="modal fade" id="edit{{ $data->id }}">
                            <livewire:barang.editbarang :$data :key="$data->id">
                        </div>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="5">total</td>
                    <td class="text-center">{{ number_format($totalstock, 0, ',', '.') }}</td>
                    <td class="text-center">Rp.{{ number_format($harga_beli, 0, ',', '.') }}</td>
                    <td class="text-center">Rp.{{ number_format($harga_jual, 0, ',', '.') }}</td>
                    <td colspan="2" class="bg-secondary "></td>
                </tr>
            </tbody>
        </table>
        <div class="paginasi mt-5">
            {{ $barangs->links() }}
        </div>
    </div>
    <!-- /.card-body -->


    <!-- /.modal insert modal-->
    <div class="modal fade" id="insert">
        <livewire:barang.insertbarang>
    </div>
    <!-- /.modal -->
</div>
