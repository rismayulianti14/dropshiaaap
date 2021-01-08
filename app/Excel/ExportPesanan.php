<?php
namespace App\Excel;
use App\Models\Transaksi\HeadTransaksi;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use DB;

class ExportPesanan implements FromCollection,
        ShouldAutoSize, 
        WithMapping, 
        WithHeadings,
        WithEvents
{
    public function collection()
    {
        /*return Agen::with('detail_agen')
                    ->get();*/
        return $pesanan = HeadTransaksi::all();
    }

    public function map($pesanan): array
    {
        return [
            $pesanan->no_pesanan,
            $pesanan->no_resi,
            $pesanan->id_agen,
            $pesanan->total_pembelian,
            $pesanan->kurir,
            $pesanan->layanan,
            $pesanan->ongkir,
            $pesanan->grand_total,
            $pesanan->tgl_pesan,
            $pesanan->tgl_diterima,
            $pesanan->status,
            $pesanan->catatan
        ];
    }

    public function headings(): array
    {
        return [
            'No pesanan',
            'No resi',
            'Nama agen',
            'Total pembelian',
            'Kurir',
            'Layanan',
            'Ongkos kirim',
            'Grand Total',
            'Tanggal pesan',
            'Tanggal diterima',
            'Status pengiriman',
            'Catatan'
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