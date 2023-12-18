<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'listing_title', 'product_code', 'slug', 'images', 'video', //nueva variable video
        'bedroom', 'bathroom', 'garage', //new variables to filters
        'meta_description', 'keywords', 'Front','Fund','land_area','construction_area', 'property_price_min','property_price',
        'listing_description','listing_type', 'num_factura', 'address','state','city','listingtype',
        'sector', // nueva variable para select dinamico
        'zone',
        'listingcharacteristic','listinglistservices','listingtypestatus','listingtagstatus', 'listinggeneralcharacteristics', 'listingenvironments',
        'listyears',//se agrego esta nueva variable
        'lat', 'lng', //nuevas variables se quito lat y lng como variables
        //'ubication_url', //se agrego esto para la ubicacion
        'available',
        'status','user_id',
        'threedegreeview','heading_details','owner_name', 'owner_email', 'owner_address',
        'identification', 'phone_number', // new variables to save cedula and numero telefonico
        'aval', //new variable to avaluo
        'locked',
        'vip',
        'planing_license',
        'mortgaged',
        'entity_mortgaged',
        'mount_mortgaged',
        'cadastral_key',
        'aliquot',
        'observations_type_property',
        'cavity_error',
        'warranty',
        'plusvalia',
        'tiktokcode',
        'niv_constr', 'num_pisos', 'pisos_constr', // nuevas variables para las caracteristicas generales
        'delete_at',
        'posted_on_facebook',
        'date_posted_facebook',
        'property_by'
    ];
}
