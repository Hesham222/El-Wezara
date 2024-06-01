<?php

namespace Organization\Models;


class PreparationAreaCategory extends Model
{
    protected $table = 'preparation_area_menu_categories';

    public function preparationArea(){
        return $this->belongsTo(PreparationArea::class,'area_id');
    }

    public function category(){
        return $this->belongsTo(MenuCategory::class,'category_id');
    }
}
