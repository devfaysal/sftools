<div class="form-group row">
    <label for="product_name" class="col-sm-2 col-form-label">{{__('Product Name')}}</label>
    <div class="col-sm-4">
        <input type="text" class="form-control {{$errors->has('product_name') ? ' is-invalid':''}}" value="{{old('product_name', $product->product_name)}}" id="product_name" name="product_name">
        @error('product_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="mu_varient" class="col-sm-2 col-form-label">{{__('MU-Varient')}}</label>
    <div class="col-sm-4">
        <input type="text" class="form-control {{$errors->has('mu_varient') ? ' is-invalid':''}}" value="{{old('mu_varient', $product->mu_varient)}}" id="mu_varient" name="mu_varient">
        @error('mu_varient')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="ms_varient" class="col-sm-2 col-form-label">{{__('MS-Varient')}}</label>
    <div class="col-sm-4">
        <input type="text" class="form-control {{$errors->has('ms_varient') ? ' is-invalid':''}}" value="{{old('ms_varient', $product->ms_varient)}}" id="ms_varient" name="ms_varient">
        @error('ms_varient')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="on_varient" class="col-sm-2 col-form-label">{{__('ON-Varient')}}</label>
    <div class="col-sm-4">
        <input type="text" class="form-control {{$errors->has('on_varient') ? ' is-invalid':''}}" value="{{old('on_varient', $product->on_varient)}}" id="on_varient" name="on_varient">
        @error('on_varient')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="stock" class="col-sm-2 col-form-label">{{__('Stock')}}</label>
    <div class="col-sm-4">
        <input type="number" class="form-control {{$errors->has('stock') ? ' is-invalid':''}}" value="{{old('stock', $product->stock)}}" id="stock" name="stock">
        @error('stock')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="minimum_stock" class="col-sm-2 col-form-label">{{__('Minimum Stock')}}</label>
    <div class="col-sm-4">
        <input type="number" class="form-control {{$errors->has('minimum_stock') ? ' is-invalid':''}}" value="{{old('minimum_stock', $product->minimum_stock)}}" id="minimum_stock" name="minimum_stock">
        @error('minimum_stock')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>