<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Doctrine\ORM\EntityManagerInterface;

use App\Entities\Department,
    App\Http\Requests\DepartmentPostRequest;

class DepartmentController extends Controller
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
        $departments = $this->em->getRepository(Department::class)->findAll();

        return view('departments.index', [
            'collection' => $departments,
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departments.form', [
            'entity' => new Department,
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  DepartmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentPostRequest $request)
    {
        $data = $request->validated();
        $dptm = new Department;
        $dptm->setName($data['name']);

        $this->em->persist($dptm);
        $this->em->flush();
        return redirect()->route('departments.index')
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
        if (null === ($entity = $this->em->find(Department::class, $id))) {
            abort(404);
        }

        return view('departments.show', [
            'department' => $entity,
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
        if (null === ($entity = $this->em->find(Department::class, $id))) {
            abort(404);
        }

        return view('departments.form', [
            'entity' => $entity,
        ]); 
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
        if (null === ($entity = $this->em->find(Department::class, $id))) {
            die('not found');
        }

        $this->em->remove($entity);
        $this->em->flush();

        return redirect()->back()->with('success', 'Successfully removed');
    }
}
