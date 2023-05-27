<div class="row">
    @for ($i = 1; $i <= $count; $i++)
        <div class="col-md-12 mb-3">
            <textarea class="form-control" name="options[]" id="" cols="30" rows="5"></textarea>
        </div>
        
    @endfor
    <div class="col-md-2">
        <x-select-field wire:model="priceRow" name="priceRow" :data="range(1,$count)" label="Price Row"/>
    </div>
    <div class="col-md-12">
        <input type="submit" id="sendButton" class="btn btn-sm btn-info" value="Generate">
        <button type="button" class="btn btn-sm btn-success" wire:click="add">+ Add</button>
        <button type="button" class="btn btn-sm btn-danger" wire:click="remove">- Remove</button>
    </div>
</div>
