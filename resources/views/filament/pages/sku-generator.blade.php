<x-filament::page>
    @if($skus)
    <table class="filament-tables-table w-full text-start divide-y table-auto">
        <th>
            <tr>
                <td>#</td>
                <td>Sku</td>
            </tr>
        </th>
        @foreach ($skus as $key => $sku)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td> {{ $sku }} </td>
            </tr>
        @endforeach
    </table>

    @else
    <p>Add one item in each line and seperate the product name using hash(#) e.g DX#Betten Jumbo King deluxe</p>
    <form wire:submit.prevent="submit">
        {{ $this->form }}
        <div class="pt-3">
            <x-filament-support::button type="submit">Generate</x-filament-support::button>
        </div>
    </form>
    @endif
</x-filament::page>