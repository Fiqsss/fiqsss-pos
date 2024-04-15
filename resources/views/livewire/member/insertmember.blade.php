<?php

use function Livewire\Volt\{state};
use Livewire\WithPagination;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

use App\Models\Member;
new class extends Component {
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $paginate;
    public $nik;
    public $nama_member;
    public $alamat_member;
    public $telepon;
    public $email;
    public $gambar;

    public function insertData()
    {
        $validatedData = $this->validate([
            'nik' => 'required|min:4|numeric',
            'nama_member' => 'required',
            'alamat_member' => 'required',
            'telepon' => 'required',
            'email' => 'required|email',
            'gambar' => 'nullable|image|max:1024',
        ]);

        $memberData = [
            'nik' => $this->nik,
            'nama_member' => $this->nama_member,
            'alamat_member' => $this->alamat_member,
            'telepon' => $this->telepon,
            'email' => $this->email,
            'gambar' => '',
        ];
        if ($this->gambar) {
            $namaFile = $this->nama_member . '.' . $this->gambar->extension();
            $gambarPath = $this->gambar->storeAs('public/member', $namaFile);
            $memberData['gambar'] = $namaFile;
        }
        Member::create($memberData);
        return redirect()->route('member')->with('success', 'Data Member telah ditambahkan');
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
                <form class="w-100">
                    <div class="row">
                        <div class="col-6">
                            <label for="barcode">NIK</label>
                            <input id="nik" type="number"
                                class="form-control @error('nik') is-invalid @enderror " wire:model='nik'>
                        </div>
                        <div class="col-6">
                            <label class="" for="nama">Nama Member</label>
                            <input id="nama_member" type="text"
                                class="form-control @error('nama_member') is-invalid @enderror "
                                wire:model='nama_member'>
                        </div>
                        <div class="col-6">
                            <label class="mt-3" for="namabarang">Alamat</label>
                            <input id="alamat_member" type="text" wire:model='alamat_member'
                                class="form-control @error('alamat_member') is-invalid @enderror ">
                        </div>
                        <div class="col-6">
                            <label class="mt-3" for="telepon">Telepon</label>
                            <input id="telepon" type="text"
                                class="form-control @error('telepon') is-invalid @enderror" wire:model='telepon'>
                        </div>
                        <div class="col-6">
                            <label class="mt-3" for="email">email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                wire:model='email'>
                        </div>

                        <div class="col-6">
                            <label class="mt-3" for="img">Gambar</label>
                            <input id="img" type="file"
                                wire:model='gambar'>
                        </div>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button wire:click='insertData' type="submit" class="btn btn-primary">Save Data</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
