<?php

namespace KomjIT\LarAgent\Models\Header;

use KomjIT\LarAgent\Models\Document\Invoice\Invoice;

/**
 * Helyesbítő számla fejléc
 *
 * @package LarAgent\Header
 */
class CorrectiveInvoiceHeader extends InvoiceHeader
{
    /**
     * @param int $type
     *
     * @throws \SzamlaAgent\SzamlaAgentException
     */
    function __construct($type = Invoice::INVOICE_TYPE_P_INVOICE) {
        parent::__construct($type);
        $this->setCorrective(true);
    }
}
