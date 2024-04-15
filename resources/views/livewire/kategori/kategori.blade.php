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
    public $nama_kategori;

    public function with()
    {
        return [
            'kategoris' =>
                $this->search === null
                    ? Kategori::latest()->paginate($this->paginate)
                    : Kategori::latest()
                        ->where('nama_kategori', 'like', '%' . $this->search . '%')
                        ->paginate($this->paginate),
        ];
    }

    public function insertkategori()
    {
        $this->validate(
            [
                'nama_kategori' => 'unique:kategoris,nama_kategori',
            ],
            [
                'nama_kategori.unique' => 'Kategori ini sudah ada dalam database',
            ],
        );
        Kategori::create([
            'nama_kategori' => $this->nama_kategori,
        ]);

        $this->reset();
    }

    public function deletekategori($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();
    }
};

?>
<div class="card pt-5">
    <div class="actiondata d-flex justify-content-end mx-3">
        <div class="w-100 d-flex justify-content-end align-content-center ">
            <input wire:model.live='search' type="text" class="shadow form-control w-25" placeholder="Cari Barang">
        </div>
    </div>
    <hr>
    <div class="w-100  d-flex justify-content-between border-0 px-4">
        <div class="form-page d-flex align-items-center ">
            <select style="width: 5rem" class="form-control shadow " wire:model.live='paginate' id="">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
            </select>
        </div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#insert"><i
                style="margin-right: 0.6rem" class="fas fa-plus"></i>
            Tambah</button>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th class="col-2">Tanggal Input</th>
                    <th>Kode Kategori</th>
                    <th>Nama Kategori</th>
                    <th>Jumlah Barang</th>
                    <th class="col-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kategoris as $index => $data)
                    <tr class="text-center">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $data->created_at->format('d-m-Y') }} </td>
                        <td>{{ $data->kode }} </td>
                        <td>{{ $data->nama_kategori }} </td>
                        <td>{{ $data->barangs->count() }} </td>
                        <td>
                            <a data-toggle="modal" data-target="#edit{{ $data->id }}"
                                class="btn btn-warning"><i class="fas fa-edit "></i></a>
                            <button wire:click="deletekategori({{ $data->id }})"
                                class="btn btn-danger"><i class="fas fa-trash"></i></button>
                        </td>
                        <div class="modal fade" id="edit{{ $data->id }}">
                            <livewire:kategori.editkategori :$data :key="$data->id">
                        </div>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="paginasi mt-5">

            {{ $kategoris->links() }}
        </div>
    </div>
    <!-- /.card-body -->


    <!-- /.modal insert modal-->
    <div class="modal fade" id="insert">
        <livewire:kategori.insertkategori>
    </div>
    <!-- /.modal -->
</div>
