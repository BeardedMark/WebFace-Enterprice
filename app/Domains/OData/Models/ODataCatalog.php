<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class OData extends Model
{
    protected $fillable = [];
    protected $entity; // Название сущности OData (например, 'Catalog_Nomenclature')
    protected $keyName = 'Ref_Key'; // OData ключ по умолчанию

    public function setEntity(string $entity)
    {
        $this->entity = $entity;
        return $this;
    }

    public function getEntity()
    {
        return $this->entity;
    }

    public function allItems()
    {
        return $this->request("{$this->entity}?\$format=json")['value'] ?? [];
    }

    public function findItem(string $id)
    {
        return $this->request("{$this->entity}(guid'$id')?\$format=json");
    }

    public function createItem(array $data)
    {
        return $this->request("{$this->entity}", 'post', $data);
    }

    public function updateItem(string $id, array $data)
    {
        return $this->request("{$this->entity}(guid'$id')", 'patch', $data);
    }

    public function deleteItem(string $id)
    {
        return $this->request("{$this->entity}(guid'$id')", 'delete');
    }

    protected function request($url, $method = 'get', $data = [])
    {
        $baseUrl = config('odata.base_url');
        $auth = [
            'username' => config('odata.username'),
            'password' => config('odata.password'),
        ];

        $response = Http::withBasicAuth($auth['username'], $auth['password']);

        return $response->{$method}($baseUrl . $url, $data)->json();
    }
}
