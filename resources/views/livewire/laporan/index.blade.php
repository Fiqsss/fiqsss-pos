<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\Barang;
use App\Models\nota;
use App\Models\Cart;
use Livewire\Attributes\On;
use Carbon\Carbon;

use function Livewire\Volt\{state};

new class extends Component {
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $startDate;
    public $endDate;
    public $searchResults = [];

    // public function mount()
    // {
    //     // Konversi properti searchResults menjadi objek Collection
    //     $this->searchResults = collect($this->searchResults);
    // }

    public function with()
    {
        return [
            'datas' => $this->searchResults == [] ? [] : nota::whereBetween('tanggal_transaksi', [$this->startDate, $this->endDate])->paginate(10),
        ];
    }

    public function cariData()
    {
        $this->validate(
            [
                'startDate' => 'required',
                'endDate' => 'required',
            ],
            [
                'startDate.required' => 'Form tanggal mulai harus diisi.',
                'endDate.required' => 'Form tanggal akhir harus diisi.',
            ],
        );

        $this->searchResults = nota::whereBetween('tanggal_transaksi', [$this->startDate, $this->endDate])->get();
    }
};

?>
<div>
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <div class="d-flex flex-column align-items-center w-100 ">
                <div class="searchdate w-100 d-flex justify-content-center ">
                    <div class="wrap-search w-75">
                        <div class="startdate mb-4">
                            <label for="start">Start Date</label>
                            <input wire:model='startDate' id="start" class="form-control shadow" type="date">
                            @error('startDate')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="enddate mb-4">
                            <label for="end">End Date</label>
                            <input wire:model='endDate' id="end" class="form-control shadow" type="date">
                            @error('endDate')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="btncari w-100 d-flex justify-content-end ">
                            <button wire:click='cariData' class="carilaporan btn-primary w-25 rounded mt-3 shadow">
                                Cari
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-header d-flex justify-content-between  ">
            <div class="form-page">
                <select style="width: 5rem" class="form-control shadow " wire:model.live='paginate' id="">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                </select>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>ID Barang</th>
                        <th>Nama Barang</th>
                        <th>Member</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>

                    @if (!$searchResults == [])
                <tbody>
                    @foreach ($datas as $index => $data)
                        <tr class="text-center">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->barang->barcode }}</td>
                            <td>{{ $data->barang->nama_barang }}</td>
                            <td>
                                @if ($data->member)
                                    {{ $data->member->nama_member }}
                                @else
                                    <span> </span>
                                @endif
                            </td>

                            <td>{{ $data->jumlah }}</td>
                            <td>{{ $data->total }}</td>
                            <td>{{ \Carbon\Carbon::parse($data->tanggal_transaksi)->format('d-m-Y') }}
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                    </tr>
                </tbody>
            @else
                <tr>
                    <td colspan="8" class="text-center">
                        <span class="text-danger">
                            Silahkan Masukan data yang ingin kamu cari terlebih dahulu!
                        </span>
                    </td>
                </tr>
                @endif
            </table>
            <div class="paginasi mt-5">
                @if ($searchResults === [])
                    <div></div>
                @else
                    {{ $datas->links() }}
                @endif
            </div>
        </div>
    </div>
</div>
