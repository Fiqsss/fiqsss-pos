<?php
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
use function Livewire\Volt\{state};

new class extends Component {
    public $email;
    public $password;

    public function login()
    {
        // dd($this->email);
        $this->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = ['email' => $this->email, 'password' => $this->password];

        if (Auth::attempt($user)) {
            return redirect()->route('home');
        } else {
            return redirect()->route('login')->with('error', 'Login gagal');
        }
    }
};

?>
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="{{ asset('logins/images/img-01.png') }}" alt="IMG">
            </div>

            <div class="login100-form validate-form">
                <form wire:submit.prevent="login">
                    <span class="login100-form-title">
                        Member Login
                    </span>

                    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                        <input wire:model="email" style="@error('email') border: 1px solid red @enderror"
                            wire:model="email" class="input100" type="text" name="email" placeholder="Email">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>
                    <p class="text-danger mb-3">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </p>

                    <div class="wrap-input100 validate-input" data-validate = "Password is required">
                        <input wire:model="password" style="@error('password') border: 1px solid red @enderror"
                            class="input100" type="password" name="pass" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>
                    <p class="text-danger mb-3">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </p>

                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            Login
                        </button>
                    </div>
                    <div class="text-center p-t-136">

                    </div>
                </form>
            </div>
        </div>
    </div>
