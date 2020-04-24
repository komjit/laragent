<?php


namespace KomjIT\LarAgent\Models\Document\Invoice;

use KomjIT\LarAgent\Models\Header\ReverseInvoiceHeader;

/**
 * Sztornó számla
 *
 * @package LarAgent\Document\Invoice
 */
class ReverseInvoice extends Invoice
{
    /**
     * Sztornó számla létrehozása
     *
     * @param int $type számla típusa (papír vagy e-számla), alapértelmezett a papír alapú számla
     *
     * @throws \SzamlaAgent\SzamlaAgentException
     */
    public function __construct($type = self::INVOICE_TYPE_P_INVOICE) {
        parent::__construct(null);
        // Alapértelmezett fejléc adatok hozzáadása a számlához
        if (!empty($type)) {
            $this->setHeader(new ReverseInvoiceHeader($type));
        }
    }
}
