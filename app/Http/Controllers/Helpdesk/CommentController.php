<?php

namespace App\Http\Controllers\Helpdesk;

use App\Models\Helpdesk;
use Illuminate\Http\{Request, RedirectResponse};
use App\Http\Controllers\Controller;
use BeyondCode\Comments\Comment;

/**
 * Class CommentController
 *
 * @package App\Http\Controllers\Helpdesk
 */
class CommentController extends Controller
{
    /**
     * CommentController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['auth', 'forbid-banned-user']); // Initialiseer de globale constructor.
    }

    /**
     * Methode voor het opslaan van een comment van een helpdesk ticket.
     *
     * @throws \Illuminate\Validation\ValidationException
     *
     * @param  Request  $request Instantie class voor de form input.
     * @param  Helpdesk $ticket De databank entiteit van het helpdesk ticket.
     * @return RedirectResponse
     */
    public function store(Request $request, Helpdesk $ticket): RedirectResponse
    {
        $this->validate($request, ['comment' => ['required'], ['string']]);

        $ticket->comment($request->comment);
        return redirect()->route('helpdesk.ticket.show', $ticket);
    }

    /**
     * Methode voor het verwijderen van een comment in de applicatie. 
     * 
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @param  Comment $comment De database instantie van de comment
     * @return RedirectResponse 
     */
    public function destroy(Comment $comment): RedirectResponse 
    {
        $this->authorize('destroy', $comment);

        $comment->delete(); // Delete operaration for the comment
        return redirect()->route('helpdesk.ticket.show', $comment->commentable);
    }
}
