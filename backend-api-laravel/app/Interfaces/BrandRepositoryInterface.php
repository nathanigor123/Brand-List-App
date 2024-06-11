<?php

namespace App\Interfaces;

interface BrandRepositoryInterface
{
    public function index();
    public function show($id);
    public function getTopListByCountry($userCountryCode);
    public function store(array $data);
    public function update(array $data,$id);
    public function delete($id);
}
