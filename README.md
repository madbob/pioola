# Pioola

**Pioola** è una applicazione per la gestione centralizzata dei chioschi all'interno di una manifestazione o di una sagra.

## Introduzione

**Pioola** è pensato per essere utilizzato in rete locale, installato su un server centrale presso cui i clients possono accedere per la consultazione e per effettuare gli ordini.
In questo modo è fruibile da ogni dispositivo nella rete, ivi compresi i terminali mobili.

## Features

* aree multiple, ciascuna con un proprio menù (più l'area comune, che aggrega i prodotti ordinabili da tutte le altre)
* prodotti divisi in categorie
* ordini completamente editabili singolarmente (quantità, prezzi, note)
* stampa diretta degli ordini
* gestione delle quantità a magazzino dei prodotti
* reportistica degli ordini effettuati

## Requisiti

* PHP >= 5.5.9
* composer ( https://getcomposer.org/ )
* un webserver ed un database
* sui client adibiti alla creazione e alla stampa degli ordini è fortemente consigliato l'utilizzo di Firefox con l'estensione JS Print Setup - https://addons.mozilla.org/it/firefox/addon/js-print-setup/

## Installazione

```
git clone https://github.com/OfficineDigitali/pioola
cd pioola
composer install
php artisan key:generate
cp .env.example .env
(editare .env con i propri parametri di accesso al database)
php artisan migrate
php artisan db:seed
```

## Storia

**Pioola** è stato inizialmente sviluppato per la Festa dell'Unità di Torino.

Il nome _pioola_ deriva dal termine _piola_, la tipica osteria piemontese.

## Licenza

**Pioola** è distribuito in licenza AGPL versione 3 o successive.

Copyright (C) 2015 Officine Digitali <info@officinedigitali.org>.
