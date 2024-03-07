<?php

namespace App\Http\Controllers;

use App\Models\Check;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class CheckController extends Controller
{
    public function check_upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|file:image'
        ]);

        if ($validator->fails()) {
            return redirect('/')->withErrors($validator, 'checks')->withInput();
        }

        $allData = $request->all();

        $img = $allData['image'];
        $imgName = Auth::user()->id . '.' . $request->file('image')->getClientOriginalExtension();
        Storage::disk('checks')->put($imgName, file_get_contents($img));

        $uploadTime = Carbon::now();

        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $currentWeek = Carbon::now()->isoWeek;

        if ($uploadTime->hour % 2 === 0) {

            $check = Check::create([
                'status' => 1,
                'user_id' => Auth::user()->id,
                'image' => $imgName,
                'date' => $uploadTime,
                'code' => null,
            ]);


            if ($this->isPrizeCheck($check)) {
                $uniqueCode = Str::random(8);
                $check->update(['code' => $uniqueCode]);
            }

            session()->flash('success', 'Призовой чек успешно загружено!');
        } else {
            Check::create([
                'status' => 0,
                'user_id' => Auth::user()->id,
                'image' => $imgName,
                'date' => $uploadTime
            ]);

            session()->flash('success', 'Обычный чек загружено!');
        }


        return redirect('/')->with('success', 'Чек успешно загружено!');
    }

    private function isPrizeCheck($check)
    {
        // Место чтобы в админке моддерировать чек 😁
        return true;
    }
}
