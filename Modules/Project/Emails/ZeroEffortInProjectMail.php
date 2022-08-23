<?php

namespace Modules\Project\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ZeroEffortInProjectMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $projectManager;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $projectManager)
    {
        $this->projectManager = $projectManager;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->to($this->projectManager['email'])
        ->subject('ColoredCow Portal - Some of your team members have zero effort in projects!')
        ->view('project::mail.zero-effort-team-member-list')
        ->with(['projectManager' => $this->projectManager]);
    }
}
