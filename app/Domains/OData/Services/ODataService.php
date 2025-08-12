<?php

namespace App\Domains\OData\Services;

use Illuminate\Support\Facades\Http;
use App\Domains\OData\Instances\EntityInstance;

class ODataService
{
    protected function request($method, $url, $data = [])
    {
        $request = Http::withOptions(['verify' => false])
            ->withBasicAuth(config('odata.username'), config('odata.password'));

        $fullUrl = config('odata.base_url') . 'odata/standard.odata/' . $url;

        if (in_array(strtolower($method), ['get', 'delete']) || empty($data)) {
            return $request->{$method}($fullUrl)->json();
        }

        return $request->{$method}($fullUrl, $data)->json();
    }

    public function catalog()
    {
        $catalog = $this->request('get', "?\$format=json")['value'] ?? [];

        return array_map(function ($item) {
            return new EntityInstance($item);
        }, $catalog);
    }

    public function list(string $entity)
    {
        $data = $this->request('get', "$entity?\$top=1000&\$format=json")['value'] ?? [];
        return $this->cleanData($data);
    }

    public function get(string $entity, string $id)
    {
        $data = $this->request('get', "$entity(guid'$id')?\$format=json");
        return $this->cleanData($data);
    }

    public function create(string $entity, array $data)
    {
        return $this->request('post', "$entity", $data);
    }

    public function update(string $entity, string $id, array $data)
    {
        return $this->request('patch', "$entity(guid'$id')", $data);
    }

    public function delete(string $entity, string $id)
    {
        return $this->request('delete', "$entity(guid'$id')");
    }

    protected function cleanData(array $data): array
    {
        $filtered = array_filter($data, function ($value) {
            return !(
                $value === false ||
                $value === null ||
                $value === [] ||
                $value === 0 ||
                $value === '' ||
                $value === '00000000-0000-0000-0000-000000000000'
            );
        });

        ksort($filtered); // Сортировка по ключам
        return $filtered;
    }
}
