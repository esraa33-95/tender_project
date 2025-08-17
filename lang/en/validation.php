<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'The :attribute field must be accepted.',
    'accepted_if' => 'The :attribute field must be accepted when :other is :value.',
    'active_url' => 'The :attribute field must be a valid URL.',
    'after' => 'The :attribute field must be a date after :date.',
    'after_or_equal' => 'The :attribute field must be a date after or equal to :date.',
    'alpha' => 'The :attribute field must only contain letters.',
    'alpha_dash' => 'The :attribute field must only contain letters, numbers, dashes, and underscores.',
    'alpha_num' => 'The :attribute field must only contain letters and numbers.',
    'any_of' => 'The :attribute field is invalid.',
    'array' => 'The :attribute field must be an array.',
    'ascii' => 'The :attribute field must only contain single-byte alphanumeric characters and symbols.',
    'before' => 'The :attribute field must be a date before :date.',
    'before_or_equal' => 'The :attribute field must be a date before or equal to :date.',
    'between' => [
        'array' => 'The :attribute field must have between :min and :max items.',
        'file' => 'The :attribute field must be between :min and :max kilobytes.',
        'numeric' => 'The :attribute field must be between :min and :max.',
        'string' => 'The :attribute field must be between :min and :max characters.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'can' => 'The :attribute field contains an unauthorized value.',
    'confirmed' => 'The :attribute field confirmation does not match.',
    'contains' => 'The :attribute field is missing a required value.',
    'current_password' => 'The password is incorrect.',
    'date' => 'The :attribute field must be a valid date.',
    'date_equals' => 'The :attribute field must be a date equal to :date.',
    'date_format' => 'The :attribute field must match the format :format.',
    'decimal' => 'The :attribute field must have :decimal decimal places.',
    'declined' => 'The :attribute field must be declined.',
    'declined_if' => 'The :attribute field must be declined when :other is :value.',
    'different' => 'The :attribute field and :other must be different.',
    'digits' => 'The :attribute field must be :digits digits.',
    'digits_between' => 'The :attribute field must be between :min and :max digits.',
    'dimensions' => 'The :attribute field has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'doesnt_end_with' => 'The :attribute field must not end with one of the following: :values.',
    'doesnt_start_with' => 'The :attribute field must not start with one of the following: :values.',
    'email' => 'The :attribute field must be a valid email address.',
    'ends_with' => 'The :attribute field must end with one of the following: :values.',
    'enum' => 'The selected :attribute is invalid.',
    'exists' => 'The selected :attribute is invalid.',
    'extensions' => 'The :attribute field must have one of the following extensions: :values.',
    'file' => 'The :attribute field must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'array' => 'The :attribute field must have more than :value items.',
        'file' => 'The :attribute field must be greater than :value kilobytes.',
        'numeric' => 'The :attribute field must be greater than :value.',
        'string' => 'The :attribute field must be greater than :value characters.',
    ],
    'gte' => [
        'array' => 'The :attribute field must have :value items or more.',
        'file' => 'The :attribute field must be greater than or equal to :value kilobytes.',
        'numeric' => 'The :attribute field must be greater than or equal to :value.',
        'string' => 'The :attribute field must be greater than or equal to :value characters.',
    ],
    'hex_color' => 'The :attribute field must be a valid hexadecimal color.',
    'image' => 'The :attribute field must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field must exist in :other.',
    'in_array_keys' => 'The :attribute field must contain at least one of the following keys: :values.',
    'integer' => 'The :attribute field must be an integer.',
    'ip' => 'The :attribute field must be a valid IP address.',
    'ipv4' => 'The :attribute field must be a valid IPv4 address.',
    'ipv6' => 'The :attribute field must be a valid IPv6 address.',
    'json' => 'The :attribute field must be a valid JSON string.',
    'list' => 'The :attribute field must be a list.',
    'lowercase' => 'The :attribute field must be lowercase.',
    'lt' => [
        'array' => 'The :attribute field must have less than :value items.',
        'file' => 'The :attribute field must be less than :value kilobytes.',
        'numeric' => 'The :attribute field must be less than :value.',
        'string' => 'The :attribute field must be less than :value characters.',
    ],
    'lte' => [
        'array' => 'The :attribute field must not have more than :value items.',
        'file' => 'The :attribute field must be less than or equal to :value kilobytes.',
        'numeric' => 'The :attribute field must be less than or equal to :value.',
        'string' => 'The :attribute field must be less than or equal to :value characters.',
    ],
    'mac_address' => 'The :attribute field must be a valid MAC address.',
    'max' => [
        'array' => 'The :attribute field must not have more than :max items.',
        'file' => 'The :attribute field must not be greater than :max kilobytes.',
        'numeric' => 'The :attribute field must not be greater than :max.',
        'string' => 'The :attribute field must not be greater than :max characters.',
    ],
    'max_digits' => 'The :attribute field must not have more than :max digits.',
    'mimes' => 'The :attribute field must be a file of type: :values.',
    'mimetypes' => 'The :attribute field must be a file of type: :values.',
    'min' => [
        'array' => 'The :attribute field must have at least :min items.',
        'file' => 'The :attribute field must be at least :min kilobytes.',
        'numeric' => 'The :attribute field must be at least :min.',
        'string' => 'The :attribute field must be at least :min characters.',
    ],
    'min_digits' => 'The :attribute field must have at least :min digits.',
    'missing' => 'The :attribute field must be missing.',
    'missing_if' => 'The :attribute field must be missing when :other is :value.',
    'missing_unless' => 'The :attribute field must be missing unless :other is :value.',
    'missing_with' => 'The :attribute field must be missing when :values is present.',
    'missing_with_all' => 'The :attribute field must be missing when :values are present.',
    'multiple_of' => 'The :attribute field must be a multiple of :value.',
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute field format is invalid.',
    'numeric' => 'The :attribute field must be a number.',
    'password' => [
        'letters' => 'The :attribute field must contain at least one letter.',
        'mixed' => 'The :attribute field must contain at least one uppercase and one lowercase letter.',
        'numbers' => 'The :attribute field must contain at least one number.',
        'symbols' => 'The :attribute field must contain at least one symbol.',
        'uncompromised' => 'The given :attribute has appeared in a data leak. Please choose a different :attribute.',
    ],
    'present' => 'The :attribute field must be present.',
    'present_if' => 'The :attribute field must be present when :other is :value.',
    'present_unless' => 'The :attribute field must be present unless :other is :value.',
    'present_with' => 'The :attribute field must be present when :values is present.',
    'present_with_all' => 'The :attribute field must be present when :values are present.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_if_accepted' => 'The :attribute field is prohibited when :other is accepted.',
    'prohibited_if_declined' => 'The :attribute field is prohibited when :other is declined.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'regex' => 'The :attribute field format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_array_keys' => 'The :attribute field must contain entries for: :values.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_if_accepted' => 'The :attribute field is required when :other is accepted.',
    'required_if_declined' => 'The :attribute field is required when :other is declined.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute field must match :other.',
    'size' => [
        'array' => 'The :attribute field must contain :size items.',
        'file' => 'The :attribute field must be :size kilobytes.',
        'numeric' => 'The :attribute field must be :size.',
        'string' => 'The :attribute field must be :size characters.',
    ],
    'starts_with' => 'The :attribute field must start with one of the following: :values.',
    'string' => 'The :attribute field must be a string.',
    'timezone' => 'The :attribute field must be a valid timezone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'uppercase' => 'The :attribute field must be uppercase.',
    'url' => 'The :attribute field must be a valid URL.',
    'ulid' => 'The :attribute field must be a valid ULID.',
    'uuid' => 'The :attribute field must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'name_en' => [
            'required' => ' English name is required',
            'string'   => ' English name must string',
            'min'      => ' English name must be at least 2 ',
            'max'      => ' English name may not be greater than 255',
            'regex'    => ' English name may  contain letters and spaces',
            'unique'   => ' English name  exist',
        ],

         'name_ar' => [
            'required' => ' Arabic name is required',
            'string'   => ' Arabic name must  string',
            'min'      => ' Arabic name must be at least 2',
            'max'      => ' Arabic name may not be greater than 255',
            'regex'    => ' Arabic name may only contain Arabic letters and spaces',
            'unique'   => ' Arabic name  exist',
         ],
         'added_date' => [
            'required'    => ' added date is required',
            'date_format' => ' added date must  format Y-M-D',
        ],

        'type' => [
            'required'    => 'type is required',
            'in' => ' type must  1 or 2',
        ],
        'room_property' => [
            'required' => ' room property field is required',
            'in'       => ' room property must be one of: 1, 2, or 3',
        ],

        'image' => [
            'required' => 'An image is required',
            'mimes'    => ' image must be a file of type: png, jpg, jpeg',
        ],

        'price' => [
            'required' => ' price field is required',
            'numeric'  => ' price must number',
        ],

        'contractor_percentage' => [
            'required' => ' contractor percentage field is required',
            'numeric'  => ' contractor percentage must  number',
            'between'  => ' contractor percentage must be between 0 and 100',
        ],
        'room_zone_id' => [
            'required' => ' room zone field is required',
            'exists'   => ' selected room zone is invalid',
        ],

        'addition_id'=>[
            'required' => ' addition field is required',
            'exists'   => ' selected addition is invalid',
        ],
        'user_id' => [
            'required' => ' user field is required',
            'exists'   => ' selected user is invalid',
        ],

        'contractor_id' => [
            'required' => ' contractor field is required',
            'exists'   => ' selected contractor is invalid',
        ],

        'project_type_id' => [
            'required' => ' project type field is required',
            'exists'   => ' selected project type is invalid',
        ],

        'name' => [
            'required' => ' project name is required',
            'min'      => ' project name must be at least 2 ',
            'max'      => ' project name until 50',
        ],

        'area' => [
            'required' => ' area is required.',
            'min'      => ' area must greater than 0 ',
        ],

        'budget_from' => [
            'required' => ' starting budget is required',
            'numeric'  => ' starting budget must number',
            'min'      => ' starting budget must  greater than 0',
        ],

        'budget_to' => [
            'required' => ' ending budget is required.',
            'numeric'  => ' ending budget must  number.',
            'gt'       => ' ending budget must  greater than  budget_from',
        ],

        'open_budget' => [
            'boolean' => ' open budget field must  0 or 1',
        ],

        'location' => [
            'required' => ' location is required',
            'min'      => ' location must be at least 2',
            'max'      => ' location must until 100',
        ],

        'duration' => [
            'required' => ' project duration is required',
            'integer'  => ' project duration must be an integer',
        ],

        'start_date' => [
            'required'    => ' project start date is required',
            'date_format' => ' project start date must be in  format Y-m-d',
            'after'       => ' project start date after today',
        ],

        'status' => [
            'required' => ' project status is required',
            'integer'  => ' project status must  integer',
            'in'       => ' project status must  1',
        ],
        'project_id' => [
            'required' => ' project is required',
            'exists'   => ' selected project is invalid',
        ],

        'length' => [
            'required' => ' length is required',
            'numeric'  => ' length must  number',
        ],

        'height' => [
            'required' => ' height is required',
            'numeric'  => ' height must  number',
        ],

        'width' => [
            'required' => ' width is required',
            'numeric'  => ' width must  number',
        ],

        'description' => [
            'required' => ' description is required',
            'string'   => ' description must  string',
            'min'      => ' description must at least 2',
            'max'      => ' description must until 500',
        ],
        'material_category_id' => [
            'required' => ' material category is required',
            'integer'  => ' material category must  integer',
            'exists'   => ' material category is invalid',
        ],
        'project_room_id' => [
            'required' => ' project room is required',
            'integer'  => ' project room must  integer',
            'exists'   => ' project room is invalid',
        ],

        'addition_type_id' => [
            'required' => ' addition type is required',
            'integer'  => ' addition type must  integer',
            'exists'   => ' addition type is invalid',
        ],

        'amount' => [
            'required' => ' amount is required',
            'integer'  => ' amount must  integer',
        ],
         'user_id' => [
            'required' => ' user is required',
            'exists'   => ' selected user is invalid',
        ],

        'rate' => [
            'required' => ' rate is required',
            'integer'  => ' rate must integer',
            'min'      => ' rate must be  least 1',
            'max'      => ' rate must not be greater than 5',
        ],

        'cancel_reason' => [
            'required' => ' cancel reason is required',
            'string'   => ' cancel reason must  string',
            'min'      => ' cancel reason must at least 2 ',
            'max'      => ' cancel reason must  greater than 50 ',
        ],
         'materials' => [
            'required' => ' materials is required',
            'array'    => ' materials must array',
        ],
        'materials.floor' => [
            'required' => ' floor material is required',
            'exists'   => ' floor material is invalid',
        ],
        'materials.ceil' => [
            'required' => 'ceil material is required',
            'exists'   => 'ceil material is invalid',
        ],
        'materials.wall' => [
            'required' => ' wall material is required',
            'exists'   => ' wall material is invalid',
        ],

        'additions' => [
            'required' => ' additions field is required',
            'array'    => ' additions must be an array',
        ],
        'additions.*.addition_type_id' => [
            'required' => ' addition type is required',
            'exists'   => ' selected addition type is invalid',
        ],
        'additions.*.amount' => [
            'required' => ' amount is required',
            'numeric'  => ' amount must be a number',
            'min'      => ' amount must be at least 1',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    |  following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'name_en',
         'name_ar',
         'added_date',
         'type',
         'room_property',
         'image',
         'price',
         'contractor_percentage',
         'room_zone_id',
         'addition_id',
         'user_id',
         'contractor_id',
         'project_type_id',
         'name',
         'area',
         'budget_from',
         'budget_to',
         'open_budget',
         'location',
         'duration',
         'start_date',
         'status',
         'project_id',
         'length',
         'height',
         'width',
         'description',
         'material_category_id',
         'project_room_id',
         'addition_type_id',
         'amount',
         'user_id',
         'rate',
         'cancel_reason',
         'materials',
        'materials.floor',
        'materials.ceil' ,
        'materials.wall',
         'additions',
        'additions.*.addition_type_id' ,
        'additions.*.amount', 

    ],


];
