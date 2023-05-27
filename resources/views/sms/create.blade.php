@extends('laravel-admin::layouts.app')
@section('content')
<section class="section">
    <div class="row sameheight-container">
        <div class="col col-12 col-sm-12 col-md-12 col-xl-12">
            <div class="card sameheight-item" data-exclude="xs">
                <div class="card-block">
                    <div class="title-block">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="title">Write SMS</h4>
                            <p class="mb-0 text-success font-weight-bold">Limit: <span id="limitCounterDisplay">160</span></p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('sms.send') }}">
                        @csrf
                        <x-textarea-field name="message" rows="4" onkeyup="countCharacter(this)" placeholder="Message" label="{{ __('Message') }}" required/>
                        <x-textarea-field name="recipients" rows="4" placeholder="Recipient(s)" label="{{ __('Recipient(s)') }}" required/>
                        <div class="form-group">
                            <input type="submit" id="sendButton" class="btn btn-sm btn-success" value="Send">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('javascript')
    <script>
        function countCharacter(element){
            console.log(element.value.length);
            character = element.value;
            characterLength = element.value.length;
            characterRemaining = 160 - characterLength;
            counterDisplayText = characterRemaining + '/' + 160;
            counterDisplay = document.querySelector('#limitCounterDisplay');
            counterDisplay.innerHTML = counterDisplayText;

            if(characterLength > 160 ){
                document.querySelector('#message').classList.add('is-invalid');
                counterDisplay.parentElement.classList.remove('text-success');
                counterDisplay.parentElement.classList.add('text-danger');
                document.querySelector('#sendButton').classList.add('disabled');
                document.querySelector('#sendButton').setAttribute('disabled', 'disabled');
            }else{
                document.querySelector('#message').classList.remove('is-invalid');
                counterDisplay.parentElement.classList.remove('text-danger');
                counterDisplay.parentElement.classList.add('text-success');
                document.querySelector('#sendButton').classList.remove('disabled');
                document.querySelector('#sendButton').removeAttribute('disabled');
            }
        }
    </script>
@endsection