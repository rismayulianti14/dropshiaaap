<?php
namespace App\Excel;
use App\Models\Pusat\Petugas;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use DB;

class ExportPetugas implements FromCollection,
        ShouldAutoSize, 
        WithMapping, 
        WithHeadings,
        WithEvents
{
    public function collection()
    {
        return $petugas = Petugas::all();
    }

    public function map($petugas): array
    {
        return [
            $petugas->kode_id,
            $petugas->nama_lengkap,
            $petugas->username,
            $petugas->email,
            $petugas->telepon,
            $petugas->posisi,
            $petugas->status
        ];
    }

    public function headings(): array
    {
        return [
            'ID Petugas',
            'Nama lengkap',
            'Username',
            'Email',
            'Telepon',
            'Posisi',
            'Status'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getStyle('A1:G1')->applyFromArray([
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