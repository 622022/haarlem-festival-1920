<?php
    $event;
    if($event == 'jazz') {
        require('eventjazz');
    } else if($event == 'dance') {
        require('eventdance');
    } else if($event == 'food') {
        require('eventfood');
    }
    
    class eventjazz {
        $ticketname;
        $ticketprice;

        if() {
            $ticketname = 'event';
            $ticketprice = 44;
        } else if() {
            $ticketname = 'event2'
            $ticketprice = 32;
        }
    }

    class eventdance {
        $ticketname;
        $ticketprice;

        if() {
            $ticketname = 'event';
            $ticketprice = 44;
        } else if() {
            $ticketname = 'event2'
            $ticketprice = 32;
        }
    }

    class eventfood {
        $ticketname;
        $ticketprice;

        if() {
            $ticketname = 'event';
            $ticketprice = 44;
        } else if() {
            $ticketname = 'event2'
            $ticketprice = 32;
        }
    }
?>