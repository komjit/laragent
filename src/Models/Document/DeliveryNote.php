<?php

namespace KomjIT\LarAgent\Models\Document;

use KomjIT\LarAgent\Models\Document\Invoice\Invoice;
use KomjIT\LarAgent\Models\Header\DeliveryNoteHeader;

/**
 * Szállítólevél segédosztály
 *
 * @package LarAgent\Document
 */
class DeliveryNote extends Invoice
{
    /**
     * Szállítólevél kiállítása
     *
     * @throws \Exception
     */
    function __construct()
    {
        parent::__construct(null);
        // Alapértelmezett fejléc adatok hozzáadása
        $this->setHeader(new DeliveryNoteHeader());
    }
}
