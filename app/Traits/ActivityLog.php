<?php 

namespace App\Traits;

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
     * @param  string $logName De log categorie waar het bericht in moet worden opgenomen.
     * @param  string $message Het bericht dat moet worden opgeslagen in de logs.
     * @return void
     */
    public function logActivity(string $message, string $logName = 'default'): void 
    {
        $user = auth()->user();
        activity($logName)->performedOn($this)->causedBy($user)->log($message);
    }
}