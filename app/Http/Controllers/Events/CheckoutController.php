<?php

namespace App\Http\Controllers\Events;

use App\Http\Requests\Events\CheckoutRequest;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    public function checkout(Event $event, CheckoutRequest $request) {



    	// veringern der anzahl der Tickets
	    // speichern der Email Addresse + name des Käufers
	    // Speichern des Verkaufs des Tickets in Sale
    	dd($request->all());
    }
}
