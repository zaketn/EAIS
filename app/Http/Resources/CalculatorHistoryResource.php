<?php

namespace App\Http\Resources;

use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CalculatorHistoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => UserResource::make($this->user),
            'variables' => json_decode($this->variables),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
    public static function saveData(array $requestData)
    {
        $history = new History();
        $history->user_id = $requestData['user_id'];
        $history->variables = $requestData['variables'];
        $history->save();

        return $history;
    }

    public static function getRecord($id)
    {
        $history = History::findOrFail($id);

        return new CalculatorHistoryResource($history);
    }
}
