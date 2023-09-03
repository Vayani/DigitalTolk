<?php
namespace DTApi\Helpers;

use Carbon\Carbon;
use DTApi\Models\Job;
use DTApi\Models\User;
use DTApi\Models\Language;
use DTApi\Models\UserMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TeHelper
{
    public static function fetchLanguageFromJobId($id)
    {
        $language = Language::findOrFail($id);
        return $language->language;
        
        // I have removed the unnecessary reassignment of $language1 after fetching the language name from the Language model. The returned value directly comes from the language property of the retrieved language object. This simplifies the code while maintaining its functionality.
    }

    public static function getUsermeta($user_id, $key = false)
    {
        // return $user = UserMeta::where('user_id', $user_id)->first()->$key;
        // if (!$key)
        //     return $user->usermeta()->get()->all();
        // else {
        //     $meta = $user->usermeta()->where('key', '=', $key)->get()->first();
        //     if ($meta)
        //         return $meta->value;
        //     else return '';
        // }
        $userMetaQuery = UserMeta::where('user_id', $user_id);

        if (!$key) {
            return $userMetaQuery->get()->all();
        } else {
            $meta = $userMetaQuery->where('key', '=', $key)->first();
            return $meta ? $meta->value : '';
        }
    }
    // I have combined the two separate if conditions for handling the cases where $key is provided or not. 
    // This enhances the code clarity and readability while maintaining the original logic.

    public static function convertJobIdsInObjs($jobs_ids)
    {

        $jobs = array();
        foreach ($jobs_ids as $job_obj) {
            $jobs[] = Job::findOrFail($job_obj->id);
        }
        return $jobs;
    }

    public static function willExpireAt($due_time, $created_at)
    {
        // $due_time = Carbon::parse($due_time);
        // $created_at = Carbon::parse($created_at);

        // $difference = $due_time->diffInHours($created_at);


        // if($difference <= 90)
        //     $time = $due_time;
        // elseif ($difference <= 24) {
        //     $time = $created_at->addMinutes(90);
        // } elseif ($difference > 24 && $difference <= 72) {
        //     $time = $created_at->addHours(16);
        // } else {
        //     $time = $due_time->subHours(48);
        // }

        // return $time->format('Y-m-d H:i:s');
        $dueTime = Carbon::parse($due_time);
        $createdAt = Carbon::parse($created_at);

        $difference = $dueTime->diffInHours($createdAt);

        if ($difference <= 90) {
            $time = $dueTime;
        } elseif ($difference <= 24) {
            $time = $createdAt->addMinutes(90);
        } elseif ($difference <= 72) {
            $time = $createdAt->addHours(16);
        } else {
            $time = $dueTime->subHours(48);
        }

        return $time->format('Y-m-d H:i:s');

    }
    // I have used more descriptive variable names (camelCase) to improve readability. 
    // I have also aligned the conditions and statements for better consistency. 
    // This results in a cleaner and easier-to-understand function.

}

