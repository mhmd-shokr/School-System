<div>
    <div>
        @if (!empty($successMessage))
            <div class="alert alert-success" id="success-alert">
                <button type="button" class="close" data-dismiss="alert">x</button>
                {{ $successMessage }}
            </div>
        @endif

        @if($catchError)
        <div class="alert alert-danger">{{ $catchError }}</div>
        @endif
    
        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                    <a href="#step-1" type="button"
                        class="btn btn-circle {{ $currentStep != 1 ? 'btn-default' : 'btn-success' }}">1</a>
                    <p>{{ trans('Parent_trans.Step1') }}</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-2" type="button"
                        class="btn btn-circle {{ $currentStep != 2 ? 'btn-default' : 'btn-success' }}">2</a>
                    <p>{{ trans('Parent_trans.Step2') }}</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-3" type="button"
                        class="btn btn-circle {{ $currentStep != 3 ? 'btn-default' : 'btn-success' }}"
                        disabled="disabled">3</a>
                    <p>{{ trans('Parent_trans.Step3') }}</p>
                </div>
            </div>
        </div>


        @include('livewire.Father_Form')

        @include('livewire.Mother_Form')


        <div class="row setup-content {{ $currentStep != 3 ? 'd-none' : '' }}" id="step-3">
            <div class="col-12">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-body text-center">
        
                        <h3 class="mb-4 fw-bold" style="font-family: 'Cairo', sans-serif; color: #333;">
                            {{ trans("parent_trans.Are You Sure for conformaton") }}
                        </h3>
        
                        <div class="d-flex justify-content-center gap-3">
                            <button type="button" 
                                class="btn btn-danger btn-lg px-4"
                                wire:click="back(2)">
                                {{ trans('Parent_trans.Back') }}
                            </button>
        
                            <button type="button" 
                                class="btn btn-success btn-lg px-4"
                                wire:click="submitForm">
                                {{ trans('Parent_trans.Finish') }}
                            </button>
                        </div>
        
                    </div>
                </div>
            </div>
        </div>
        
        
    </div>
</div>