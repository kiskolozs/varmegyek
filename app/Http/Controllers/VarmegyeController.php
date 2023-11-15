<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Varmegye;

class VarmegyeController extends Controller
{
    public function index()
    {
        return view('varmegye/list', ['entities' =>
            Varmegye::where('is_active', true)->orderBy('name')->get()]);
    }

    public function create() {
        return view('varmegye/create');
    }

    public function edit($id) {
        $entity = Varmegye::find($id);

        return view('varmegye/edit', ['entity' => $entity]);
    }

    public function update(Request $request, $id)
    {
        if ($id) {
            /** @var Varmegye $entity */
            $entity = Varmegye::find($id);
        }
        if (!$entity) {
            abort(404);
        }
        $entity = $this->setEntityData($entity, $request);
        $entity->update();

        return redirect(route('varmegyek') . '#' . $entity->id);
    }

    public function delete(Request $request, $id)
    {
        /** @var Varmegye $entity */
        $entity = Varmegye::find($id);
        $entity->is_active = false;
        $entity->save();

        return redirect(route('varmegyek'));
    }

    public function save(Request $request)
    {
        $entity = new Varmegye();
        $entity = $this->setEntityData($entity, $request);
        $entity->save();

        return redirect(route('varmegyek') . '#' . $entity->id);
    }

    private function setEntityData(Varmegye $entity, Request $request): ?Varmegye
    {
        $entity->name = $request->get('name');

        return $entity;
    }

    private function getQuery()
    {
        return Varmegye::select('*');
    }

    public function search(Request $request) {
        $needle = $request->get('needle');
        $entities = $this->getQuery()
            ->orWhere('name', 'like', "%{$needle}%")
            ->where('is_active', true)
            ->orderBy('name')
            ->get();
        if (!$entities) {
            return view('404');
        }

        return view('varmegye/list', ['entities' => $entities]);
    }
}
