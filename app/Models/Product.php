<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=['id','cat_id','subcat_id','br_id','unit_id','size_id','color_id','code','name','description','price','image','status'];

    public function category(){
        return $this->belongsTo(Catogory::class,'cat_id'); 
    }

    public function subcategory(){
        return $this->belongsTo(SubCatogory::class,'subcat_id'); 
    }

    public function brand(){
        return $this->belongsTo(Brand::class,'br_id'); 
    }

    public function unit(){
        return $this->belongsTo(Unit::class,'unit_id'); 
    }

    public function size(){
        return $this->belongsTo(Size::class,'size_id'); 
    }

    public function color(){
        return $this->belongsTo(Color::class,'color_id'); 
    }

    public static function catProductCount($cat_id){
        $catcount = Product::where('cat_id',$cat_id)->where('status',1)->count();
        return $catcount;

    }

    public static function subcatProductCount($subcat_id){
        $subcatcount = Product::where('subcat_id',$subcat_id)->where('status',1)->count();
        return $subcatcount;

    }

    public static function brandProductCount($br_id){
        $brandcount = Product::where('br_id',$br_id)->where('status',1)->count();
        return  $brandcount;

    }

   

}
