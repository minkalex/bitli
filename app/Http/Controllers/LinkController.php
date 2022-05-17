<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLinkRequest;
use App\Http\Requests\UpdateLinkRequest;
use App\Interfaces\LinkRepositoryInterface;
use App\Models\Link;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LinkController extends Controller
{
    private LinkRepositoryInterface $linkRepository;

    public function __construct(LinkRepositoryInterface $linkRepository)
    {
        $this->linkRepository = $linkRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View|JsonResponse
    {
        if ($request->hasHeader('X-Requested-With') && ('Axios' === $request->header('X-Requested-With'))) {
            try {
                $result = $this->linkRepository->all();
            } catch (Exception $e) {
                $result = $e->getMessage();
            }

            return response()->json($result);
        } else {
            return view('welcome');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreLinkRequest  $request
     * @return Link|null|RedirectResponse
     */
    public function store(StoreLinkRequest $request): Link|null|RedirectResponse
    {
        return $this->linkRepository->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  Link  $link
     * @return \Illuminate\Http\Response
     */
    public function show(Link $link)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Link  $link
     * @return \Illuminate\Http\Response
     */
    public function edit(Link $link)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateLinkRequest  $request
     * @param  Link  $link
     * @return bool
     */
    public function update(UpdateLinkRequest $request, Link $link): bool
    {
        return $this->linkRepository->update($request->all(), $link);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Link  $link
     * @return ?bool
     */
    public function destroy(Link $link): ?bool
    {
        return $this->linkRepository->delete($link);
    }
}
