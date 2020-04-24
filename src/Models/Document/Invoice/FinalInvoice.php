<?php


namespace KomjIT\LarAgent\Models\Document\Invoice;

use KomjIT\LarAgent\Models\Header\FinalInvoiceHeader;

/**
 * Végszámla kiállításához használható segédosztály
 *
 * @package LarAgent\Document\Invoice
 */
class FinalInvoice extends Invoice
{
    /**
     * Végszámla létrehozása
     *
     * @param int $type végszámla típusa (papír vagy e-számla), alapértelmezett a papír alapú számla
     *
     * @throws \SzamlaAgent\SzamlaAgentException
     */
    function __construct($type = self::INVOICE_TYPE_P_INVOICE) {
        parent::__construct(null);
        // Alapértelmezett fejléc adatok hozzáadása
        $this->setHeader(new FinalInvoiceHeader($type));
    }
}
