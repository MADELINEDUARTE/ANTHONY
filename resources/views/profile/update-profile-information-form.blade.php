<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-jet-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-jet-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-jet-secondary-button>
                @endif

                <x-jet-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Name') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
            <x-jet-input-error for="name" class="mt-2" />
        </div>

        <!-- middle_name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="middle_name" value="{{ __('Middle Name') }}" />
            <x-jet-input id="middle_name" type="text" class="mt-1 block w-full" wire:model.defer="state.middle_name" />
            <x-jet-input-error for="middle_name" class="mt-2" />
        </div>

        <!-- last_name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="last_name" value="{{ __('Last Name') }}" />
            <x-jet-input id="last_name" type="text" class="mt-1 block w-full" wire:model.defer="state.last_name" />
            <x-jet-input-error for="last_name" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="gender_id" value="{{ __('Gender') }}" />
            {{--<x-jet-input id="gender_id" type="text" class="mt-1 block w-full" wire:model.defer="state.gender_id" />--}}
            
            <select name="gender_id" id="gender_id" wire:model.defer="state.gender_id" class="px-3 py-2 block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
        
                @foreach (\App\Models\Gender::all() as $gender)
                    <option value="{{  $gender->id }}"
                    @if ($gender->id == Auth::user()->gender_id)
                        selected="selected"                                   
                    @endif
                    >{{ $gender->description }}</option>
                @endforeach
            </select>
            
            <x-jet-input-error for="gender_id" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="date_of_birth" value="{{ __('Date of Birth') }}" />
            <x-jet-input id="date_of_birth" type="text" class="mt-1 block w-full" wire:model.defer="state.date_of_birth" />
            <x-jet-input-error for="date_of_birth" class="mt-2" />
        </div>

        

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="country_id" value="{{ __('Country') }}" />
            {{--<x-jet-input id="country_id" type="text" wire:model.defer="state.country_id" class="mt-1 block w-full" wire:model.defer="state.country_id" />--}}
            <select name="country_id" id="country_id" wire:model.defer="state.country_id" class="px-3 py-2 block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
        
                @foreach (\App\Models\Country::all() as $country)
                    <option value="{{  $country->id }}"
                    @if ($country->id == Auth::user()->country_id)
                        selected="selected"                                   
                    @endif
                    >{{ $country->description }}</option>
                @endforeach
            </select>
            <x-jet-input-error for="country_id" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="address" value="{{ __('Address') }}" />
            <x-jet-input id="address" type="text" class="mt-1 block w-full" wire:model.defer="state.address" />
            <x-jet-input-error for="address" class="mt-2" />
        </div>


        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="telephone" value="{{ __('Telephone') }}" />
            <x-jet-input id="telephone" type="text" class="mt-1 block w-full" wire:model.defer="state.telephone" />
            <x-jet-input-error for="telephone" class="mt-2" />
        </div>


        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="mt-2" />
        </div>
        
        
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
