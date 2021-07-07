<?php

namespace App\Mail;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommentAdded extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $comment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
                    ->markdown('emails.comments.added', [
                        'url' => route('posts.show', $this->comment->post_id)
                    ])
                    ->with('comment', $this->comment);
    }
}
