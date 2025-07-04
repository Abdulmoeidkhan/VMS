<div class="notPrintable">
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="attandeeName" class="form-label">Name</label>
                    <input type="text" wire:model='name' class="form-control @error('name') is-invalid @enderror" id="attandeeName" placeholder="Enter Name" required>
                    <div class="invalid-feedback">
                        @error('name')<span class="error">
                            {{ $message }}
                        </span>@enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="attandeeIdentity" class="form-label">CNIC/Passport</label>
                    <input type="text" wire:model='identity' class="form-control @error('identity') is-invalid @enderror" pattern="^[a-zA-Z0-9]{9,13}$" id="attandeeIdentity" placeholder="Enter Identity">
                    <div class="invalid-feedback">
                        @error('identity')<span class="error">
                            {{ $message }}
                        </span>@enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="attandeeDesignation" class="form-label">Designation</label>
                    <input type="text" wire:model='designation' class="form-control @error('designation') is-invalid @enderror" id="attandeeDesignation" placeholder="Enter Designation" required>
                    <div class="invalid-feedback">
                        @error('designation')<span class="error">
                            {{ $message }}
                        </span>@enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="attandeeCompany" class="form-label">Company/Institute</label>
                    <input type="text" wire:model='attandeeCompany' class="form-control @error('attandeeCompany') is-invalid @enderror" id="attandeeCompany" placeholder="Enter Company Name" required>
                    <div class="invalid-feedback">
                        @error('attandeeCompany')<span class="error">
                            {{ $message }}
                        </span>@enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="attandeeContact" class="form-label">Contact</label>
                    <input type="text" wire:model="contact" class="form-control @error('contact') is-invalid @enderror" id="attandeeContact" placeholder="Enter Contact Number">
                    <div class="invalid-feedback">
                        @error('contact')<span class="error">
                            {{ $message }}
                        </span>@enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="attandeeEmail" class="form-label">Email</label>
                    <input type="text" wire:model='email' class="form-control @error('email') is-invalid @enderror" id="attandeeEmail" placeholder="Enter Email Address">
                    <div class="invalid-feedback">
                        @error('email')<span class="error">
                            {{ $message }}
                        </span>@enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="attandeeCountry" class="form-label">Attandee Country</label>
                    <select wire:model='attandeeCountry' class="form-control @error('attandeeCountry') is-invalid @enderror" id="attandeeCountry">
                        <option value="" selected disabled hidden> Select Attandee Country</option>
                        @foreach (\App\Models\Country::all() as $key=>$country)
                        <option value="{{$country->name}}">{{$country->name}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        @error('attandeeCountry')<span class="error">
                            {{ $message }}
                        </span>@enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="attandeeEmail" class="form-label">Save & Print</label>
                    <button wire:click="addNew" class="form-control btn btn-outline-success">Save & Print</button>
                    @if(session()->has('message'))
                    <div class="alert alert-success mt-3">
                        {{ session('message') }}
                    </div>
                    @endif
                    @if(session()->has('error'))
                    <div class="alert alert-danger mt-3">
                        {{ session('error') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @script
    <script>
        $wire.on('slipPrint', (data) => {
            window.open(`{{url('')}}/slip/${data[0]}`, "_blank", "width=500,height=500");
        });
    </script>
    @endscript
</div>