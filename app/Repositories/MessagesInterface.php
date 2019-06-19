<?php

namespace App\Repositories;

interface MessagesInterface
{
    public function getPaginated() ;
    public function store($request);
    public function show($id);
    public function update($id);
    public function destroy($id);
}
