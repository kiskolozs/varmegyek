<?php

namespace App\Http\Controllers\Api;

use App\Models\Fuel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FuelController extends Controller
{
    public function index()
    {
        $entities= Fuel::where('is_active',true)->orderBy('name')->get();
        return response()->json([
            'data' => $entities,
            'message'=>'Ok',]
            ,200);
    }

    public function create() {
        return view('fuel/create');
    }

    public function edit($id) {
        $entity = Fuel::find($id);

        return view('fuel/edit', ['entity' => $entity]);
    }

    public function update(Request $request, $id)
    {
        if ($id) {
            /** @var Fuel $entity */
            $entity = Fuel::find($id);
        }
        if (!$entity) {
            abort(404);
        }
        $entity = $this->setEntityData($entity, $request);
        $entity->update();

        return redirect(route('fuels') . '#' . $entity->id);
    }

    public function delete(Request $request, $id)
    {
        /** @var Fuel $entity */
        $entity = Fuel::find($id);
        $entity->is_active = false;
        $entity->save();

        return redirect(route('fuels'));
    }

    public function save(Request $request)
    {
        $entity = new Fuel();
        $entity = $this->setEntityData($entity, $request);
        $entity->save();

        return redirect(route('fuels') . '#' . $entity->id);
    }

    private function setEntityData(Fuel $entity, Request $request): ?Fuel
    {
        $entity->name = $request->get('name');

        return $entity;
    }

    private function getQuery()
    {
        return Fuel::select('*');
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

        return view('fuel/list', ['entities' => $entities]);
    }
}
