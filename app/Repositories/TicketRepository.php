<?php 

namespace App\Repositories; 

use Illuminate\Database\Eloquent\Model;

/**
 * Class TicketRepository 
 * 
 * @package App\Repositories
 */
class TicketRepository extends Model 
{
    /**
     * Methode voor het sluiten van een helpdesk ticket. 
     * 
     * @return void
     */
    public function close(): void 
    {
        if (auth()->user()->hasAnyRole(['leiding', 'admin'])) {
           $this->logActivity("Heeft een helpdesk ticket gesloten (#{$this->id})", 'Helpdesk'); 
        }

        $this->closer()->associate(auth()->user())->save();
        flash("Het ticket met de id #{$this->id} is nu gesloten in de applicatie.")->success();
    }

    /**
     * Methode voor het heropenen van een helpdesk ticket. 
     * 
     * @return void
     */
    public function reopen(): void 
    {
        if (auth()->user()->hasAnyRole(['leiding', 'admin'])) {
            $this->logActivity("Heeft een helpdesk ticket heropend (#{$this->id})", 'Helpdesk'); 
        }

        $this->closer()->dissociate()->save();
        flash("Het ticket met de id #{$this->id} is heropend.")->info();
    }
}