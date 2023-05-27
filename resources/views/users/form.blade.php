<x-text-field name="title" label="{{ __('Title') }}" :value="$user->title"/>
<x-text-field name="first_name" label="{{ __('First Name') }}" :value="$user->first_name" required/>
<x-text-field name="last_name" label="{{ __('Last Name') }}" :value="$user->last_name" required/>
<x-text-field name="company" label="{{ __('Company') }}" :value="$user->company"/>
<x-email-field name="email" label="{{ __('Email') }}" :value="$user->email" required/>
<x-text-field name="phone" label="{{ __('Phone') }}" :value="$user->phone"/>
<x-password-field name="password" label="{{ __('Password') }}"/>