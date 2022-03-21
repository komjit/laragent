<?php

namespace KomjIT\LarAgent\Models\Header;

use KomjIT\LarAgent\Models\Document\Invoice\Invoice;
use KomjIT\LarAgent\Models\SzamlaAgentException;

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
     * @throws SzamlaAgentException
     */
    function __construct($type = Invoice::INVOICE_TYPE_P_INVOICE)
    {
        parent::__construct($type);
        $this->setCorrective(true);
    }
}
