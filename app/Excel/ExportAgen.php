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

class ExportAgen implements FromCollection,
        ShouldAutoSize, 
        WithMapping, 
        WithHeadings,
        WithEvents
{
    public function collection()
    {
        /*return Agen::with('detail_agen')
                    ->get();*/
        return $agen = DB::table('akun_agen')
                    ->join('detail_agen', 'detail_agen.id_agen', '=', 'akun_agen.id')
                    ->join('provinces', 'provinces.province_id', '=', 'detail_agen.provinsi')
                    ->join('cities', 'cities.city_id', '=', 'detail_agen.kota')
                    ->join('subdistricts', 'subdistricts.subdistrict_id', '=', 'detail_agen.kecamatan')
                    ->get();
    }

    public function map($agen): array
    {
        return [
            $agen->nama_lengkap,
            $agen->tempat_lahir,
            $agen->tanggal_lahir,
            $agen->pekerjaan,
            $agen->jenis_kelamin,
            $agen->telepon,
            $agen->email,
            $agen->alamat_detail,
            $agen->subdistrict_name,
            $agen->city_name,
            $agen->province_name,
            $agen->kode_pos
        ];
    }

    public function headings(): array
    {
        return [
            'Nama lengkap',
            'Tempat lahir',
            'Tanggal lahir',
            'Pekerjaan',
            'Jenis kelamin',
            'No.Telepon',
            'Email',
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