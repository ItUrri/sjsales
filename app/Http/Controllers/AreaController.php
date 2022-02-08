<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Doctrine\ORM\EntityManagerInterface;

use App\Entities\Area,
    App\Entities\Department,
    App\Http\Requests\AreaRequest;

class AreaController extends Controller
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
        $areas = $this->em->getRepository(Area::class)
                          ->findBy([], ['created' => 'desc']);

        $collection = $this->em->getRepository(Department::class)
                               ->findBy([], ['name' => 'asc']);
        return view('areas.index', [
            'areas' => $areas,
            'departments' => $collection,
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $collection = $this->em->getRepository(Department::class)
                               ->findBy([], ['name' => 'asc']);

        return view('areas.form', [
            'route' => route('areas.store'),
            'method' => 'POST',
            'entity' => new Area,
            'departments' => $collection,
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AreaRequest $request)
    {
        //$data = $request->validated();
        $entity = new Area;
        $this->hydrateData($entity, $request->all());
        $this->em->persist($entity);
        $this->em->flush();
        return redirect()->route('areas.show', ['area' => $entity->getId()])
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
        if (null === ($entity = $this->em->find(Area::class, $id))) {
            abort(404);
        }

        return view('areas.show', [
            'entity' => $entity,
        ]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (null === ($entity = $this->em->find(Area::class, $id))) {
            abort(404);
        }

        $collection = $this->em->getRepository(Department::class)
                               ->findBy([], ['name' => 'asc']);

        return view('areas.form', [
            'route' => route('areas.update', ['area' => $entity->getId()]),
            'method' => 'PUT',
            'entity' => $entity,
            'departments' => $collection,
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AreaRequest $request, $id)
    {
        if (null === ($entity = $this->em->find(Area::class, $id))) {
            abort(404);
        }

        $this->hydrateData($entity, $request->all());

        $this->em->flush();
        return redirect()->route('areas.show', ['area' => $entity->getId()])
                         ->with('success', 'Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (null === ($entity = $this->em->find(Area::class, $id))) {
            abort(404);
        }

        $this->em->remove($entity);
        $this->em->flush();

        return redirect()->back()->with('success', 'Successfully removed');
    }

    /**
     * @param Area $entity
     * @param array $data
     *
     * @return void 
     */
    protected function hydrateData(Area $entity, array $data)
    {
        $entity->setName($data['name'])
            ->setType($data['type'])
            ->setAcronym($data['acronym'])
            ->setCredit($data['credit'])
            ;

        $entity->setLCode();
        if (isset($data['lcode'])) {
            $entity->setLCode($data['lcode']);
        }

        $entity->getDepartments()->clear();
        if (isset($data['departments']) && is_array($data['departments'])) {
            $er = $this->em->getRepository(Department::class);
            foreach ($data['departments'] as $id) {
                $entity->addDepartment($er->find($id));
            }
        }
    }
}
