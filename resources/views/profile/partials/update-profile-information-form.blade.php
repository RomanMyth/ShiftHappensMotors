<section>
    <style>
       input[type="text"],
input[type="email"], {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

input[type="text"],
input[type="email"],
textarea {
    border: 1px solid #ccc;
    border-radius: 5px;
    /* box-shadow: 0 0 5px black; */
    margin-bottom: 20px;
}

input[type="text"]:hover,
input[type="email"]:hover,
textarea:hover {
    border-color: black; /* Change border color on hover */
}

input[type="text"]:focus,
input[type="email"]:focus,
textarea:focus {
    border-color: black; /* Change border color on focus */
    box-shadow: 0 0 5px black; /* Add box shadow on focus */
    outline: black;
}

col-lg-3{
    display: flex;
    flex-direction: column;
    align-items: center; /* Center horizontally */
    justify-content: center; /* Center vertically */
    text-align: center; /* Center text */
            }

            .row {
    display: flex;
    justify-content: center; /* Center the columns horizontally */
}

.passwordContainer {
    display: flex;
    justify-content: center; /* Center the container horizontally */
    align-items: center; /* Center the container vertically */
    /* height: 100vh; Set the container height to full viewport height */
}

button {
    font-weight: bold;
    background-color: black;
    color: white;
    cursor: pointer;
    border: none;
    width: 88px;
    height: 44px;
    border: none;
}

    </style>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="get" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf

        <div class="passwordContainer">
            <div class="col-lg-3">
            <x-input-label for="firstName" :value="__('Name')" />
            <x-text-input id="name" name="firstName" type="text" class="mt-1 block w-full" :value="old('firstName', $user->firstName)" required autofocus autocomplete="firstName" />
            <x-input-error class="mt-2" :messages="$errors->get('firstName')" />

            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>
        </div>

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
