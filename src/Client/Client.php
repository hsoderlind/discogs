<?php

namespace Hsoderlind\Discogs\Client;

use GuzzleHttp\Client as BaseClient;
use Hsoderlind\Discogs\Api\Service;
use Hsoderlind\Discogs\Api\Resource;

class Client extends BaseClient
{
    /**
     * Use the artist service.
     *
     * @return Service
     */
    public function useArtist(): Service
    {
        return new Service($this, Resource::RESOURCE_ARTIST);
    }

    /**
     * CUse the collection service. 
     *
     * @return Service
     */
    public function useCollection(): Service
    {
        return new Service($this, Resource::RESOURCE_COLLECTION);
    }

    /**
     * Use the inventory service
     *
     * @return Service
     */
    public function useInventory(): Service
    {
        return new Service($this, Resource::RESOURCE_INVENTORY);
    }

    /**
     * Use the label service
     *
     * @return Service
     */
    public function useLabel(): Service
    {
        return new Service($this, Resource::RESOURCE_LABEL);
    }

    /**
     * Use the list service.
     *
     * @return Service
     */
    public function useList(): Service
    {
        return new Service($this, Resource::RESOURCE_LIST);
    }

    /**
     * Use the marketplace service.
     *
     * @return Service
     */
    public function useMarketplace(): Service
    {
        return new Service($this, Resource::RESOURCE_MARKETPLACE);
    }

    /**
     * Use the master service.
     *
     * @return Service
     */
    public function useMaster(): Service
    {
        return new Service($this, Resource::RESOURCE_MASTER);
    }

    /**
     * Use the release service.
     *
     * @return Service
     */
    public function useRelease(): Service
    {
        return new Service($this, Resource::RESOURCE_RELEASE);
    }

    /**
     * Use the search service
     *
     * @return Service
     */
    public function useSearch(): Service
    {
        return new Service($this, Resource::RESOURCE_SEARCH);
    }

    /**
     * Use the user service.
     *
     * @return Service
     */
    public function useUser(): Service
    {
        return new Service($this, Resource::RESOURCE_USER);
    }

    /**
     * Use the wantlist service.
     *
     * @return Service
     */
    public function useWantlist(): Service
    {
        return new Service($this, Resource::RESOURCE_WANTLIST);
    }
}
