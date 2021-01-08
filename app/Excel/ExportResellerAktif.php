<?php
namespace App\Excel;
use App\Models\Agen\Agen;
use App\Models\Agen\DetailAgen;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use DB;

class ExportResellerAktif implements FromCollection,
        ShouldAutoSize, 
        WithMapping, 
        WithHeadings,
        WithEvents
{
    public function collection()
    {
        /*return Agen::with('detail_agen')
                    ->get();*/
        return $reseller = DB::table('akun_reseller')
                    ->join('detail_reseller', 'detail_reseller.id_reseller', '=', 'akun_reseller.id')
                    ->join('provinces', 'provinces.province_id', '=', 'detail_reseller.provinsi')
                    ->join('cities', 'cities.city_id', '=', 'detail_reseller.kota')
                    ->join('subdistricts', 'subdistricts.subdistrict_id', '=', 'detail_reseller.kecamatan')
                    ->where('akun_reseller.status', 1)
                    ->get();
    }

    public function map($reseller): array
    {
        return [
            $reseller->kode_id,
            $reseller->nama_lengkap,
            $reseller->tempat_lahir,
            $reseller->tanggal_lahir,
            $reseller->pekerjaan,
            $reseller->jenis_kelamin,
            $reseller->telepon,
            $reseller->email,
            $reseller->status,
            $reseller->alamat_detail,
            $reseller->subdistrict_name,
            $reseller->city_name,
            $reseller->province_name,
            $reseller->kode_pos
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama lengkap',
            'Tempat lahir',
            'Tanggal lahir',
            'Pekerjaan',
            'Jenis kelamin',
            'No.Telepon',
            'Email',
            'Status',
            'Alamat'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getStyle('A1:J1')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
            },
        ];
    }
}