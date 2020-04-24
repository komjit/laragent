<?php

namespace KomjIT\LarAgent\Models\Header;

/**
 * Szállítólevél fejléc
 *
 * @package LarAgent\Header
 */
class DeliveryNoteHeader extends InvoiceHeader {

    /**
     * @throws \SzamlaAgent\SzamlaAgentException
     */
    function __construct() {
        parent::__construct();
        $this->setDeliveryNote(true);
        $this->setPaid(false);
    }
}
