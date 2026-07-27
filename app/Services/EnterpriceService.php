<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

class EnterpriceService
{
    protected function request(string $method, string $url, array $data = [], array $headers = [])
    {
        $client = Http::withOptions(['verify' => false])
            ->withBasicAuth(config('enterprice.username'), config('enterprice.password'))
            ->withHeaders($headers);

        $fullUrl = config('enterprice.base_url') . $url;

        try {
            if (empty($data)) {
                return $client->{$method}($fullUrl)->throw();
            } else {
                return $client->{$method}($fullUrl, $data)->throw();
            }
        } catch (RequestException $e) {
            $errorData = [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'method' => $method,
                'url' => $fullUrl,
                'request' => $data ?? null,
                'response' => $e->response?->body(),
            ];

            if (env('APP_DEBUG')) {
                abort(response()->view('pages.error', $errorData));
            }
        }
    }

    // Pages

    public function GetMainPage(): array
    {
        return $this->request('get', 'pages/main')->json() ?? [];
    }

    public function GetContactsPage(): array
    {
        return $this->request('get', 'pages/contacts')->json() ?? [];
    }

    public function GetAboutPage(): array
    {
        return $this->request('get', 'pages/about')->json() ?? [];
    }

    public function GetCatalogPage(): array
    {
        return $this->request('get', 'pages/catalog')->json() ?? [];
    }

    // User

    public function GetUserCard(array $data = []): array
    {
        return $this->request('get', 'users/card', $data)->json() ?? [];
    }
    public function LoginUser(array $data = []): array
    {
        return $this->request('get', 'users/auth', $data)->json() ?? [];
    }
    public function RegisterUser(array $data = []): array
    {
        return $this->request('post', 'users/auth', $data)->json() ?? [];
    }

    // Organizations

    public function GetOrganizationCard(string $organization): array
    {
        return $this->request('get', 'organizations/' . $organization)->json() ?? [];
    }

    public function GetOrganizationsList(array $data = []): array
    {
        return $this->request('get', 'organizations', $data)->json() ?? [];
    }

    // Base

    public function GetBaseStatistics(array $data = []): array
    {
        return $this->request('get', 'base/stats', $data)->json() ?? [];
    }

    public function GetBaseData(array $data = []): array
    {
        return $this->request('get', 'base/card', $data)->json() ?? [];
    }

    // Contractors

    public function GetContractorCard(array $data = []): array
    {
        return $this->request('get', 'contractors/card', $data)->json() ?? [];
    }

    public function GetContractorsList(array $data = []): array
    {
        return $this->request('get', 'contractors/list', $data)->json() ?? [];
    }

    public function getOffersByContractor(string $contractor): array
    {
        return $this->request('get', "contractors/{$contractor}/offers")->json() ?? [];
    }

    // Deals

    public function getDealsByContractor(string $contractor): array
    {
        return $this->request('get', "contractors/{$contractor}/deals")->json() ?? [];
    }

    public function getDealByGuid(string $guid): array
    {
        return $this->request('get', "deals/{$guid}")->json() ?? [];
    }

    // Manufacturer

    public function GetManufacturerCard(string $manufacturer): array
    {
        return $this->request('get', 'manufacturers/' . $manufacturer)->json() ?? [];
    }

    public function GetManufacturersList(array $data = []): array
    {
        return $this->request('get', 'manufacturers', $data)->json() ?? [];
    }

    // Brands

    public function GetBrandCard(string $brand): array
    {
        return $this->request('get', 'brands/' . $brand)->json() ?? [];
    }

    public function GetBrandsList(array $data = []): array
    {
        return $this->request('get', 'brands', $data)->json() ?? [];
    }

    // Orders

    public function GetOrderCard(array $data = []): array
    {
        return $this->request('get', 'orders', $data)->json() ?? [];
    }

    public function PostOrder(array $data = []): array
    {
        return $this->request('post', 'orders', $data)->json() ?? [];
    }

    public function GetOrdersByContractor(array $data = []): array
    {
        return $this->request('get', 'orders/list', $data)->json() ?? [];
    }

    public function listOrdersByUserGuid(array $data = []): array
    {
        return $this->request('get', 'orders/list', $data)->json() ?? [];
    }

    // Posts

    public function GetPostCard(string $post): array
    {
        return $this->request('get', 'posts/' . $post)->json() ?? [];
    }

    public function getPostsList(array $data = []): array
    {
        return $this->request('get', 'posts', $data)->json() ?? [];
    }

    // Catalogs

    public function GetCatalogCard(string $catalog): array
    {
        return $this->request('get', 'catalogs/' . $catalog)->json() ?? [];
    }

    public function GetCatalogsList(array $data = []): array
    {
        return $this->request('get', 'catalogs', $data)->json() ?? [];
    }

    // public function treeCatalogs(array $data = []): array
    // {
    //     return $this->request('get', 'offers/catalog/treeCatalogs', $data)->json() ?? [];
    // }

    // Variants

    public function GetVariantCard(string $variant): array
    {
        return $this->request('get', 'variants/' . $variant)->json() ?? [];
    }

    public function GetVariantsList(array $data = []): array
    {
        return $this->request('get', 'variants', $data)->json() ?? [];
    }

    // Offers

    public function GetOfferImage(string $image): array
    {
        return $this->request('get', "offers/image/{$image}")->json() ?? [];
    }

    public function GetOfferCard(string $offer): array
    {
        return $this->request('get', "offers/{$offer}")->json() ?? [];
    }

    public function GetOffersList(array $data = []): array
    {
        return $this->request('get', 'offers', $data)->json() ?? [];
    }

    public function GetOffersListByGuids(array $data = []): array
    {
        return $this->request('post', 'offers', $data)->json() ?? [];
    }

    // Other

    public function getOffersByUser(string $user): array
    {
        return $this->request('get', "users/{$user}/offers")->json() ?? [];
    }






    public function AddOfferToBasket(array $data = []): array
    {
        return $this->request('post', 'offers/basket/add', $data)->json() ?? [];
    }
}
