@if($comment->user->avatar)
    <img src="{{ route('user.avatar',['filename'=>$comment->user->avatar]) }}" class="avatar">    
@endif