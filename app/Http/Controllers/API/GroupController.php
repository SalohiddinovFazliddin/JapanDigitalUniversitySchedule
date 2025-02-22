<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{

    public function index(Group $request)
    {
        $perPage = $request->get('per_page', 10);
        $groups = Group::query()->paginate($perPage);
        return response()->json($groups);
    }


    public function show(Group $group)
    {
        return response()->json($group);
    }


    public function create(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
        ]);
        Group::query()->create([$validator]);
        return response()->json(['message' => 'Group created successfully.']);
    }


    public function update(Request $request, Group $group)
    {
        $validator = $request->validate([
            'name' => 'required',
        ]);
        $group->update($validator);
        return response()->json(['message' => 'Group updated successfully.']);
    }

    public function delete(Group $group)
    {
        $group->delete();
        return response()->json(['message' => 'Group deleted successfully.']);
    }
}
