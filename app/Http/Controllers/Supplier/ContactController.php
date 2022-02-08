<?php

namespace App\Http\Controllers\Supplier;

use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller,
    App\Http\Requests\Supplier\ContactRequest;
use App\Entities\Supplier,
    App\Entities\Supplier\Contact;

class ContactController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if (null === ($entity = $this->em->find(Supplier::class, $id))) {
            abort(404);
        }

        return view('suppliers.contacts.form', [
            'route' => route('suppliers.contacts.store', ['supplier' => $id]),
            'entity'  => $entity,
            'contact' => new Contact,
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, ContactRequest $request)
    {
        if (null === ($entity = $this->em->find(Supplier::class, $id))) {
            abort(404);
        }

        $contact = new Contact;
        $contact->setSupplier($entity);
        $this->hydrateData($contact, $request->all());
        $this->em->persist($contact);
        $this->em->flush();
        return redirect()->route('suppliers.show', ['supplier' => $id])
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
    public function edit($id, $cid)
    {
        if (null === ($entity = $this->em->find(Supplier::class, $id))) {
            abort(404);
        }
        if (null === ($contact = $this->em->find(Contact::class, $cid))) {
            abort(404);
        }
        if (!$entity->getContacts()->contains($contact)) {
            abort(404);
        }

        return view('suppliers.contacts.form', [
            'route' => route('suppliers.contacts.update', ['supplier' => $id, 'contact' => $cid]),
            'method' => 'PUT',
            'entity'  => $entity,
            'contact' => $contact,
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContactRequest $request, $id, $cid)
    {
        if (null === ($entity = $this->em->find(Supplier::class, $id))) {
            abort(404);
        }
        if (null === ($contact = $this->em->find(Contact::class, $cid))) {
            abort(404);
        }
        if (!$entity->getContacts()->contains($contact)) {
            abort(404);
        }
        $this->hydrateData($contact, $request->all());
        $this->em->flush();
        return redirect()->route('suppliers.show', ['supplier' => $id])
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
        //
    }

    /**
     * @param Contact $entity
     * @param array $data
     *
     * @return void 
     */
    protected function hydrateData(Contact $entity, array $data = [])
    {
        if (isset($data['name'])) $entity->setName($data['name']);
        if (isset($data['email'])) $entity->setEmail($data['email']);
        if (isset($data['phone'])) $entity->setPhone($data['phone']);
        if (isset($data['position'])) $entity->setPosition($data['position']);
    }
}
