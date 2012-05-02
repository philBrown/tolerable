<?php
namespace Tolerable\AusPost\Response;

use Tolerable\AusPost\Postage\Cost;

class PostageResultResponse {
    private $service;
    
    private $deliveryTime;
    
    private $totalCost;
    
    private $costs = array();
    
    public function __construct($service, $totalCost) {
        $this->service = (string) $service;
        $this->totalCost = (double) $totalCost;
    }
    
    public function getService() {
        return $this->service;
    }
    
    public function setDeliveryTime($deliveryTime) {
        $this->deliveryTime = $deliveryTime;
        return $this;
    }
    
    public function getDeliveryTime() {
        return $this->deliveryTime;
    }
    
    public function getTotalCost() {
        return $this->totalCost;
    }
    
    public function getCosts() {
        return $this->costs;
    }
    
    public function addCost(Cost $cost) {
        $this->costs[] = $cost;
    }
}