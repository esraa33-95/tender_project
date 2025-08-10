<?php

namespace App\Transformers\admin;

use League\Fractal\TransformerAbstract;
use App\Models\Addition;

class AdditionTransform extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Addition $addition):array
    {
        return [
              'id' =>$addition->id,
              'name_en' => $addition->translate('en')->name,
              'name_ar' => $addition->translate('ar')->name,
              'added_date'=>$addition->added_date ?? 'n/a',
              'room_zone_id' => $addition->room_zone_id,
        ];
    }
}
