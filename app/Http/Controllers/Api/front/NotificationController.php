<?php

namespace App\Http\Controllers\Api\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class NotificationController extends Controller
{

    
    public function notifications(Request $request)
{
    $userId = $request->input('user_id');

    $user = User::find($userId);

    if (!$user) 
        {
        return response()->json(['message' => 'User not found'], 404);
        }
    
    return $user->notifications;
}

}
