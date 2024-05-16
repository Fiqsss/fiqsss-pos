<?php
use function Livewire\Volt\{state};

use Livewire\WithPagination;
use Livewire\Volt\Component;
use App\Models\Barang;
use App\Models\Cart;
use App\Models\nota;
use App\Models\Kategori;
use App\Models\Member;
use Livewire\Attributes\On;
use Illuminate\Support\Collection;

new class extends Component {
    use WithPagination;
    public $product_id;
    public $kategori_id;
    public $hargaJual;
    public $totalHarga;
    public $paginate = 5;
    public $jumlah;
    public $uang = 0;
    public $member;
    public $paginationTheme = 'bootstrap';

    #[On('productSelected')]
    public function selectProduct($product)
    {
        // dd($product);
        $this->product_id = $product['id'];
        $this->jumlah = 1;
        $this->kategori_id = $product['kategori_id'];
        $this->hargaJual = $product['harga_jual'];

        $exist = Cart::where('barang_id', $this->product_id)->first();
        if ($exist) {
            $exist->update([
                'jumlah' => $exist->jumlah + $this->jumlah,
                'total_harga' => ($exist->jumlah + 1) * $this->hargaJual,
            ]);
            $this->totalHarga = $exist->total_harga;
        } else {
            Cart::create([
                'barang_id' => $this->product_id,
                'kategori_id' => $this->kategori_id,
                'jumlah' => $this->jumlah,
                'total_harga' => $this->jumlah * $this->hargaJual,
            ]);
        }
        $this->reset();
    }

    public function with()
    {
        $cart = Cart::latest()->get();
        return [
            'cart' => $cart,
            'members' => Member::latest()->get(),
        ];
    }

    public function delete($id)
    {
        $data = Cart::find($id);
        $data->delete();
    }

    public function tambahJumlah()
    {
        $this->jumlah + 1;
    }

    public function kurangiStock($id)
    {
        $cart = Cart::where('id', $id)->first();
        $jumlah = $cart->jumlah;
        $total_harga = $cart->barang->harga_jual;
        $cart->update([
            'jumlah' => ($jumlah -= 1),
            'total_harga' => $jumlah * $total_harga,
        ]);
        $cart->save();
    }

    public function tambahStock($id)
    {
        $cart = Cart::where('id', $id)->first();
        $jumlah = $cart->jumlah;
        $total_harga = $cart->barang->harga_jual;
        $cart->update([
            'jumlah' => ($jumlah += 1),
            'total_harga' => $jumlah * $total_harga,
        ]);
        $cart->save();
    }

    #[On('muatulang')]
    public function muatulang()
    {
        Cart::truncate();
    }
    public function bayar($data, $total)
    {
        // dd($this->member);
        if ($this->uang < $total) {
            return redirect('/transaksi')->with('gagal', 'Uang anda kurang');
        }

        $notas = [];
        foreach ($data as $item) {
            $notas[] = [
                'barang_id' => $item['barang_id'],
                'jumlah' => $item['jumlah'],
                'member_id' => $this->member,
                'total' => $item['barang']['harga_jual'] * $item['jumlah'],
                'tanggal_transaksi' => now(),
            ];
        }
        nota::insert($notas);
        Cart::truncate();
        return redirect('/transaksi')->with('success', 'Bembayaran Berhasil');
    }

};
?>
<div>
    <div class="tanggal d-flex align-items-center ">
        <p class="mr-2">Tanggal :</p>
        <input type="text" value="{{ \Carbon\Carbon::now()->format('d-m-Y') }}" class="rounded mb-3 form-control-sm bg-secondary text-center" readonly>
    </div>
    <div class="member d-flex align-items-center my-2">
        <p class="mr-2 mt-3">Member :</p>
        <select  wire:model='member'  class="form-control w-50 select2">
            <option value=" ">Pilih Member</option>
            @foreach ($members as $member)
                <option value="{{ $member->id }}">{{ $member->nama_member }}</option>
            @endforeach
        </select>
    </div>
    <table class=" w-100 table-bordered table-striped">
        <thead>
            <tr class="text-center">
                <th>#</th>
                <th>Nama Produck</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalHarga = 0;
            @endphp
            @if ($cart->isNotEmpty())
                @foreach ($cart as $a => $data)
                    <tr class="text-center">
                        <td>{{ $a + 1 }}</td>
                        <td>{{ $data->barang->nama_barang }}</td>
                        <td class="text-center">
                            <div class="w-100 d-flex justify-content-center align-items-center ">
                                <button wire:click.prevent='kurangiStock({{ $data->id }})'
                                    style="width:1.5rem; height: 1.5rem;"
                                    class="btn btn-secondary p-0 m-0 d-flex align-items-center justify-content-center ">-</button>
                                <input style="width:2rem; height: 2rem;" value="{{ $data->jumlah }}"
                                    class="form-control text-center mx-2 p-0" type="text" readonly>
                                <button wire:click.prevent='tambahStock({{ $data->id }})'
                                    style="width:1.5rem; height: 1.5rem;"
                                    class="btn btn-secondary p-0 m-0 d-flex align-items-center justify-content-center ">+</button>
                            </div>
                        </td>
                        <td wire:model.live='jumlah'>{{ 'Rp.' . number_format($data->total_harga, 0, ',', '.') . ',-' }}
                        </td>
                        <td class="py-2">
                            <button style="width: 2rem; height:2rem; padding:0px !important"
                                wire:click="delete({{ $data->id }})" class="btn btn-danger "><i
                                    class="fas fa-trash "></i></button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8" class="text-center">
                        <span class="text-danger">
                            Silahkan pilih barang terlebih dahulu!
                        </span>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
    <hr>
    <div class="mt-3">
        <div class="row">
            <div class="col-md-4">
                <h6>Total Harga</h6>
                <input class="form-control"
                    value=" {{ 'Rp.' . number_format($cart->sum('total_harga'), 0, ',', '.') . ',-' }}" type="text"
                    readonly>
            </div>
            <div class="col-md-4">
                <h6>Uang</h6>
                <input step="1000" id="uang" wire:model.live='uang' class="form-control" type="number"
                    required>
            </div>
            <div class="col-md-4">
                <h6>Kembali</h6>
                <input class="form-control"
                    value=" {{ 'Rp.' . number_format($uang - $cart->sum('total_harga'), 0, ',', '.') . ',-' }}"
                    type="text" readonly>
            </div>
        </div>
        <div class="total">
            <button wire:click='bayar({{ $cart }}, {{ $cart->sum('total_harga') }})'
                class="mt-2 rounded btn-success">Bayar</button>
        </div>
    </div>
</div>
