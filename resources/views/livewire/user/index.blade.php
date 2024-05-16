<?php

use Livewire\WithPagination;
use Livewire\Volt\Component;
use App\Models\Barang;
use App\Models\User;
use App\Models\Kategori;
use Livewire\Attributes\On;
use function Livewire\Volt\{state};
new class extends Component {
    public $paginate = 10;
    public function with()
    {
        return [
            'users' => User::latest()->paginate($this->paginate),
        ];
    }

    public function deleteuser($id)
    {
        $user = User::where('id', $id)->first();
        User::find($id)->delete();
        session()->flash('delluser', 'Data user "' . $user->name . '" berhasil dihapus');
    }
};

?>

<div>
    <div class="card pt-5">
        <div class="w-100  d-flex justify-content-between border-0 px-4">

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#insert">
                <i style="margin-right: 0.6rem" class="fas fa-plus"></i> Tambah
            </button>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            @if (session('delluser'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session('delluser') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th class="col-2">Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Tanggal di buat</th>
                        <th class="col-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $data)
                        <tr class="text-center">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->name }} </td>
                            <td>{{ $data->email }} </td>
                            <td>{{ $data->role }} </td>
                            <td>{{ $data->created_at->format('d-m-Y') }}</td>
                            <td>
                                <a data-toggle="modal" data-target="#edituser{{ $data->id }}" class="btn btn-warning"><i
                                        class="fas fa-edit "></i></a>
                                <button wire:click="deleteuser({{ $data->id }})" class="btn btn-danger"><i
                                        class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <div class="modal fade" id="edituser{{ $data->id }}">
                            <livewire:user.edituser :$data :idedit="$data->id">
                        </div>
                    @endforeach
                </tbody>
            </table>
            <div class="paginasi mt-5">
                {{ $users->links() }}
            </div>
        </div>
        <!-- /.card-body -->
        <!-- /.modal insert modal-->
        <div class="modal fade" id="insert">
            <livewire:user.insertuser>
        </div>

        {{-- <div class="modal fade" id="edituser{{ $data->id }}">
            <livewire:user.edituser>
        </div> --}}
        <!-- /.modal -->
    </div>

</div>
