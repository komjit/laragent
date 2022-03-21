<?php

namespace KomjIT\LarAgent\Models\Header;

use KomjIT\LarAgent\Models\SzamlaAgentException;

/**
 * Szállítólevél fejléc
 *
 * @package LarAgent\Header
 */
class DeliveryNoteHeader extends InvoiceHeader
{

    /**
     * @throws SzamlaAgentException
     */
    function __construct()
    {
        parent::__construct();
        $this->setDeliveryNote(true);
        $this->setPaid(false);
    }
}
