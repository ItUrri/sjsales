<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Doctrine\ORM\EntityManagerInterface;

use App\Entities\Movement,
    App\Entities\Order,
    App\Http\Requests\MovementRequest;

class MovementController extends Controller
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
    public function index()
    {
        $collection = $this->em->getRepository(Movement::class)->lastest();

        return view('movements.index', [
            'collection' => $collection,
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('movements.create', [
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MovementRequest $request)
    {
        $data = $request->validated();
        $pattern = "@(^[A-Z]+)-(E|F|L)-?([\d]*)/([\d]{2})-([\d|-]+)@";
        $description = $data['detail'];
        $matches = [];
        if (!preg_match(Order::SEQUENCE_PATTERN, $description, $matches)) {
            throw new \RuntimeException(sprintf("Description not matches with $pattern pattern"));
        }

        $order = $this->em->getRepository(Order::class)->findOneBy(['sequence' => $matches[0]]);

        if (!$order) {
            return redirect()->back()
                             ->withInput()
                             ->withErrors(["order" => "Order {$matches[0]} not found"]);
        }

        $movement = new Movement;
        $movement->setCredit($data['credit'])
                 ->setDetail($data['detail'])
                 ;

        $order->addMovement($movement)
              ->setStatus(Order::STATUS_PAID)
              ->setCredit($data['credit'])
              ->setInvoice($data['invoice'])
              ;

        $this->em->flush();

        return redirect()->back()
                         ->with('success', 'Successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
