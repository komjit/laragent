<?php

namespace KomjIT\LarAgent\Models\Header;

use KomjIT\LarAgent\Models\Document\Invoice\Invoice;
use KomjIT\LarAgent\Models\SzamlaAgentException;

/**
 * Végszámla fejléc
 *
 * @package LarAgent\Header
 */
class FinalInvoiceHeader extends InvoiceHeader
{

    /**
     * @param int $type
     *
     * @throws SzamlaAgentException
     */
    function __construct($type = Invoice::INVOICE_TYPE_P_INVOICE)
    {
        parent::__construct($type);
        $this->setFinal(true);
    }
}
