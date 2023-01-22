<?php

namespace Michal\Logger\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Rainlab\User\Facades\Auth;
use Michal\Logger\Models\Log;

class LogResource extends JsonResource{


    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->user->name,
            //'user' => $this->user,
            'user_id' => $this->user->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }



}

?>
