<?php

namespace App\Transformers\front;

use App\Models\ProjectType;
use League\Fractal\TransformerAbstract;

class ProjectTypeTransform extends TransformerAbstract
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
     public function transform(ProjectType $type):array
    {
        return [
              'id' => $type->id,
              'name_en' => $type->translate('en')?->name,
              'name_ar' => $type->translate('ar')?->name,
        ];
    }
}
