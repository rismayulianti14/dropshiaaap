<?php
namespace App\Excel;
use App\Models\Agen\Kategori;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use DB;

class ExportKategori implements FromCollection,
        ShouldAutoSize, 
        WithMapping, 
        WithHeadings,
        WithEvents
{
    public function collection()
    {
        /*return Agen::with('detail_agen')
                    ->get();*/
        return $kategori = DB::table('kategori')->get();
    }

    public function map($kategori): array
    {
        return [
            $kategori->kategori,
            $kategori->created_at,
            $kategori->updated_at,
        ];
    }

    public function headings(): array
    {
        return [
            'Kategori',
            'Tanggal dibuat',
            'Tanggal diubah'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getStyle('A1:C1')->applyFromArray([
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