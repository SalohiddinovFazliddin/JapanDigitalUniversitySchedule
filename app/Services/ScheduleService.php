<?php

namespace App\Services;
use App\Http\Requests\StoreScheduleRequest;
use App\Models\Schedule;
class ScheduleService
{
    public function store(array $data)
    {
        $schedule = Schedule::query()
            ->where('subject_id', $data['subject_id'])
            ->where('teacher_id', $data['teacher_id'])
            ->where('group_id', $data['group_id'])
            ->where('room_id', $data['room_id'])
            ->where('pair', $data['pair'])
            ->where('week_day', $data['week_day'])
            ->where('date', $data['date'])
            ->first();
        if($schedule){
            return response()->json([
                'success' => false,
                'message' => 'Schedule already exists'
            ]);

            Schedule::query()->create($data);
            return response()->json([
                'success' => true,
                'message' => 'Schedule created successfully.'
            ]);
        }

    }

}
