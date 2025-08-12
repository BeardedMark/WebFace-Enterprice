<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

class ExtensionService
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
            // return redirect()->route('error.page')->with('error', $errorData);
        }
    }


    public function getBaseStatistics(array $data = []): array
    {
        return $this->request('get', 'public_api/base/stats', $data)->json() ?? [];
    }

    public function getBaseFeed(array $data = []): array
    {
        return $this->request('get', 'public_api/base/feed', $data)->json() ?? [];
    }
    public function getBaseData(array $data = []): array
    {
        return $this->request('get', 'public_api/base/data', $data)->json() ?? [];
    }


    public function cardCatalog(array $data = []): array
    {
        return $this->request('get', 'public_api/catalog/cardCatalog', $data)->json() ?? [];
    }
    public function indexCatalogs(array $data = []): array
    {
        return $this->request('get', 'public_api/catalog/listCatalogs', $data)->json() ?? [];
    }
    public function treeCatalogs(array $data = []): array
    {
        return $this->request('get', 'public_api/catalog/treeCatalogs', $data)->json() ?? [];
    }

    public function indexOffers(array $data = []): array
    {
        return $this->request('get', 'public_api/offer/listOffersByCatalogGuid', $data)->json() ?? [];
    }

    public function getOffer(array $data = []): array
    {
        return $this->request('get', 'public_api/offer/cardOfferByGuid', $data)->json() ?? [];
    }

    public function getImage(array $data = []): array
    {
        return $this->request('get', 'public_api/offer/getImage', $data)->json() ?? [];
    }

    public function getVariants(array $data = []): array
    {
        return $this->request('get', 'public_api/variants/listVariantsByOfferGuid', $data)->json() ?? [];
    }

    public function listPriceByContractor(array $data = []): array
    {
        return $this->request('get', 'public_api/offer/listPriceByContractor', $data)->json() ?? [];
    }

    public function listPriceByUser(array $data = []): array
    {
        return $this->request('get', 'public_api/offer/listPriceByUser', $data)->json() ?? [];
    }




    public function cardUserByGuid(array $data = []): array
    {
        return $this->request('get', 'public_api/user/cardUserByGuid', $data)->json() ?? [];
    }
    public function loginUser(array $data = []): array
    {
        return $this->request('get', 'public_api/user/loginUser', $data)->json() ?? [];
    }

    public function getContractorsByUser(array $data = []): array
    {
        return $this->request('get', 'public_api/contractor/getContractorsByUserGuid', $data)->json() ?? [];
    }

    public function GetContractorCard(array $data = []): array
    {
        return $this->request('get', 'public_api/contractor/getContractorCard', $data)->json() ?? [];
    }

    public function GetCustomerOrdersByContractor(array $data = []): array
    {
        return $this->request('get', 'public_api/order/listOrdersByContractorGuid', $data)->json() ?? [];
    }

    public function listOrdersByUserGuid(array $data = []): array
    {
        return $this->request('get', 'public_api/order/listOrdersByUserGuid', $data)->json() ?? [];
    }

    public function cardOrderByGuid(array $data = []): array
    {
        return $this->request('get', 'public_api/order/cardOrderByGuid', $data)->json() ?? [];
    }

    public function PostCustomerOrderByContractor(array $data = []): array
    {
        return $this->request('post', 'public_api/order/post', $data)->json() ?? [];
    }



    public function AddOfferToBasket(array $data = []): array
    {
        return $this->request('post', 'public_api/basket/add', $data)->json() ?? [];
    }
}
