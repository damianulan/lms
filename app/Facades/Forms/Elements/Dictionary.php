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

    public static function fromModel(string $model, string $column): Collection
    {
        $records = $model::all();
        $options = new Collection();

        if(!empty($records)){
            foreach ($records as $record){
                $options->push(new Option($record->id, $record->$column));
            }
        }
        return $options;
    }

    public static function fromUnassocArray(array $values): Collection
    {
        $options = new Collection();

        if(!empty($values)){
            foreach($values as $value){
                $options->push(new Option($value, ucfirst($value)));
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
}