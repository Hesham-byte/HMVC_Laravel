

@component('mail::message')
    <p>{{__('main.dear')}} {{$user->first_name}},</p>
    <br>
    <p>{{__('users.welcome_user')}}</p>
    <br>
    <p>URL : {{route('admin.login')}}</p>
    <br>
    <p>Email : {{$user->email}}</p>
    <br>
    <p>{{__('auth.please_use_the_link_below_to_reset_the_password')}}</p>
    <br>
    @component('mail::button', ['url' => route('admin.reset-password',['token'=>$user->reset_password_token]), 'color' => 'info'])
        <a href="{{route('admin.reset-password',['token'=>$user->reset_password_token])}}" class="button button-primary">{{__('auth.reset_password')}}</a>
    @endcomponent
@endcomponent


