<div class="row setup-content {{ $currentStep != 2 ? 'd-none' : '' }}" id="step-2">
    <div class="col-12">
        <div class="card shadow rounded-3">
            <div class="card-body">
                <!-- Name -->
                <div class="form-row mb-3">
                    <div class="col-md-6">
                        <label>{{ trans('Parent_trans.Name_Mother') }}</label>
                        <input type="text" wire:model="Name_Mother" class="form-control">
                        @error('Name_Mother') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label>{{ trans('Parent_trans.Name_Mother_en') }}</label>
                        <input type="text" wire:model="Name_Mother_en" class="form-control">
                        @error('Name_Mother_en') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Job, IDs, Phone -->
                <div class="form-row mb-3">
                    <div class="col-md-3">
                        <label>{{ trans('Parent_trans.Job_Mother') }}</label>
                        <input type="text" wire:model="Job_Mother" class="form-control">
                        @error('Job_Mother') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-3">
                        <label>{{ trans('Parent_trans.Job_Mother_en') }}</label>
                        <input type="text" wire:model="Job_Mother_en" class="form-control">
                        @error('Job_Mother_en') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-2">
                        <label>{{ trans('Parent_trans.National_ID_Mother') }}</label>
                        <input type="text" wire:model.live.debounce.500ms="National_ID_Mother" class="form-control">
                        @error('National_ID_Mother') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-2">
                        <label>{{ trans('Parent_trans.Passport_ID_Mother') }}</label>
                        <input type="text" wire:model.live.debounce.500ms="Passport_ID_Mother" class="form-control">
                        @error('Passport_ID_Mother') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-2">
                        <label>{{ trans('Parent_trans.Phone_Mother') }}</label>
                        <input type="text" wire:model.live.debounce.500ms="Phone_Mother" class="form-control">
                        @error('Phone_Mother') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Select Options -->
                <div class="form-row mb-3">
                    <div class="form-group col-md-4">
                        <label>{{ trans('Parent_trans.Nationality_Mother_id') }}</label>
                        <select class="custom-select" wire:model="Nationality_Mother_id">
                            <option selected>{{ trans('Parent_trans.Choose') }}...</option>
                            @foreach($Nationalities as $National)
                                <option value="{{ $National->id }}">{{ $National->Name }}</option>
                            @endforeach
                        </select>
                        @error('Nationality_Mother_id') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label>{{ trans('Parent_trans.Blood_Type_Mother_id') }}</label>
                        <select class="custom-select" wire:model="Blood_Type_Mother_id">
                            <option selected>{{ trans('Parent_trans.Choose') }}...</option>
                            @foreach($Type_Bloods as $Type_Blood)
                                <option value="{{ $Type_Blood->id }}">{{ $Type_Blood->Name }}</option>
                            @endforeach
                        </select>
                        @error('Blood_Type_Mother_id') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label>{{ trans('Parent_trans.Religion_Mother_id') }}</label>
                        <select class="custom-select" wire:model="Religion_Mother_id">
                            <option selected>{{ trans('Parent_trans.Choose') }}...</option>
                            @foreach($Religions as $Religion)
                                <option value="{{ $Religion->id }}">{{ $Religion->Name }}</option>
                            @endforeach
                        </select>
                        @error('Religion_Mother_id') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="form-group mb-4">
                    <label>{{ trans('Parent_trans.Address_Mother') }}</label>
                    <textarea class="form-control" wire:model="Address_Mother" rows="3"></textarea>
                    @error('Address_Mother') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-between">
                    <button class="btn btn-danger px-4" type="button" wire:click="back(1)">
                        {{ trans('Parent_trans.Back') }}
                    </button>
                    <button class="btn btn-success px-4" type="button" wire:click="secondStepSubmit">
                        {{ trans('Parent_trans.Next') }}
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
