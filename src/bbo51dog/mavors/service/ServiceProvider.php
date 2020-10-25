<?php

namespace bbo51dog\mavors\service;

use function array_key_exists;

class ServiceProvider{

    /** @var Service[] */
    private $services = [];

    public function get(string $key): Service{
        if(!$this->exists($key)){
            throw new ServiceException("Service {$key} not found");
        }
        return $this->services[$key];
    }

    public function register(string $key, Service $service, bool $force = false): void{
        if($this->exists($key) && !$force){
            throw new ServiceException("Service {$key} already registered");
        }
        $this->services[$key] = $service;
    }

    /**
     * @param Service[] $services [string => Service]
     */
    public function registerAll(array $services): void{
        foreach($services as $key => $service){
            $this->register($key, $service);
        }
    }

    private function exists(string $key): bool{
        return array_key_exists($key, $this->services);
    }
}