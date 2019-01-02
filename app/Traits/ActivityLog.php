<?php 

/**
 * Trait ActivityLog 
 * 
 * @package App\Traits 
 */
trait ActivityLog 
{
    /**
     * Log an activity message when an database entity has been changed. 
     * 
     * @param  string $message Het bericht dat moet worden opgeslagen in de logs.
     * @return void
     */
    public function logAction(string $message): void 
    {
        $user = auth()->user();
        activity()->performedOn($this)->causedBy($user)->log($message);
    }
}