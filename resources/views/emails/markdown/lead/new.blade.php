<x-mail::message>
# Messagge

Nome: {{$lead->name}}  <br>
Email: {{$lead->email}} <br>
Message: <br> 
 
<x-mail::panel>
{{$lead->message}}
</x-mail::panel>
        

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
