<?php

namespace App\Http\Controllers;

use App\Models\ProfessionalSkill;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProfessionalSkillController extends Controller
{
    // گرفتن اسکیل‌ها
    public function show(Request $request)
    {
        return ProfessionalSkill::where('user_id', $request->user()->id)->first();
    }

    // ذخیره / آپدیت (Replace کامل)
    public function store(Request $request)
    {
        $data = $request->validate([
            'skills' => 'required|array',
            'skills.*' => 'string',
        ]);

        $skills = ProfessionalSkill::updateOrCreate(
            ['user_id' => $request->user()->id],
            ['skills' => $data['skills']]
        );

        return response()->json($skills);
    }

    // حذف کامل
    public function destroy(Request $request)
    {
        ProfessionalSkill::where('user_id', $request->user()->id)->delete();

        return response()->json(['message' => 'Skills deleted']);
    }


//    حذف تکی
    public function remove(Request $request, $skill)
    {
        $record = ProfessionalSkill::where('user_id', $request->user()->id)->first();

        if (!$record) {
            return response()->json(['skills' => []]);
        }

        $skills = array_values(array_filter(
            $record->skills,
            fn ($s) => $s !== $skill
        ));

        $record->update(['skills' => $skills]);

        return response()->json([
            'skills' => $skills
        ]);
    }

}
