<?php
namespace App\Imports;

use App\Models\Tenant\Product;
use App\Models\Tenant\ProductCategory;
use App\Models\Tenant\ProductSizeColor;
use App\Models\Tenant\Size;
use App\Models\Tenant\Category;
use App\Models\Tenant\Color;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportProducts implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }
    
    public function model(array $row)
    {
        if($row[0] && $row[1]){
            $sizes = [];
            $size_ar = array_filter(explode("\n",$row[7]));
            $size_en = array_filter(explode("\n",$row[8]));
            if(count($size_ar) > 0  && count($size_en) > 0 ){
                for($i=0;$i<count($size_ar);$i++){
                    if(isset($size_ar[$i]) && isset($size_en[$i]))
                        $sizes[] = Size::Where('title_ar',  $size_ar[$i] )->orWhere('title_en',  $size_en[$i] )->firstOrCreate([
                            'title_ar' => $size_ar[$i],
                            'title_en' => $size_en[$i],
                        ])->id;
                }
            }
            
            $colors = [];
            $color_ar = explode("\n",$row[9]);
            $color_en = explode("\n",$row[10]);
            if(count($color_ar) && count($color_en)){
                for($i=0;$i<count($color_ar);$i++){
                    if(strlen($color_ar[$i]) > 0 && strlen($color_en[$i]) > 0 )
                        $colors[] = Color::Where('title_ar',  $color_ar[$i] )->orWhere('title_en',  $color_en[$i] )->firstOrCreate([
                            'title_ar' => $color_ar[$i],
                            'title_en' => $color_en[$i],
                        ])->id;
                }
            }
          

    
            $Data = [];
            
        	$Data['sizes'] = $sizes;
        	$Data['colors'] = $colors;
        	

            $Product = Product::create([
        		'title_ar'  => $row[0],
        		'title_en'  => $row[1],
        		'code'      => $row[4],
        		'desc_ar'   => $row[5],
        		'desc_en'   => $row[6],
        		'VAT'       => $row[15] ?? 'exclusive',
        		'has_size'  => count($sizes) > 0,
        		'has_color'  => count($colors) > 0,
        	]);
        	
            for($i=0;$i<count(explode("\n",$row[2]));$i++){
                $Category = Category::Where('title_ar',  $row[2] )->orWhere('title_en',  $row[3] )->firstOrCreate([
            		'title_ar'  => $row[2],
            		'title_en'  => $row[3],
                ]);
                ProductCategory::create([
                    'category_id' => $Category->id,
                    'product_id' => $Product->id,
                ]);
            }
            
            InsertSizeColor($Product, $Data);
            
            ProductSizeColor::where('product_id',$Product->id)->update([
                'price' => $row[16],
                'quantity' => $row[17],
                'discount' => $row[14] ? $row[14] : NULL,
                'from' => $row[12] ? Date::excelToDateTimeObject($row[12])->format('Y-m-d H:i:s') : NULL,
                'to' => $row[13] ? Date::excelToDateTimeObject($row[13])->format('Y-m-d H:i:s') : NULL,
            ]);
        }

    }
}
