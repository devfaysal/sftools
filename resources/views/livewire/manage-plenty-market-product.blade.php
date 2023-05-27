<div>
    <div class="form-group row">
        <label for="mu_varient" class="col-sm-2 col-form-label">{{__('MU-Varient')}}</label>
        <div class="col-sm-10">
            <input type="text" class="form-control {{$errors->has('mu_varient') ? ' is-invalid':''}}" {{ $update ? 'readonly' : '' }} wire:model.lazy="product.mu_varient" id="mu_varient" name="mu_varient">
            <div wire:loading wire:target="product.mu_varient">
                <small>Fetching product name...</small>
            </div>
            @error('mu_varient')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="product_name" class="col-sm-2 col-form-label">{{__('Product Name')}}</label>
        <div class="col-sm-10">
            <input type="text" class="form-control {{$errors->has('product_name') ? ' is-invalid':''}}" wire:model="product.product_name" id="product_name" name="product_name">
            @error('product_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="ms_varient" class="col-sm-2 col-form-label">{{__('MS-Varient')}}</label>
        <div class="col-sm-10">
            <input type="text" class="form-control {{$errors->has('ms_varient') ? ' is-invalid':''}}" {{ $update ? 'readonly' : '' }} wire:model.lazy="product.ms_varient" id="ms_varient" name="ms_varient">
            <div wire:loading wire:target="product.ms_varient">
                <small>Fetching product name...</small>
            </div>
            <small>{{ $msName }}</small>
            @error('ms_varient')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="on_varient" class="col-sm-2 col-form-label">{{__('ON-Varient')}}</label>
        <div class="col-sm-10">
            <input type="text" class="form-control {{$errors->has('on_varient') ? ' is-invalid':''}}" {{ $update ? 'readonly' : '' }} wire:model.lazy="product.on_varient" id="on_varient" name="on_varient">
            <div wire:loading wire:target="product.on_varient">
                <small>Fetching product name...</small>
            </div>
            <small>{{ $onName }}</small>
            @error('on_varient')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="minimum_stock" class="col-sm-2 col-form-label">{{__('Minimum Stock')}}</label>
        <div class="col-sm-10">
            <input type="number" class="form-control {{$errors->has('minimum_stock') ? ' is-invalid':''}}" wire:model="product.minimum_stock" id="minimum_stock" name="minimum_stock">
            @error('minimum_stock')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    @if($update)
    <div class="form-group row">
        <label for="status" class="col-sm-2 col-form-label">{{__('Status')}}</label>
        <div class="col-sm-10">
            <div class="custom-control custom-radio">
                <input type="radio" wire:model="product.status" id="active" name="status" value="Active" class="custom-control-input">
                <label class="custom-control-label" for="active">Active</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" wire:model="product.status" id="inactive" name="status" value="Inactive" class="custom-control-input">
                <label class="custom-control-label" for="inactive">Inactive</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" wire:model="product.status" id="imported" name="status" value="Imported" class="custom-control-input">
                <label class="custom-control-label" for="imported">Imported</label>
            </div>
            @error('status')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    @endif
    <div class="form-group row">
        <div class="col-sm-12">
            @if($update)
                <button wire:click="updateProduct" wire:loading.attr="disabled" class="pull-right px-4 btn btn-oval btn-info">{{__('Update')}}</button>
            @else 
                <button wire:click="saveProduct" wire:loading.attr="disabled" class="pull-right px-4 btn btn-oval btn-info" {{$disabled}}>{{__('Save')}}</button>
                <div wire:loading wire:target="saveProduct">
                    Saving product and updating stock...
                </div>
            @endif
        </div>
    </div>
</div>
