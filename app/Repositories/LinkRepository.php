<?php

namespace App\Repositories;

use App\Interfaces\LinkRepositoryInterface;
use App\Models\Link;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class LinkRepository implements LinkRepositoryInterface
{

    /**
     * @param  $attributes
     * @return Link|null|RedirectResponse
     */
    public function create($attributes): Link|null|RedirectResponse
    {
        $existingLink = Link::where('full_path', $attributes['full_path'])->select(['short_path'])->get();
        if (1 === $existingLink->count()) {
            return redirect('/errors')
                ->with('error', htmlspecialchars("The full path has already been taken: <a href='".$existingLink->first()->short_path."' target='_blank'>".$existingLink->first()->short_path."</a>"));
        }
        $urlValidation = $this->safeBrowsingLookup($attributes['full_path']);
        if (200 === $urlValidation['CODE'] && empty($urlValidation['RESULT'])) {
            $arUrl = explode("/", $attributes['full_path']);
            do {
                $hash = Str::random(6);
                $existingHash = $this->findByHash($hash);
            } while (1 === $existingHash->count());
            $shortPath = env('APP_URL');
            $count = count($arUrl) - 1;
            for ($i = 3; $i < $count; $i++) {
                $shortPath .= '/'.$arUrl[$i];
            }
            $shortPath .= '/'.$hash;
            $link = new Link;
            $link->full_path = $attributes['full_path'];
            $link->short_path = $shortPath;
            $link->hash = $hash;
            $link->title = $attributes['title'];
            $link->save();
            return $link;
        } else {
            return null;
        }
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return Link::all();
    }

    /**
     * @param  Link  $link
     * @param  $attributes
     * @return bool
     */
    public function update($attributes, Link $link): bool
    {
        return $link->update(['title' => $attributes['title']]);
    }

    /**
     * @param Link $link
     * @return bool|null
     */
    public function delete(Link $link): ?bool
    {
        return $link->delete();
    }

    /**
     * @param $url
     * @return array
     */
    public function safeBrowsingLookup($url): array
    {
        $queryUrl = 'https://safebrowsing.googleapis.com/v4/threatMatches:find?key=AIzaSyAweqDrveYRBGB37srv9UvmdsIjFMGaGEQ';
        $queryData = json_encode([
            'client' => ['clientId' => 'face_it', 'clientVersion' => '1'],
            'threatInfo' => [
                'threatTypes' => [
                    'THREAT_TYPE_UNSPECIFIED',
                    'MALWARE',
                    'SOCIAL_ENGINEERING',
                    'UNWANTED_SOFTWARE',
                    'POTENTIALLY_HARMFUL_APPLICATION'
                ],
                'platformTypes' => ['ALL_PLATFORMS'],
                'threatEntries' => [['url' => $url]]
            ]
        ]);
        $curl = curl_init($queryUrl);
        curl_setopt_array($curl, array(
            CURLOPT_POST => 1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
            CURLOPT_POSTFIELDS => $queryData
        ));
        $result = curl_exec($curl);
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        return ['CODE' => $code, 'RESULT' => json_decode($result, true)];
    }

    /**
     * @param $hash
     * @return Collection
     */
    public function findByHash($hash): Collection
    {
        return Link::where('hash', $hash)->get();
    }

    /**
     * @param $url
     * @return string
     */
    public function getLinkByUrl($url): string
    {
        return Link::where('full_path', $url)->select(['short_path'])->get();
    }
}
