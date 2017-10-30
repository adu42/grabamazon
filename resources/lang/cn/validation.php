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

    'accepted'             => ':attribute必须可接受.',
    'active_url'           => ':attribute不是url.',
    'after'                => ':attribute必须是在:date之后.',
    'alpha'                => ':attribute只能包含字符.',
    'alpha_dash'           => ':attribute只能包含字母、数字、横线和下横行.',
    'alpha_num'            => ':attribute只能包含字母和数字.',
    'array'                => ':attribute必须是数组.',
    'before'               => ':attribute必须早于:date.',
    'between'              => [
        'numeric' => ':attribute必须在:min和:max之间.',
        'file'    => ':attribute大小必须在:min和:max kb之间.',
        'string'  => ':attribute长度:min和:max个字符之间.',
        'array'   => ':attribute数组必须有:min与:max之间个元素.',
    ],
    'boolean'              => ':attribute必须填是或否.',
    'confirmed'            => ':attribute确认信息错误.',
    'date'                 => ':attribute不是正确的日期格式.',
    'date_format'          => ':attribute日期格式不是:format.',
    'different'            => ':attribute和:other必须不同.',
    'digits'               => ':attribute必须是:digits数字.',
    'digits_between'       => ':attribute必须是:min,:max之间的数字.',
    'email'                => ':attribute必须是正确的email地址.',
    'filled'               => ':attribute必填.',
    'exists'               => ':attribute选择项不可用.',
    'image'                => ':attribute必须是图片.',
    'in'                   => ':attribute选择项不可用.',
    'integer'              => ':attribute必须是整数.',
    'ip'                   => ':attribute必须是正确的IP地址.',
    'max'                  => [
        'numeric' => ':attribute不能大于:max.',
        'file'    => ':attribute不能超过:max kb.',
        'string'  => ':attribute不能超过:max个字符.',
        'array'   => ':attribute不能超过:max个元素.',
    ],
    'mimes'                => ':attribute文件类型必须是: :values.',
    'min'                  => [
        'numeric' => ':attribute不能小于:min.',
        'file'    => ':attribute不能少于:min kb.',
        'string'  => ':attribute不能少于:min 个字符.',
        'array'   => ':attribute不能少于:min 个元素.',
    ],
    'not_in'               => '选择的:attribute不可用.',
    'numeric'              => ':attribute必须是数字.',
    'regex'                => ':attribute格式错误.',
    'required'             => ':attribute必填.',
    'required_if'          => ':attribute当:other是:value必填.',
    'required_with'        => ':attribute当带:values时必填.',
    'required_with_all'    => ':attribute当带:values时必填.',
    'required_without'     => ':attribute当不带:values时必填.',
    'required_without_all' => ':attribute当不带:values时必填.',
    'same'                 => ':attribute跟:other必须一致.',
    'size'                 => [
        'numeric' => ':attribute必须是数字:size.',
        'file'    => ':attribute必须是:size kb.',
        'string'  => ':attribute必须是:size个字符.',
        'array'   => ':attribute必须包含:size个元素.',
    ],
    'string'               => ':attribute必须是字符串.',
    'timezone'             => ':attribute必须是可用的时间区.',
    'unique'               => ':attribute已经存在taken.',
    'url'                  => ':attribute无效的格式.',

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
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
