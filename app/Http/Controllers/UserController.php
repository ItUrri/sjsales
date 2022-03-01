<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entities\User,
    App\Entities\Role;

class UserController extends Controller
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
    public function index(\LaravelDoctrine\ACL\Permissions\PermissionManager $m)
    {
        //dd($m->getAllPermissions());
        $collection = $this->em->getRepository(User::class)
                               ->findBy([], ['email' => 'asc']);

        return view('users.index', [
            'collection' => $collection,
        ]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', [
            'entity' => $user,
        ]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = $this->em->getRepository(Role::class)
                      ->findBy([], ['name' => 'asc']);

        return view('users.form', [
            'route'  => route('users.update', ['user' => $user->getId()]),
            'method' => 'PUT',
            'entity' => $user,
            'roles'  => $roles,
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'roles' => ['required'],
        ]);
        $this->hydrateData($user, $data);
        $this->em->flush();
        return redirect()->route('users.show', ['user' => $user->getId()])
                         ->with('success', 'Successfully updated');
    }

    /**
     * @param User $entity
     * @param array $data
     *
     * @return void 
     */
    protected function hydrateData(User $entity, array $data)
    {
        $entity->setEmail($data['email']);
        $entity->getRoles()->clear();
        if (isset($data['roles']) && is_array($data['roles'])) {
            $er = $this->em->getRepository(Role::class);
            foreach ($data['roles'] as $id) {
                $entity->addRole($er->find($id));
            }
        }
    }
}
