<div class="row setup-content {{ $currentStep != 1 ? 'd-none' : '' }}" id="step-1">
    <div class="col-12">
        <div class="card shadow rounded-3">
            <div class="card-body">
                <!-- Email & Password -->
                
                <div class="form-row mb-3">
                    <div class="col-md-6">
                        <label>{{ trans('Parent_trans.Email') }}</label>
                        <input type="email" wire:model.live.debounce.500ms="Email" class="form-control">
                        @error('Email') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label>{{ trans('Parent_trans.Password') }}</label>
                        <input type="password" wire:model="Password" class="form-control">
                        @error('Password') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Name -->
                <div class="form-row mb-3">
                    <div class="col-md-6">
                        <label>{{ trans('Parent_trans.Name_Father') }}</label>
                        <input type="text" wire:model="Name_Father" class="form-control">
                        @error('Name_Father') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label>{{ trans('Parent_trans.Name_Father_en') }}</label>
                        <input type="text" wire:model="Name_Father_en" class="form-control">
                        @error('Name_Father_en') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Job, National ID, Passport, Phone -->
                <div class="form-row mb-3">
                    <div class="col-md-3">
                        <label>{{ trans('Parent_trans.Job_Father') }}</label>
                        <input type="text" wire:model="Job_Father" class="form-control">
                        @error('Job_Father') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-3">
                        <label>{{ trans('Parent_trans.Job_Father_en') }}</label>
                        <input type="text" wire:model="Job_Father_en" class="form-control">
                        @error('Job_Father_en') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-2">
                        <label>{{ trans('Parent_trans.National_ID_Father') }}</label>
                        <input type="text" wire:model.live.debounce.500ms="National_ID_Father" class="form-control">
                        @error('National_ID_Father') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-2">
                        <label>{{ trans('Parent_trans.Passport_ID_Father') }}</label>
                        <input type="text" wire:model.live.debounce.500ms="Passport_ID_Father" class="form-control">
                        @error('Passport_ID_Father') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-2">
                        <label>{{ trans('Parent_trans.Phone_Father') }}</label>
                        <input type="text" wire:model.live.debounce.500ms="Phone_Father" class="form-control">
                        @error('Phone_Father') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Select Options -->
                <div class="form-row mb-3">
                    <div class="form-group col-md-4">
                        <label>{{ trans('Parent_trans.Nationality_Father_id') }}</label>
                        <select class="custom-select" wire:model="Nationality_Father_id">
                            <option selected>{{ trans('Parent_trans.Choose') }}...</option>
                            @foreach($Nationalities as $National)
                                <option value="{{ $National->id }}">{{ $National->Name }}</option>
                            @endforeach
                        </select>
                        @error('Nationality_Father_id') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label>{{ trans('Parent_trans.Blood_Type_Father_id') }}</label>
                        <select class="custom-select" wire:model="Blood_Type_Father_id">
                            <option selected>{{ trans('Parent_trans.Choose') }}...</option>
                            @foreach($Type_Bloods as $Type_Blood)
                                <option value="{{ $Type_Blood->id }}">{{ $Type_Blood->Name }}</option>
                            @endforeach
                        </select>
                        @error('Blood_Type_Father_id') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label>{{ trans('Parent_trans.Religion_Father_id') }}</label>
                        <select class="custom-select" wire:model="Religion_Father_id">
                            <option selected>{{ trans('Parent_trans.Choose') }}...</option>
                            @foreach($Religions as $Religion)
                                <option value="{{ $Religion->id }}">{{ $Religion->Name }}</option>
                            @endforeach
                        </select>
                        @error('Religion_Father_id') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="form-group mb-4">
                    <label>{{ trans('Parent_trans.Address_Father') }}</label>
                    <textarea class="form-control" wire:model="Address_Father" rows="3"></textarea>
                    @error('Address_Father') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <!-- Next Button -->
                <div class="d-flex justify-content-end">
                    <button class="btn btn-success px-4" wire:click="firstStepSubmit" type="button">
                        {{ trans('Parent_trans.Next') }}
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>