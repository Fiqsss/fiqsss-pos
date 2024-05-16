<?php

use Livewire\WithPagination;
use Livewire\Volt\Component;
use App\Models\Barang;
use App\Models\Member;
use Livewire\Attributes\On;
use function Livewire\Volt\{state};

new class extends Component {
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function with()
    {
        return [
            'members' => Member::latest()->get(),
        ];
    }

    public function deleteData($id)
    {
        $data = Member::find($id);

        if ($data->gambar) {
            Storage::disk('public')->delete('/member/' . $data->gambar);
        }
        $data->delete();
        return redirect('master/member')->with('success', 'member berhasil dihapus');
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
                    <th>Nik</th>
                    <th>Nama Member</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- {{ dd($members) }} --}}
                @foreach ($members as $index => $data)
                    <tr class="text-center">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $data->nik }}</td>
                        <td>{{ $data->nama_member }}</td>
                        <td>{{ $data->alamat_member }}</td>
                        <td>{{ $data->telepon }}</td>
                        <td>{{ $data->email }}</td>
                        <td>
                            <a data-toggle="modal" data-target="#edit{{ $data->id }}"><i
                                    class="fas fa-edit" style="color: orange"></i></a>
                            <a data-toggle="modal" data-target="#dell{{ $data->id }}" class="mx-2" ><i
                                    class="fas fa-trash" style="color:red"></i></a>

                            <a wire:click="delete({{ $data->id }})" ><i
                                    class="fas fa-eye" style="color:green"></i></a>
                        </td>
                        <div class="modal fade" id="edit{{ $data->id }}">
                            <livewire:member.editmember :$data :key="$data->id">
                        </div>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="dell{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content modal-">
                                <div class="modal-body">
                                    <h5>Yakin ingin menghapus Membaer <span class="text-danger">{{ $data->nama_member }}</span></h5>
                                </div>
                                <div class="modal-footer">
                                    <button wire:click="deleteData({{ $data->id }})" type="button" class="btn btn-danger w-25">Hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
        <div class="paginasi mt-5">
            {{-- {{ $barangs->links() }} --}}
        </div>
    </div>
    <!-- /.card-body -->

    <!-- /.modal insert modal-->
    <div class="modal fade" id="insert">
        <livewire:member.insertmember>
    </div>
    <!-- /.modal -->
</div>
