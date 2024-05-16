<?php
use Livewire\WithPagination;
use App\Models\User;
use Livewire\Volt\Component;
use function Livewire\Volt\{state};

new class extends Component {
    public $name;
    public $email;
    public $password;
    public $repassword;
    public $role = 'user';

    public function insert()
    {
        $this->validate([
            'name' => 'required|unique:users,name',
            'email' => 'required| unique:users,email',
            'password' => 'required|min:5|same:repassword|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%@]).*$/',
            'repassword' => 'required|min:5|same:password|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%@]).*$/',
            'role' => 'required',
        ]);

        if ($this->password != $this->repassword) {
            session()->flash('gagal', 'Password tidak sama');
            return;
        }

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'password' => bcrypt($this->password),
        ]);

        redirect('/master/user')->back()->with('success', 'Data user berhasil ditambahkan');
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
                <form class="w-100" wire:submit.prevent='insert'>
                    <label class="mt-3" for="name">Name</label>
                    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror"
                        wire:model='name'>
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <label class="mt-3" for="email">email</label>
                    <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                        wire:model='email'>
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <label class="mt-3" for="role">role</label>
                    <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" wire:model='role'>
                        <option value="user">user</option>
                        <option value="admin">admin</option>
                    </select>
                    @error('role')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <label class="mt-3" for="password">password</label>
                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                        wire:model='password'>
                    @error('password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <label class="mt-3" for="repassword">re-password</label>
                    <input type="password" id="repassword"
                        class="form-control @error('repassword') is-invalid @enderror" wire:model='repassword'>
                    @error('repassword')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
