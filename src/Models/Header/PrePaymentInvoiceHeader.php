<?php

namespace KomjIT\LarAgent\Models\Header;

use KomjIT\LarAgent\Models\Document\Invoice\Invoice;

/**
 * Előlegszámla fejléc
 *
 * @package LarAgent\Header
 */
class PrePaymentInvoiceHeader extends InvoiceHeader {

    /**
     * @param int $type
     *
     * @throws \SzamlaAgent\SzamlaAgentException
     */
    function __construct($type = Invoice::INVOICE_TYPE_P_INVOICE) {
        parent::__construct($type);
        $this->setPrePayment(true);
        $this->setPaid(false);
    }
}
