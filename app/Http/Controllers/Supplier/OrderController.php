<?php

namespace App\Http\Controllers\Supplier;

use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller,
    App\Entities\Order,
    App\Entities\Supplier;

class OrderController extends Controller
{
    /**
     * @EntityManagerInterface
     */ 
    protected $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Supplier $supplier)
    {
        $collection = $this->em->getRepository(Order::class)
                               ->fromSupplier($supplier);

        return view('suppliers.orders', [
            'entity' => $supplier,
            'collection' => $collection,
        ]);
    }
}
