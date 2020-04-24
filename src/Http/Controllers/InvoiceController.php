<?php

namespace KomjIT\LarAgent\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use KomjIT\LarAgent\Models\Buyer;
use KomjIT\LarAgent\Models\Document\Proforma;
use KomjIT\LarAgent\Models\Item\ProformaItem;
use KomjIT\LarAgent\Models\SzamlaAgentAPI;

class InvoiceController extends Controller
{
    public function createProforma(Request $request){
        try {
            /**
             * Számla Agent létrehozása alapértelmezett adatokkal
             *
             * A díjbekérő sikeres kiállítása esetén a válasz (response) tartalmazni fogja
             * a létrejött bizonylatot PDF formátumban (1 példányban)
             */
            $agent = SzamlaAgentAPI::create('gakemvasyj5qn6ns4z7rhwhbr36zgydzz4pxj8wih5');

            /**
             * Új díjbekérő létrehozása
             *
             * Átutalással fizetendő magyar nyelvű (Ft) díjbekérő kiállítása mai keltezési és
             * teljesítési dátummal, +8 nap fizetési határidővel
             */
            $proforma = new Proforma();
            // Rendelésszám hozzáadása
            $proforma->getHeader()->setOrderNumber('TESZT-001');

            // Vevő adatainak hozzáadása (kötelezően kitöltendő adatokkal)
            $proforma->setBuyer(new Buyer('Teszt Bt.', '7634', 'Pécs', 'Teszt utca 123.'));

            // A bizonylat (díjbekérő) tétel összeállítása alapértelmezett adatokkal (1 db tétel 27%-os áfatartalommal)
            $item = new ProformaItem('Eladó tétel 1', 10000.0);
            // Tétel nettó értékének beállítása
            $item->setNetPrice(10000.0);
            // Tétel ÁFA értékének beállítása
            $item->setVatAmount(2700.0);
            // Tétel bruttó értékének beállítása
            $item->setGrossAmount(12700.0);
            // Tétel hozzáadása a díjbekérőhöz
            $proforma->addItem($item);

            // Díjbekérő elkészítése
            $result = $agent->generateProforma($proforma);
            // Agent válasz sikerességének ellenőrzése
            if ($result->isSuccess()) {
                echo 'A díjbekérő sikeresen elkészült. Díjbekérő száma: ' . $result->getDocumentNumber();
                // Válasz adatai a további feldolgozáshoz
                var_dump($result->getData());
            }
        } catch (\Exception $e) {
            echo "Nem sikerült a díjbekérő létrehozása.";
            var_dump($e);
        }
    }
}
