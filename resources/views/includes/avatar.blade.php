@if(Auth::user()->avatar)
<div class="container-avatar">
    <img src="{{ route('user.avatar',['filename'=>Auth::user()->avatar]) }}" class="avatar"> 
</div>   
@endif