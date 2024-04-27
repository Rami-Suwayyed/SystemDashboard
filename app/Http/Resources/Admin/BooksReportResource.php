<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\AuthorsResource;
use App\Http\Resources\BookClassifyingResource;
use App\Http\Resources\CategoriesResource;
use App\Http\Resources\LinkTypesResource;
use App\Http\Resources\PublishersResource;
use App\Http\Resources\SchoolsResource;
use App\Models\Favorites;
use App\Models\LinksTypes;
use Illuminate\Http\Resources\Json\JsonResource;

class BooksReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {


        return [
            'id' => $this->id,
            'book_section' => $this->book_section ?  $this->book_section->name : '',
            'name' => $this->name,
            'category_name' => $this->category ? $this->category->name : '' ,
            'readers_count' => $this->readers_count,
            'search_count' => $this->readers_count,
        ];
    }
}
