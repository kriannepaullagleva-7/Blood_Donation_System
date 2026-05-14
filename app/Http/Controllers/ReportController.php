<?php
namespace App\Http\Controllers;
use App\Models\Blood;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller {

    public function index() {
        $total = Blood::count();
        $available = Blood::where('status', 'available')->sum('bags');
        $used = Blood::where('status', 'used')->sum('bags');
        $expired = Blood::where('status', 'expired')->sum('bags');
        $byType = Blood::selectRaw("blood_type,
            SUM(bags) as total_bags,
            SUM(CASE WHEN status='available' THEN bags ELSE 0 END) as available,
            SUM(CASE WHEN status='used' THEN bags ELSE 0 END) as used,
            SUM(CASE WHEN status='expired' THEN bags ELSE 0 END) as expired")
            ->groupBy('blood_type')->get();
        return view('reports.index', compact('total','available','used','expired','byType'));
    }

    public function pdf() {
        $total = Blood::count();
        $available = Blood::where('status', 'available')->sum('bags');
        $used = Blood::where('status', 'used')->sum('bags');
        $expired = Blood::where('status', 'expired')->sum('bags');
        $byType = Blood::selectRaw("blood_type,
            SUM(bags) as total_bags,
            SUM(CASE WHEN status='available' THEN bags ELSE 0 END) as available,
            SUM(CASE WHEN status='used' THEN bags ELSE 0 END) as used,
            SUM(CASE WHEN status='expired' THEN bags ELSE 0 END) as expired")
            ->groupBy('blood_type')->get();
        $date = now()->format('Y-m-d');
        $pdf = Pdf::loadView('reports.pdf', compact('total','available','used','expired','byType','date'));
        return $pdf->download('blood-report-' . $date . '.pdf');
    }
}