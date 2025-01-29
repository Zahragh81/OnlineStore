<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait Pagination
{
    protected string $search;
    protected int $first;

   public function __construct(Request $request)
   {
       $this->search = '%' . $request->get('search', '') . '%';

       $this->first = $request->get('first', 10);
   }
}
