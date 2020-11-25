<?php

 
echo 'support';
dump($tariffs);
foreach($tariffs as $tariff){
    echo $tariff->name.'</br>';
    foreach ($tariff->main_services as $service) {
        echo 'base------'.$service->name.'</br>';
    }
    foreach ($tariff->dop_services as $service) {
        echo 'dop------'.$service->name.'</br>';
    }
    foreach ($tariff->cost_services as $service) {
        echo 'cost------'.$service->name.'</br>';
    }
}