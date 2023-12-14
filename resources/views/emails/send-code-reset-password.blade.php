{{-- @component('mail::message') --}}
<h1>{{__("auth.msgResetBlade_1")}}</h1>
<p>{{__("auth.msgResetBlade_2")}}</p>
<br>
{{-- @component('mail::panel') --}}
<p>{{__("auth.msgResetBlade_4")}} : {{ $code }} </p>
{{-- @endcomponent --}}

<p>{{__("auth.msgResetBlade_3")}}</p>
{{-- @endcomponent --}}
