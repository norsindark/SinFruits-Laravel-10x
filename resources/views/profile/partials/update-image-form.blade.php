<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Image') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your profile image.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update-image') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="profile_image" :value="__('Profile Image')" />
            <input type="file" id="profile_image" name="profile_image" accept="image/*" class="mt-1 block w-full" />
            <x-input-error class="mt-2" :messages="$errors->get('profile_image')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Upload Image') }}</x-primary-button>

            @if (session('status') === 'image-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Image updated.') }}</p>
            @endif
        </div>
    </form>
</section>
