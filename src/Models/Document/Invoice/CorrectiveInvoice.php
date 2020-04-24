<?php


namespace KomjIT\LarAgent\Models\Document\Invoice;

use KomjIT\LarAgent\Models\Header\CorrectiveInvoiceHeader;

/**
 * Helyesbítő számla kiállításához használható segédosztály
 *
 * @package LarAgent\Document\Invoice
 */
class CorrectiveInvoice extends Invoice
{
    /**
     * Helyesbítő számla létrehozása
     *
     * @param int $type számla típusa (papír vagy e-számla), alapértelmezett a papír alapú számla
     *
     * @throws \SzamlaAgent\SzamlaAgentException
     */
    function __construct($type = self::INVOICE_TYPE_P_INVOICE) {
        parent::__construct(null);
        // Alapértelmezett fejléc adatok hozzáadása
        $this->setHeader(new CorrectiveInvoiceHeader($type));
    }
}
