<div>
    <form wire:submit.prevent="import" enctype="multipart/form-data">
        <div class="form-group">
            <label for="file">Select csv file</label>
            <input type="file" class="form-control-file {{$errors->has('file') ? ' is-invalid':''}}" wire:model="file" name="file" id="file">
            @error('file')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">Import</button>
            <div wire:loading wire:target="import">
                <small>Importing products...</small>
            </div>
        </div>
    </form>
</div>
