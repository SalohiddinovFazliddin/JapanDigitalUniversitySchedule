<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{

    public function index(Request $request)
    {
        $query = Group::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->get('search') . '%');
        }

        if ($request->has('sort')) {
            $query->where('sort', $request->get('group'));
        }

        $perPage = $request->get('per_page', 10);
        $group = $query->paginate($perPage);

        return response()->json($group);
    }


    public function store(StoreGroupRequest $request)
    {
        $validator = $request->validated();
        Group::query()->create($validator);
        return response()->json([
            'message' => 'Group created successfully'
        ], 201);
    }

    public function update(UpdateGroupRequest $request, $group)
    {
        $validator = $request->validated();
        $group->update($validator);
        return response()->json(['message' => 'Group updated successfully.']);
    }

    public function delete(Group $group)
    {
        $group->delete();
        return response()->json(['message' => 'Group deleted successfully.']);
    }
}
