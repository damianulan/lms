<?php

namespace App\Facades\Forms\Elements;

use Illuminate\Support\Collection;

class Dictionary
{
    /**
     * Declare array collections of options accessible to the public.
     */
    public $mail_encryption_methods = [
        'tls' => 'TLS',
        'ssl' => 'SSL',
        'starttls' => 'STARTTLS',
        'null' => 'PLAIN'
    ];

    public static function fromModel(string $model, string $column, string $method = 'all'): Collection
    {
        $records = $model::$method();
        $options = new Collection();

        if(!empty($records)){
            foreach ($records as $record){
                $options->push(new Option($record->id, $record->$column));
            }
        }
        return $options;
    }

    public static function fromUnassocArray(array $values, string $lang_component = ''): Collection
    {
        $options = new Collection();

        if(!empty($values)){
            foreach($values as $value){
                $content = ucfirst($value);
                if(!empty($lang_component)){
                    $content = __($lang_component.'.'.$value);
                }
                $options->push(new Option($value, $content));
            }
        }

        return $options;
    }

    /**
     * @param array $values Here database value as an array's key.
     */
    public static function fromAssocArray(array $values): Collection
    {
        $options = new Collection();

        if(!empty($values)){
            foreach($values as $value => $content){
                $options->push(new Option($value, $content));
            }
        }

        return $options;
    }

    public static function fromCatalog(string $index)
    {
        $instance = new self();

        if(isset($instance->$index)){
            return self::fromAssocArray($instance->$index);
        }

        return null;
    }

    public static function yesNo()
    {
        $options = new Collection();

        $options->push(new Option(1, __('vocabulary.yes')));
        $options->push(new Option(0, __('vocabulary.no')));

        return $options;
    }
}
