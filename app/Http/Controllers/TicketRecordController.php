<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\SessionDetails;
use Illuminate\Http\Request;
use TCPDF;

class TicketRecordController extends Controller
{
    public function index()
    {
        $ticket_detail = SessionDetails::with('qr', 'session', 'customer')
        ->orderBy('id', 'desc')
        ->get();
        return view('ticket_records.index' , [
            'tickets' => $ticket_detail,
            'session' => Session::all()
        ]);
    }

    public function orderby_date(Request $request)
    {
        $date = $request->date;
        $ticket_detail = SessionDetails::with('qr', 'session', 'customer')
        ->where('date', $date)
        ->orderBy('id', 'desc')
        ->get();
        return $ticket_detail;
    }

    public function orderby_session(Request $request)
    {
        $session = $request->session;
        $date    = $request->date;
        $ticket_detail = SessionDetails::with('qr', 'session', 'customer')
        ->where('date', $date)
        ->where('session_id', $session)
        ->orderBy('id', 'desc')
        ->get();
        return $ticket_detail;
    }

    public function ticket_pdf()
    {
        // $details = SessionDetails::all();

        include('tcpdf/tcpdf.php');

        // include('tcpdf/config/tcpdf_config.php');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // $pdf->Cell(190,10,"this is a cell",1,1, 'C');

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('OK');
        $pdf->SetTitle('Ticket Records');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->setFontSubsetting(true);

        $pdf->SetFont('dejavusans', '', 14, '', true);

        $pdf->AddPage();

        $html = '';

        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

        $pdf->setFont('Helvetica', '', 14);
        $pdf->Cell(190, 10, "Selfie Art", 0, 1, 'C');

        $pdf->setFont('Helvetica', '', 14);
        $pdf->Cell(190, 5, "Ticket Records", 0, 1, 'C');
        $pdf->Ln();
        $pdf->Ln(3);

        $html = "
            <table>
                <tr>

                    <th>Name</th>
                    <th>Session</th>
                    <th>QR</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>";
        $details = SessionDetails::join('sessions', 'session_tickets.session_id', 'sessions.id')
            ->join('customers', 'session_tickets.customer_id', 'customers.id')
            ->select('sessions.name as session', 'customers.name as customer', 'session_tickets.*')
            ->get();
            foreach($details as $item){
        $html .= "
                <tr>
                    <td>". $item->customer ."</td>
                    <td>". $item->session ."</td>
                    <td>". $item->qr_id ."</td>
                    <td>". $item->status ."</td>
                    <td>". $item->date ."</td>
                </tr>";
            }
        $html .= "
            </table>
            <style>
                table {
                    border-collapse:collapse;
                }
                th,td {
                    border: 1px solid #000;
                }
                table tr th {
                    background-color: #808080;
                    color: #fff;
                    font-weight: bold;
                }
            </style>
        ";

        $pdf->WriteHTMLCell(192, 0, 9, '', $html, 0);

        $pdf->Output('Ticket_Records.pdf', 'I');
    }
}
