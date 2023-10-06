<?php

namespace App\Services\Movie;

class Customer {
	private String $name;
	private String $id;
	
    public function __construct($name, $id)
    {
        $this->name = $name;
        $this->id = $id;
    }
}