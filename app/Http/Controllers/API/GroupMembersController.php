<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupMembersController extends Controller
{
    /**
     * Barcha group_subjects yozuvlarini olish
     */
    public function index()
    {
        $groupMembers = DB::table('group_members')->get();
        return response()->json($groupMembers);
    }

    /**
     * Yangi group_subject qo'shish
     */
    public function store(Request $request)
    {
        $request->validate([
            'group_id' => 'required|exists:groups,id',
            'member_id' => 'required|exists:members,id',
        ]);

        DB::table('group_members')->insert([
            'group_id' => $request->group_id,
            'members_id' => $request->members_id,
        ]);

        return response()->json(['message' => 'GroupMember added successfully!'], 201);
    }

    /**
     * Bitta group_subject ni olish
     */
    public function show($id)
    {
        $groupMember = DB::table('group_members')->where('id', $id)->first();

        if (!$groupMember) {
            return response()->json(['message' => 'GroupMembers not found'], 404);
        }

        return response()->json($groupMember);
    }

    /**
     * group_subject yangilash
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'group_id' => 'sometimes|exists:groups,id',
            'members_id' => 'sometimes|exists:members,id',
        ]);

        $updated = DB::table('group_members')->where('id', $id)->update([
            'group_id' => $request->group_id,
            'member_id' => $request->member_id,
        ]);

        if (!$updated) {
            return response()->json(['message' => 'GroupMembers not found'], 404);
        }

        return response()->json(['message' => 'GroupMembers updated successfully!']);
    }

    /**
     * group_subject ni o'chirish
     */
    public function destroy($id)
    {
        $deleted = DB::table('group_members')->where('id', $id)->delete();

        if (!$deleted) {
            return response()->json(['message' => 'GroupMembers not found'], 404);
        }

        return response()->json(['message' => 'GroupMembers deleted successfully!']);
    }
}
