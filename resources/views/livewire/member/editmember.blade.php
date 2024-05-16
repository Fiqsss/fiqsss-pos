<?php

use function Livewire\Volt\{state};
use Livewire\WithPagination;
use Livewire\Volt\Component;
use App\Models\Member;
use Livewire\WithFileUploads;

new class extends Component {
    use WithPagination;
    use WithFileUploads;

    public $memberId;
    public $data;
    public $nik;
    public $nama_member;
    public $alamat_member;
    public $telepon;
    public $email;
    public $gambar;
    public $gambarbaru;

    public function mount($data)
    {
        $this->memberId = $data->id;
        $this->nik = $data->nik;
        $this->nama_member = $data->nama_member;
        $this->alamat_member = $data->alamat_member;
        $this->telepon = $data->telepon;
        $this->email = $data->email;
        $this->gambar = $data->gambar;
    }

    public function editMember()
    {
        $validated = $this->validate([
            'nik' => 'required|numeric',
            'nama_member' => 'required',
            'alamat_member' => 'required',
            'telepon' => 'required|numeric',
            'email' => 'required|email',
        ]);

        $member = Member::find($this->memberId);

        if ($this->gambarbaru) {
            Storage::disk('public')->delete('/member/' . $member->gambar);
            $namaFile = $this->nama_member . '.' . $this->gambarbaru->extension();
            $gambarPath = $this->gambarbaru->storeAs('public/member', $namaFile);
            $member->gambar = $namaFile;
        }

        $member->update([
            'nik' => $this->nik,
            'nama_member' => $this->nama_member,
            'alamat_member' => $this->alamat_member,
            'telepon' => $this->telepon,
            'email' => $this->email,
        ]);
        return redirect()->route('member')->with('success', 'Data barang berhasil di ubah');
    }
};
?>


<div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning  ">
                <h4 class="modal-title text-white">Edit Data Member</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
                            <label for="img" class="w-100 h-50 borde-1 d-flex justify-content-center align-items-center "
                                style="border-style:dashed;">
                                <i class="fas fa-plus"></i></label>
                            <input hidden id="img" type="file"
                                class="@error('gambarbaru') is-invalid @enderror mt-1 p-0" wire:model='gambarbaru'>
                        </div>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button wire:click.prevent='editMember' type="submit" class="btn btn-primary">Save Data</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
