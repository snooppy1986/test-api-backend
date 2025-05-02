<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    public static $wrap = 'users';
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }

    /**
     * Customize the pagination information for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array $paginated
     * @param  array $default
     * @return array
     */
    public function paginationInformation($request, $paginated, $default)
    {
        $next_url = $default['links']['next'];
        $prev_url = $default['links']['prev'];

        $default['page'] = $paginated['current_page'];
        $default['total_pages'] = $paginated['last_page'];
        $default['total_users'] = $paginated['total'];
        $default['count'] = $paginated['per_page'];

        unset( $default['meta'], $default['links']);

        $default['links']['next_url'] = $next_url;
        $default['links']['prev_url'] = $prev_url;

        return $default;
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @return array<string, mixed>
     */
    public function with(Request $request): array
    {
        return [
            'success' => true,
        ];
    }
}
