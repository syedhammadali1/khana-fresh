<?php

namespace App\Http\Traits;

use App\Models\Language;
use Illuminate\Support\Facades\DB;

trait LanguageAttribute
{


    /**
     * Determine if the user is an administrator.
     *
     * @return bool
     */
    public function getLanguagesAttribute()
    {
        return DB::table($this->getTable())->orwhere(function ($q) {
            $q->where('id', $this->locale_parent_id);
        })->orwhere(function ($q) {
            if ($this->locale_parent_id !== null) {
                $q->where('locale_parent_id', $this->locale_parent_id);
            } else {
                $q->where('locale_parent_id', $this->id);
            }
        })->select(['id', 'locale_id', 'locale_parent_id'])->get()->map(function ($item) {

            $item->language = Language::whereId($item->locale_id)->select(['code', 'name'])->first();
            return $item;
        });
    }
}
