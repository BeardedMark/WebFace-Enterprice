Catalog {
    string guid
    string name
    int countCatalogs = listCatalogsByCatalogGuid().count
    int countOffers = listOffersByCatalogGuid().count
    int countTotalCatalogs = listCatalogsByCatalogGuid().count
    int countTotalOffers = listOffersByCatalogGuid().count

    GET cardCatalogByGuid(string catalogGuid) :object(this) {
        array catalogs = listCatalogsByCatalogGuid()
        array offers = listOffersByCatalogGuid()
        ?object parent = {string guid, string name}
    }

    GET listCatalogsByCatalogGuid(string catalogGuid, bool total = false, ?string contractorGuid, ?string search) :array(this)
}

Offer {
    string guid
    string code
    string article
    string name
    ?string description
    ?string imageGuid
    ?string type
    ?string manufacturer
    ?string brand
    ?string unit
    int totalStock
    int freeStock
    int price
    ?int personalPrice = offerPriceByContractorGuid()
    int countVariants = listVariantsByOfferGuid().count

    GET cardOfferByGuid(string offerGuid, ?string contractorGuid) :object(this) {
        array variants = listVariantsByOfferGuid()
    }

    GET listOffersByCatalogGuid(string catalogGuid, bool hierarchy = false, ?string contractorGuid, ?string search) :array(this)
}

Variant {
    string guid
    string name
    string unit
    int totalStock
    int freeStock
    int price
    ?int personalPrice = offerPriceByContractorGuid()
    array properties = {string propertyGuid, string propertyName}

    GET cardVariantByGuid(string variantGuid, ?string contractorGuid) :object(this) {
        ?object parent = {string parentGuid, string parentName}
    }

    GET listVariantsByOfferGuid(string variantGuid, ?string contractorGuid, ?string search) :array(this)
}

User {
    string guid
    string name
    int countContractors

    GET AUTH cardUserByGuid(string userGuid) :object(this) {
        array contacts = listContactsByUserGuid()
        array contractors = listContractorsByUserGuid()
    }

    POST authUser(string login, string password) :object(this)
    POST AUTH requestAccessToContractorByInn(string userGuid, string inn) :void
}

Contractor {
    string guid
    string code
    string name
    string partner = {string guid, string name}
    int inn
    int kpp
    int ogrn
    int countOrders = listOrdersByContractorGuid().count
    float balance

    GET cardContractorByGuid(string contractorGuid) :object(this) {
        array contacts = listContactsByContractorGuid()
        array orders = listOrdersByContractorGuid()
    }

    GET listContractorsByUserGuid(string userGuid) :array(this)
}

Price {
    object offer = {string offerGuid, string offerName}
    ?object variant = {string variantGuid, string variantName}
    float price
    string type

    GET offerPriceByContractorGuid(string contractorGuid, string offerGuid) :float
    GET priceListByContractorGuid(string contractorGuid) :array(this)
    GET priceListByUserGuid(string userGuid) :array(this)
    GET personalPricesByContractorGuid(string contractorGuid) :array(this)
    GET previousPricesByContractorGuid(string contractorGuid) :array(this)
}

Order {
    string guid
    string code
    string status
    string address
    ?string commentary
    string deliveryType
    float summ
    date deliveryDate
    time fromTime
    time toTime
    object contractor = {string contractorGuid, string contractorName}
    int countOffers

    GET cardOrderByGuid(string orderGuid) :object(this) {
        array offers = {
            object offer = {string offerGuid, string offerName}
            ?object variant = {string vaariantGuid, string variantName}
            int count
            float price
            float summ
        }
    }

    GET listOrdersByContractorGuid(string contractorGuid) :array(this)
    GET listOrdersByUserGuid(string userGuid) :array(this)

    POST newOrderByContractorGuid(
        string guid
        enum deliveryType = [pickup, delivery]
        string addres
        ?string commentary
        date deliveryDate = now
        time fromTime = 9:00
        time toTime = 18:00
        array offers = {
            string offerGuid
            ?string variantGuid
            int count
        }
    ) :cardOrderByGuid()

    PUT editOrderByGuid(
        string guid
        ?enum deliveryType = [pickup, delivery]
        ?string addres
        ?string commentary
        ?date deliveryDate = now
        ?time fromTime = 9:00
        ?time toTime = 18:00
        ?array offers = {
            string offerGuid
            ?string variantGuid
            int count
        }
    ) :cardOrderByGuid()

    DELETE removeOrderByGuid(string orderGuid) :void
}
