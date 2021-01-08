<?php
namespace App\Excel;
use App\Models\Pusat\Produk;
use App\Models\Pusat\Jabodetabek;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use DB;

class ExportProduk implements FromCollection,
        ShouldAutoSize, 
        WithMapping, 
        WithHeadings,
        WithEvents
{
    public function collection()
    {
        return Produk::with('jabodetabek')
                    ->with('pulau_jawa')
                    ->with('luar_pulau_jawa')
                    ->with('kategori')
                    ->get();
    }

    public function map($produk): array
    {
        return [
            $produk->nama_produk,
            $produk->berat,
            $produk->stok,
            $produk->kategori->kategori,
            $produk->jabodetabek->harga_agen_jabodetabek,
            $produk->jabodetabek->harga_reseller_jabodetabek,
            $produk->pulau_jawa->harga_agen_pjawa,
            $produk->pulau_jawa->harga_reseller_pjawa,
            $produk->luar_pulau_jawa->harga_agen_lpjawa,
            $produk->luar_pulau_jawa->harga_reseller_lpjawa,
        ];
    }

    public function headings(): array
    {
        return [
            'Nama produk',
            'Berat (gram)',
            'Stok tersedia',
            'Kategori',
            'Harga agen Jabodetabek',
            'Harga reseller Jabodetabek',
            'Harga agen Pulau Jawa',
            'Harga reseller Pulau Jawa',
            'Harga agen Luar Jawa',
            'Harga reseller Luar Jawa',
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