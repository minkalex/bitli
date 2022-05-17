<?php

namespace App\Interfaces;

use App\Models\Link;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;

interface LinkRepositoryInterface
{
    /**
     * @param $attributes
     * @return Link|null|RedirectResponse
     */
    public function create($attributes): Link|null|RedirectResponse;

    /**
     * @param $hash
     * @return Collection
     */
    public function findByHash($hash): Collection;

    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @param  Link  $link
     * @param  $attributes
     * @return bool
     */
    public function update($attributes, Link $link): bool;

    /**
     * @param Link $link
     * @return bool|null
     */
    public function delete(Link $link): ?bool;

    /**
     * @param $url
     * @return array
     */
    public function safeBrowsingLookup($url): array;
}
