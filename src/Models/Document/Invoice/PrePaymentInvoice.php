<?php


namespace KomjIT\LarAgent\Models\Document\Invoice;

use KomjIT\LarAgent\Models\Header\PrePaymentInvoiceHeader;
use KomjIT\LarAgent\Models\SzamlaAgentException;

/**
 * Előlegszámla kiállításához használható segédosztály
 *
 * @package LarAgent\Document\Invoice
 */
class PrePaymentInvoice extends Invoice
{
    /**
     * Előlegszámla létrehozása
     *
     * @param int $type számla típusa (papír vagy e-számla), alapértelmezett a papír alapú számla
     *
     * @throws SzamlaAgentException
     */
    function __construct($type = self::INVOICE_TYPE_P_INVOICE)
    {
        parent::__construct(null);
        // Alapértelmezett fejléc adatok hozzáadása
        $this->setHeader(new PrePaymentInvoiceHeader($type));
    }
}
