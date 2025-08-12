<?php

namespace App\Domains\OData\Instances;

class EntityInstance
{
    public string $code;
    public string $url;
    public string $type;
    public string $name;

    public function __construct(array $data)
    {
        $code = $data['name'] ?? $data['url'];
        $url = $data['url'] ?? $data['name'];

        $this->code = $code;
        $this->url = $url;

        $array = explode("_", $code);

        $this->type = array_shift($array);
        $this->name = implode(", ", $array);
    }

    public function getName(): string
    {
    $spaced = preg_replace('/(?<!^)([А-Я])/u', ' $1', $this->name);
    $spaced = mb_strtolower($spaced);
    return mb_strtoupper(mb_substr($spaced, 0, 1)) . mb_substr($spaced, 1);
    }

    public function getType(): string
    {
        switch ($this->type) {
            case 'InformationRegister':
                return 'Регистр';
                break;

            case 'Catalog':
                return 'Справочник';
                break;

            case 'Document':
                return 'Документ';
                break;

            default:
                return 'Неизвестно';
                break;
        }
    }
}
