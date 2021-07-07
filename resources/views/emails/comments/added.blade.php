@component('mail::message')
# Comment added

Comment has been added by {{$comment->user->name}} on post {{$comment->post->title}}!
Comment body {{$comment->body}}

@component('mail::button', ['url' => $url])
View Comment
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
