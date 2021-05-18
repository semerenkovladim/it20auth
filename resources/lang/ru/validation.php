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

    'accepted' => ':attribute должен быть принят.',
    'active_url' => ':attribute не является допустимым URL.',
    'after' => ':attribute должен быть датой после :date.',
    'after_or_equal' => ':attribute должен быть датой после или равной :date.',
    'alpha' => ':attribute должен содержать только буквы.',
    'alpha_dash' => ':attribute должен содержать только буквы, цифры, дефисы и подчеркивания.',
    'alpha_num' => ':attribute должен содержать только буквы и цифры.',
    'array' => ':attribute должен быть массивом.',
    'before' => ':attribute должен быть датой до :date.',
    'before_or_equal' => ':attribute должен быть датой до или равной :date.',
    'between' => [
        'numeric' => ':attribute должен быть между :min и :max.',
        'file' => ':attribute должен находиться в диапазоне от :min до :max килобайт.',
        'string' => ':attribute должен содержать символы :min и :max characters.',
        'array' => ':attribute должен содержать от :min до :max элементов.',
    ],
    'boolean' => ':attribute должно быть истинным или ложным.',
    'confirmed' => ':attribute подтверждение не совпадает.',
    'date' => ':attribute не является допустимой датой.',
    'date_equals' => ':attribute должен быть датой, равной :date.',
    'date_format' => ':attribute не соответствует формату :format.',
    'different' => ':attribute и :other должны быть разными.',
    'digits' => ':attribute должен быть :digits digits.',
    'digits_between' => ':attribute должен быть между :min и :max цифрами.',
    'dimensions' => ':attribute имеет недопустимые размеры изображения.',
    'distinct' => ':attribute имеет повторяющееся значение.',
    'email' => ':attribute должен быть действующим адресом электронной почты.',
    'ends_with' => ':attribute должен заканчиваться одним из следующих: :values.',
    'exists' => 'Выбранный :attribute недействителен.',
    'file' => ':attribute должен быть файлом.',
    'filled' => ':attribute должен иметь значение.',
    'gt' => [
        'numeric' => ':attribute должен быть больше, чем :value.',
        'file' => ':attribute должен быть больше, чем :value килобайт.',
        'string' => ':attribute должен быть больше, чем :value символов.',
        'array' => ':attribute должен содержать более :value элементов.',
    ],
    'gte' => [
        'numeric' => ':attribute должен быть больше или равен :value.',
        'file' => ':attribute должен быть больше или равен :value килобайт.',
        'string' => ':attribute должен быть больше или равен :value символам.',
        'array' => ':attribute должен иметь :value элементов или более.',
    ],
    'image' => ':attribute должен быть изображением.',
    'in' => 'Выбранный :attribute недействителен.',
    'in_array' => ':attribute не существует в :other.',
    'integer' => ':attribute должен быть целым числом.',
    'ip' => ':attribute должен быть действительным IP-адресом.',
    'ipv4' => ':attribute должен быть действительным IPv4-адресом.',
    'ipv6' => ':attribute должен быть действительным IPv6-адресом.',
    'json' => ':attribute должен быть допустимой строкой JSON.',
    'lt' => [
        'numeric' => ':attribute должен быть меньше :value.',
        'file' => ':attribute должен быть меньше :value килобайт.',
        'string' => ':attribute должен содержать меньше :value символов.',
        'array' => ':attribute должен содержать меньше :value элементов.',
    ],
    'lte' => [
        'numeric' => ':attribute должен быть меньше или равен :value.',
        'file' => ':attribute должен быть меньше или равен :value килобайт.',
        'string' => ':attribute должен быть меньше или равен :value символов.',
        'array' => ':attribute не может содержать более :value элементов.',
    ],
    'max' => [
        'numeric' => ':attribute не должен быть больше, чем :max.',
        'file' => ':attribute не должен быть больше :max килобайт.',
        'string' => ':attribute не должен быть больше, чем :max символов.',
        'array' => ':attribute не может содержать более :max элементов.',
    ],
    'mimes' => ':attribute должен быть файлом типа: :values.',
    'mimetypes' => ':attribute должен быть файлом типа: :values.',
    'min' => [
        'numeric' => ':attribute должен быть не меньше :min.',
        'file' => ':attribute должен быть не меньше :min килобайт.',
        'string' => ':attribute должен содержать не менее :min символов.',
        'array' => ':attribute должен содержать как минимум :min элементов.',
    ],
    'multiple_of' => ':attribute должен быть кратным :value.',
    'not_in' => 'Выбранный :attribute недействителен.',
    'not_regex' => 'Формат :attribute недействителен.',
    'numeric' => ':attribute должен быть числом.',
    'password' => 'неверный пароль.',
    'present' => 'Поле:attribute должно присутствовать.',
    'regex' => 'Формат :attribute недействителен.',
    'required' => 'Поле :attribute является обязательным.',
    'required_if' => 'Поле атрибута :attribute требуется, когда :other равно :value.',
    'required_unless' => 'Поле :attribute является обязательным, если :other не находится в :values.',
    'required_with' => 'Поле :attribute является обязательным, если присутствует :values.',
    'required_with_all' => 'Поле :attribute необходимо, когда в :values присутствуют present.',
    'required_without' => 'Поле :attribute требуется, когда :values отсутствует.',
    'required_without_all' => 'Поле :attribute является обязательным, если нет ни одного из :values.',
    'prohibited' => 'Поле :attribute запрещено.',
    'prohibited_if' => 'Поле :attribute атрибута запрещено, когда :other равно :value.',
    'prohibited_unless' => 'Поле :attribute запрещено, если :other не находится в :values.',
    'same' => ':attribute и :other должны совпадать.',
    'size' => [
        'numeric' => ':attribute должен быть :size.',
        'file' => ':attribute должен быть :size килобайт.',
        'string' => ':attribute должен быть из :size символов.',
        'array' => ':attribute должен содержать :size элементы.',
    ],
    'starts_with' => ':attribute должен начинаться с одного из следующих: :values.',
    'string' => ':attribute должен быть строкой.',
    'timezone' => ':attribute должен быть допустимой зоной..',
    'unique' => ':attribute уже занят.',
    'uploaded' => 'Не удалось загрузить атрибут :attribute.',
    'url' => 'Формат :attribute атрибута недействителен.',
    'uuid' => ':attribute должен быть действительным UUID.',

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
    | following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
