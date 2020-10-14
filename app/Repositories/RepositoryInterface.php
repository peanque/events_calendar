<?php

namespace App\Repositories;

// Repository Contract or Blueprint

interface RepositoryInterface
{
    // no edit and delete    
    public function getAll();
    public function create(array $data);
    public function show($id);

}