<?php

namespace App\Http\Controllers\Areas;

use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller,
    App\Http\Requests\OrderPostRequest;
use App\Entities\Area,
    App\Entities\Supplier,
    App\Entities\Order,
    App\Entities\Order\Product;

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
    public function index($id)
    {
        if (null === ($entity = $this->em->find(Area::class, $id))) {
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id, Request $request)
    {
        if (null === ($entity = $this->em->find(Area::class, $id))) {
            abort(404);
        }

        $collection = $this->em->getRepository(Supplier::class)
                               ->findBy([], ['name' => 'asc']);

        $map = array_combine(
            array_map(function($e) { return $e->getId(); }, $collection),
            array_map(function($e) { return $e->getName(); }, $collection),
        );

        $order = new Order;
        $this->hydrateData($order, $request->old());
        return view('areas.orders.create', [
            'entity'    => $entity,
            'order'     => $order,
            'suppliers' => $map,
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, OrderPostRequest $request)
    {
        //dd($request->all());
        if (null === ($entity = $this->em->find(Area::class, $id))) {
            abort(404);
        }

        $last = $this->em->getRepository(Order::class)->findOneBy([
            'area' => $entity,
        ], ['created' => 'DESC']);

        if ($last) {
            $matches = [];
            if (!preg_match(Order::SEQUENCE_PATTERN, $last->getSequence(), $matches)) {
                throw new \RuntimeException(sprintf("Description not matches with $pattern pattern"));
            }
            $sequence = (int) trim($matches[5], "-") + 1;
        }

        $order = new Order;
        $this->hydrateData($order, $request->all());
        $order->setSequence(implode("-", [
            "{$entity->getSerial()}/{$entity->getCreated()->format('y')}",
            isset($sequence) ? $sequence : 1
        ])); //FIXME

        $entity->addOrder($order)
            ->increaseCompromisedCredit($order->getEstimatedCredit())
            ;
        $this->em->flush();
        return redirect()->route('orders.show', $order->getId())
                         ->with('success', 'Successfully created');
    }

    /**
     * @param Order $entity
     * @param array $data
     *
     * @return void 
     */
    protected function hydrateData(Order $entity, array $data = [])
    {
        if (isset($data['credit'])) $entity->setEstimatedCredit($data['credit']);
        if (isset($data['detail'])) $entity->setDetail($data['detail']);
        if (isset($data['date']))   $entity->setDate(new \Datetime($data['date']));

        if (!isset($data['products'])) $data['products'] = [[]];
        foreach ($data['products'] as $raw) {
            $product = new Product;
            if (isset($raw['supplier'])) {
                if (null === ($e = $this->em->find(Supplier::class, $raw['supplier']))) {
                    throw new \RuntimeException("Supplier {$raw['supplier']} not found"); 
                }
                $product->setSupplier($e);
            }
            if (isset($raw['detail'])) $product->setDetail($raw['detail']);
            if (isset($raw['credit'])) $product->setCredit($raw['credit']);
            $entity->addProduct($product);
        }
    }
}
