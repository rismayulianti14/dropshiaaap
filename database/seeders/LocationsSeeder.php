<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Rajaongkir\Province;
use App\Models\Rajaongkir\City;
use App\Models\Rajaongkir\Subdistrict;
use Steevenz\Rajaongkir;

class LocationsSeeder extends Seeder
{
    public function run()
    {
        $config['api_key'] = '09152fd0704577b8da71b0c06478e475';
        $config['account_type'] = 'pro';
 
        $rajaongkir = new Rajaongkir($config);

        $daftarProvinsi = $rajaongkir->getProvinces();
        foreach ($daftarProvinsi as $provinceRow) {
            Province::create([
                'province_id'   => $provinceRow['province_id'],
                'province_name' => $provinceRow['province'],
            ]);
            $daftarKota = $rajaongkir->getCities($provinceRow['province_id']);
            foreach ($daftarKota as $cityRow) {
                City::create([
                    'province_id'   => $provinceRow['province_id'],
                    'city_id'       => $cityRow['city_id'],
                    'city_name'     => $cityRow['city_name'],
                ]);
                $daftarKecamatan = $rajaongkir->getSubdistricts($cityRow['city_id']);
                foreach ($daftarKecamatan as $subdistrictRow) {
                Subdistrict::create([
                    'province_id'       => $provinceRow['province_id'],
                    'city_id'           => $cityRow['city_id'],
                    'subdistrict_id'    => $subdistrictRow['subdistrict_id'],
                    'subdistrict_name'  => $subdistrictRow['subdistrict_name'],
                ]);
            }
            }
        }
    }
}

