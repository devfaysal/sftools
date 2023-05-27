<div class="row">
    <div class="col-md-6">
        <x-select-field name="schedule" label="{{ __('When to add the record?') }}" :value="$posting->schedule" :data="$schedules" tooltip="Day of the month when this should be posted every month" required/>
    </div>
    <div class="col-md-6">
        <x-number-field name="amount" label="{{ __('Amount') }}" :value="$posting->amount" required/>
    </div>
    <div class="col-md-12">
        <x-text-field name="postingtext" label="{{ __('Booking Text') }}" :value="$posting->postingtext" required/>
    </div>
    <div class="col-md-12">
        <small>Posting accounts not found? <a class="text-default font-weight-bold" href="{{ route('bhb.sync') }}">Sync now</a></small>
    </div>
    <div class="col-md-4">
        <x-select-field name="postingaccount_debit" label="{{ __('Debit posting account') }}" :value="$posting->postingaccount_debit" :data="$accounts" required/>
            
        <x-text-field name="postingaccount_debit_other" class="d-none" placeholder="{{ __('Write posting account') }}" />
    </div>
    <div class="col-md-4">
        <x-select-field name="postingaccount_credit" label="{{ __('Credit posting account') }}" :value="$posting->postingaccount_credit" :data="$accounts" required/>
        <x-text-field name="postingaccount_credit_other" class="d-none" placeholder="{{ __('Write posting account') }}" />
    </div>
    <div class="col-md-4">
        <x-text-field name="vat" label="{{ __('The vat rate of the posting') }}" :value="$posting->vat" required/>
    </div>
    <div class="col-md-12">
        <x-checkbox-field name="status" checked label="Active" value="active"/>
    </div>
</div>
@section('javascript')
<script>
    searchable_select('#schedule');
    searchable_select('#postingaccount_debit');
    searchable_select('#postingaccount_credit');
    if($('#postingaccount_debit').val()=='Other'){
        $('#postingaccount_debit_other').addClass('d-block');
    }
    if($('#postingaccount_credit').val()=='Other'){
        $('#postingaccount_credit_other').addClass('d-block');
    }
    $('#postingaccount_debit').on('change', function(){
        if(this.value === 'Other'){
            $('#postingaccount_debit_other').addClass('d-block');
        }else{
            $('#postingaccount_debit_other').removeClass('d-block');
        }
    });
    $('#postingaccount_credit').on('change', function(){
        if(this.value === 'Other'){
            $('#postingaccount_credit_other').addClass('d-block');
        }else{
            $('#postingaccount_credit_other').removeClass('d-block');
        }
    });
</script>
@endsection