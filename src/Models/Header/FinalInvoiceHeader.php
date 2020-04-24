<?php

namespace KomjIT\LarAgent\Models\Header;

use KomjIT\LarAgent\Models\Document\Invoice\Invoice;

/**
 * Végszámla fejléc
 *
 * @package LarAgent\Header
 */
class FinalInvoiceHeader extends InvoiceHeader {

    /**
     * @param int $type
     *
     * @throws \SzamlaAgent\SzamlaAgentException
     */
    function __construct($type = Invoice::INVOICE_TYPE_P_INVOICE) {
        parent::__construct($type);
        $this->setFinal(true);
    }
}
